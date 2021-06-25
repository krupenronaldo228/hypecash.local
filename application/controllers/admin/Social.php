<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Social
 * @property Social_model model
 */

class Social extends ADMIN_Controller {

	public $page = 'social';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('social_model');
		$this->model = $this->social_model;
		
		$this->init($this->page);
		
	}
	
	public function index()
	{
		$count = $this->model->getCount();
		$pagination = admin_pagination($this->page.'/index', $count, 20);
		
		$this->data['items'] = $this->model->getFront();
		
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

				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$this->model->getKeys($insert['key'])['title'].'"</strong> успешно добавлена!', true));
				redirect("admin/{$this->page}");
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}

		$this->data['keys'] = array_column($this->model->getKeys(), 'title', 'key');

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
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$this->model->getKeys($item['key'])['title'].'"</strong> успешно обновлена!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;

		$this->data['keys'] = array_column($this->model->getKeys(), 'title', 'key');
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}

	public function delete()
	{
		$id = uri(4);
		$params = ['id' => $id];

		$error = fa5s('exclamation-triangle mr5').' Ошибка данных POST!';

		try
		{
			if($_POST && $this->input->post('delete') == 'delete')
			{
				$item = $this->model->getItem($params);
				if(empty($item))
					throw new Exception(fa5s('exclamation-triangle mr5').' Запись не найдена!');

				$this->model->delete($params);
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
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$this->model->getKeys($item['key'])['title'].'"</strong> успешно удалена!', true));
		}

		redirect("admin/{$this->page}");
	}
}
