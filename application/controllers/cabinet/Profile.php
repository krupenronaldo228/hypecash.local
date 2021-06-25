<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Profile
 * @property Users_site_model model
 */

class Profile extends SITE_Controller {
	
	private $model = '';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->model = $this->users_site_model;
	}

	public function index()
	{
		$this->init('cabinet_profile');
		
		$this->load->library('upload', $this->model->file_config());
		
		if($_POST)
		{
			try
			{
				$action = $this->input->post('action');
				
				switch($action)
				{
					case 'profile':
						$this->updateProfile();
						break;
						
					case 'password':
						$this->updatePassword();
						break;
						
					case 'photo':
						$this->updatePhoto();
						break;
						
					default:
						throw new Exception(fa5s('exclamation-triangle mr5').' Ошибка данных POST!');
					
				}
				
				redirect(current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = action_result('error', $e->getMessage());
			}
		}
		
		$this->data['size'] = $this->model->thumb_size();
		
		$this->add_script('assets/plugins/jquery.inputmask/jquery.inputmask.min.js');
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], uri(1).'/'.uri(2));
		
		$this->data['subview'] = 'pages/profile';
		$this->output('cabinet/common/template');
	}
	
	
	# ACTIONS
	
	protected function updateProfile()
	{
		$id = $this->data['userid'];
		
		$this->validate('profile');
		
		$insert = $this->model->post_profile();
		$this->model->update($insert, $id);
		
		set_flash('site', action_result('success', fa5s('check mr5').' Личные данные успешно обновлены!', true));
	}
	
	protected function updatePassword()
	{
		$id = $this->data['userid'];
		
		$this->validate('password');
		
		$insert = $this->model->post_password();
		
		if(!password_verify($this->input->post('old_password'), $this->data['userinfo']['password']))
			throw new Exception(fa5s('exclamation-triangle mr5').' Старый пароль указан неверно!');
		
		$this->model->update($insert, $id);
		
		$userhash = init_cookie('hash', password_hash($id.$insert['hash'], PASSWORD_DEFAULT));
		set_cookie($userhash);
		
		set_flash('site', action_result('success', fa5s('check mr5').' Пароль успешно обновлен!', true));
	}
	
	protected function updatePhoto()
	{
		$id = $this->data['userid'];
		
		$file = $this->model->file_load('img');
		if(empty($file))
			throw new Exception(fa5s('exclamation-triangle mr5').' Файл не указан!');
		
		$this->model->update(['img' => $file], $id);
		
		$this->model->file_delete($this->data['userinfo']['img']);
		
		
		set_flash('site', action_result('success', fa5s('check mr5').' Фото профиля успешно обновлено!', true));
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
