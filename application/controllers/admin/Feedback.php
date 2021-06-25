<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback
 * @property Feedback_model model
 */

class Feedback extends ADMIN_Controller {

	public $page = 'feedback';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('feedback_model');
		$this->model = $this->feedback_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$count = $this->model->getCount();
		$pagination = admin_pagination(uri(2).'/index', $count);

		$this->data['items'] = $this->model->getItems(null, 'is_read ASC, add_date DESC', $pagination['per_page'], $pagination['offset']);

		$this->load->library('pagination');
		$this->pagination->initialize($pagination);

		$this->output($this->page.'/index');
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
