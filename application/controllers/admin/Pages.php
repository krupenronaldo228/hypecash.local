<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Pages
 * @property Pages_model model
 */

class Pages extends ADMIN_Controller {

	public $page = 'pages';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('pages_model');
		$this->model = $this->pages_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$count = $this->model->getCount();
		$pagination = admin_pagination($this->page.'/index', $count);
		
		$this->data['items'] = $this->model->getItems(null, 'add_date DESC', $pagination['per_page'], $pagination['offset']);
		
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->output($this->page.'/index');
	}
	
	public function create()
	{
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$this->model->insert($insert);
				
				$this->model->change_routes();
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно добавлена!', true));
				redirect('admin/'.$this->page);
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->add_script(PATH_PLUGINS.'/ckeditor/ckeditor.js');
		
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
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$this->model->update($insert, $id);
				
				$this->model->change_routes();
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно обновлена!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		$this->add_script(PATH_PLUGINS.'/ckeditor/ckeditor.js');
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
	
	public function view()
	{
		$this->data['item'] = $this->model->getItem('id', uri(4));
		if(empty($this->data['item']))
		{
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
			redirect('admin/'.$this->page);
		}
		
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
				$error = false;
				
				$this->model->change_routes();
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
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$item['title'].'"</strong> успешно удалена!', true));
		}
		
		redirect('admin/'.$this->page);
	}
}
