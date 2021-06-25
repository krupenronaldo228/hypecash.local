<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Articles
 * @property Shop_products_model model
 * @property Shop_categories_model categories
 */

class Shop_products extends ADMIN_Controller {

	public $page = 'shop-products';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('shop_products_model');
		$this->model = $this->shop_products_model;

        $this->load->model('shop_categories_model');
        $this->categories = $this->shop_categories_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$this->data['count'] = $count = $this->model->filter_admin()->getCount();
		$pagination = admin_pagination($this->page.'/index', $count);

		$sort = $this->input->get('sort');
		if(empty($sort)) $sort = 'pub_date DESC';
		$this->data['sort'] = $sort;

		$this->data['items'] = $this->model->filter_admin()->getItems([], $sort, $pagination['per_page'], $pagination['offset']);
       # $this->data['wood'] = $this->model->getTreeAdmin();

		$this->load->library('pagination', $pagination);
		
		$this->output($this->page.'/index');
	}
	
	public function create()
	{
        $id = uri(4);

        $item = $this->model->getItem('id', $id);

		$this->load->library('upload', $this->model->file_config());
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$file = $this->model->file_load('img');
				if($file) $insert['img'] = $file;
				
				$this->model->insert($insert);
                $this->categories->updateDisplay();
				set_flash('result', action_result('success', fa5s('check mr5').' Товар <strong>"'.$insert['title'].'"</strong> успешно добавлен!', true));
				redirect('admin/'.$this->page);
			}
			catch(Exception $e)
			{
				if(!empty($file)) $this->model->file_delete($file);
				$this->data['error'] = $e->getMessage();
			}
		}
        $this->data['item'] = $item;

        $this->data['size'] = $this->model->thumb_size();

       $this->data['parents'] = $this->categories->getTreeAdmin();
		
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
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Товар не найден!', true));
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

                $this->categories->updateDisplay();
				
				if($file) $this->model->file_delete($item['img']);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Товар <strong>"'.$insert['title'].'"</strong> успешно обновлен!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				if(!empty($file)) $this->model->file_delete($file);
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		$this->data['size'] = $this->model->thumb_size();

        $this->data['parents'] = $this->categories->getTreeAdmin();
		
		$this->add_script([
			PATH_PLUGINS.'/ckeditor/ckeditor.js',
			PATH_PLUGINS.'/bootstrap/plugins/datepicker.js',
			PATH_PLUGINS.'/jquery.inputmask/jquery.inputmask.min.js',
		]);
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
	
	public function view()
	{
		$this->data['item'] = $this->model->getItem('id', uri(4));
		if(empty($this->data['item']))
		{
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Товар не найден!', true));
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
					throw new Exception(fa5s('exclamation-triangle mr5').' Товар не найден!');
				
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
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Товар <strong>"'.$item['title'].'"</strong> успешно удален!', true));
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
					throw new Exception('Товар не найдена!');
				
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
