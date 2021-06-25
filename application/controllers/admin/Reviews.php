<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Reviews
 * @property Reviews_model model
 */

class Reviews extends ADMIN_Controller {

	public $page = 'reviews';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('reviews_model');
		$this->model = $this->reviews_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$count = $this->model->getCount();
		$pagination = admin_pagination($this->page.'/index', $count);
		
		$this->data['items'] = $this->model->getItems(null, 'pub_date DESC', $pagination['per_page'], $pagination['offset']);
		
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->load->helper('text');
		
		$this->output($this->page.'/index');
	}
	
	public function create()
	{
		$this->load->library('upload', $this->model->file_config());
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				$insert['is_read'] = 1;
				
				$file = $this->model->file_load('img');
				if($file) $insert['img'] = $file;
				
				$this->model->insert($insert);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['name'].'"</strong> успешно добавлена!', true));
				redirect('admin/'.$this->page);
			}
			catch(Exception $e)
			{
				if(!empty($file)) $this->model->file_delete($file);
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['size'] = $this->model->thumb_size();
		
		$this->add_script([
            PATH_PLUGINS.'/ckeditor/ckeditor.js',
			PATH_PLUGINS.'/bootstrap/plugins/datepicker.js',
			PATH_PLUGINS.'/jquery.inputmask/jquery.inputmask.min.js',
		]);
		
		$this->breadcrumbs->add('Добавить', '');
		
		$this->output($this->page.'/create');
	}
	
	public function edit()
	{
		$id = uri(4);
		
		$item = $this->model->getItem('id', $id);
		if(empty($item))
		{
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
			redirect('admin/'.$this->page);
		}
		
		$this->load->library('upload', $this->model->file_config());
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$file = $this->model->file_load('img');
				if($file) $insert['img'] = $file;
				
				$this->model->update($insert, $id);
				
				if($file) $this->model->file_delete($item['img']);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['name'].'"</strong> успешно обновлена!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				if(!empty($file)) $this->model->file_delete($file);
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		if($this->data['item']['is_read'] == 0)
			$this->model->update(['is_read' => 1], $id);
		
		$this->data['size'] = $this->model->thumb_size();
		
		$this->add_script([
			PATH_PLUGINS.'/bootstrap/plugins/datepicker.js',
			PATH_PLUGINS.'/jquery.inputmask/jquery.inputmask.min.js',
		]);
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
	
	public function view()
	{
		$id = uri(4);
		
		$this->data['item'] = $this->model->getItem('id', $id);
		if(empty($this->data['item']))
		{
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
			redirect('admin/'.$this->page);
		}
		
		if($this->data['item']['is_read'] == 0)
			$this->model->update(['is_read' => 1], $id);
		
		$this->breadcrumbs->add('Просмотр', '');
		
		$this->output($this->page.'/view');
	}
	
	public function delete()
	{
		$id = uri(4);
		$error = fa5s('exclamation-triangle mr5').' Ошибка данных POST!';
		
		try
		{
			if($_POST && $this->input->post('delete') == 'delete')
			{
				$item = $this->model->getItem('id', $id);
				if(empty($item))
					throw new Exception(fa5s('exclamation-triangle mr5').' Запись не найдена!');
				
				$this->model->delete($id);
				$this->model->file_delete($item['img']);
				$error = false;
			}
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
		
		if($error)
		{
			set_flash('result', action_result('error', $error, true));
		} else {
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$item['name'].'"</strong> успешно удалена!', true));
		}
		
		redirect('admin/'.$this->page);
	}
	
	
	# AJAX
	
	public function ajaxImageDelete()
	{
		$error = 'Ошибка данных POST';
		
		$id = uri(4);
		$type = $this->input->post('type');
		
		try
		{
			if($this->input->post('delete_img') == 'delete' && !empty($type))
			{
				$item = $this->model->getItem('id', $id);
				if(empty($item))
					throw new Exception('Запись не найдена!');
				
				$this->model->file_clear($id, $type);
				$this->model->file_delete($item[$type]);
				$error = false;
			}
		}
		catch(Exception $e)
		{
			$error = strip_tags($e->getMessage());
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['error' => $error]));
	}
}
