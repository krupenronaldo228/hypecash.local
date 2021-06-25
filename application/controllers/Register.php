<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Register
 * @property Users_site_model model
 */

class Register extends SITE_Controller {

	public $page = 'register';
	private $model = '';
	
	public function __construct ()
	{
		parent::__construct();
		$this->model = $this->users_site_model;
	}
	
	public function index()
	{
		$this->init('cabinet_register');
		
		if($_POST)
		{
			try
			{
				$this->validate('register');
				
				$insert = $this->model->post_insert();
				$id = $this->model->insert($insert);
				
				set_cookie(init_cookie('userid', $id));
				set_cookie(init_cookie('hash', password_hash($id.$insert['hash'], PASSWORD_DEFAULT)));
				
				set_flash('site', action_result('success', fa5s('check mr5') . ' Вы успешно зарегистрировались!'));
				
				$redirect = $this->input->post('redirect') ?? 'cabinet';
				redirect($redirect);
			}
			catch(Exception $e)
			{
				$this->data['error'] = action_result('error', $e->getMessage());
			}
		}
		
		$this->add_script('assets/plugins/jquery.inputmask/jquery.inputmask.min.js');
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
		
		$this->output('cabinet/common/register');
	}
	
	
	# VALIDATION
	
	public function check_login($value, $id = null)
	{
		if($this->model->check_unique($value, 'login', $id)) return true;
		$this->form_validation->set_message('check_login', '{field} <strong>'.$value.'</strong> уже есть в базе!');
		return false;
	}
	
	public function check_email($value, $id = null)
	{
		if($this->model->check_unique($value, 'email', $id)) return true;
		$this->form_validation->set_message('check_email', '{field} <strong>'.$value.'</strong> уже есть в базе!');
		return false;
	}
	
	public function check_phone($value, $id = null)
	{
		if($value == '') return true;
		if($this->model->check_unique($value, 'phone', $id)) return true;
		$this->form_validation->set_message('check_phone', '{field} <strong>'.$value.'</strong> уже есть в базе!');
		return false;
	}
}
