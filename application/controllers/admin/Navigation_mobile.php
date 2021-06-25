<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Navigation_mobile
 * @property Navigation_model model
 */

class Navigation_mobile extends ADMIN_Controller {

	public $page = 'navigation_mobile';
	public $nesting = false;
	
	private $view = 'navigation';
	private $rules = 'navigation';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('navigation_model');
		$this->model = $this->navigation_model;
		
		$this->init($this->page);
		
		$this->data['position'] = 'mobile';
	}
	
	public function index()
	{
		$this->data['items'] = $this->model->getTree(['position' => $this->data['position']]);
		
		$this->output($this->view.'/index');
	}
	
	public function create()
	{
		if($_POST)
		{
			try
			{
				$this->validate($this->rules);
				
				$insert = $this->model->post();
				
				$this->model->insert($insert);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно добавлена!', true));
				redirect('admin/'.$this->page);
			
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['parents'] = $this->model->getItems(['id_parent' => 0, 'position' => $this->data['position']], 'num|DESC');
		
		$this->breadcrumbs->add('Добавить', '');
		
		$this->output($this->view.'/create');
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
				$this->validate($this->rules);
				
				$insert = $this->model->post();
				
				$this->model->update($insert, $id);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно обновлена!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		$this->data['parents'] = $this->model->getItems(['id_parent' => 0, 'position' => $this->data['position']], 'num|DESC');
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->view.'/edit');
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
				
				$check = $this->model->getCount('id_parent', $id);
				if($check != 0)
					throw new Exception(fa5s('exclamation-triangle mr5').' Невозможно удалить! Раздел содержит дочерние записи: <strong>' . $check . '</strong>');
				
				$this->model->delete($id);
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
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$item['title'].'"</strong> успешно удалена!', true));
		}
		
		redirect('admin/'.$this->page);
	}
}
