<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Contacts
 * @property Feedback_model feedback
 * @property Email_model email_model
 */

class Contacts extends SITE_Controller {
	
	public $page = 'contacts';
	
	public function index()
	{
		$this->init($this->page);
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
		
		$this->output('pages/contacts');
	}
	
	
	# AJAX
	
	public function ajaxFeedback()
	{
		$this->output->set_content_type('application/json');
		
		$error = 'Ошибка данных POST!';
		
		if($_POST)
		{
			try
			{
				$this->validate('feedback');
				
				$this->load->model('feedback_model', 'feedback');
				$insert = $this->input->post(null, true);
				$insert['is_read'] = 0;

				$insert['id'] = $this->feedback->insert($insert);
				
				$this->load->model('email_model');
				$this->email_model->send($insert, 'newFeedback', 'Обратная связь - '.$insert['title']);
				
				$error = false;
			}
			catch(Exception $e)
			{
				
				$error = strip_tags($e->getMessage());
			}
		}

		$this->output->set_output(json_encode(['error'=> $error]));
	}
}