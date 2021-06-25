<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property Users_site_model model
 * @property Email_model email_model
 */

class Login extends SITE_Controller {

	protected $model = '';
	protected $page = 'login';
	
	public function __construct ()
	{
		parent::__construct();

		$this->model = $this->users_site_model;
	}
	
	public function index()
	{
		$this->init('cabinet_login');
		
		if($_POST)
		{
			try
			{
				$this->validate('login');
				
				$login = $this->input->post('login');
				$password = $this->input->post('password');
				
				$user = $this->model->getUserByLogin($login);
				
				if(empty($user))
					throw new Exception(fa5s('exclamation-triangle mr5').' Пользователь не найден!');
				
				if(!password_verify($password, $user['password']))
					throw new Exception(fa5s('exclamation-triangle mr5').' Пароль указан неверно!');
				
				if($user['delete'] == 1)
					throw new Exception(fa5s('exclamation-triangle mr5').' Ваш аккаунт был удален!');
				
				set_cookie(init_cookie('userid', $user['id']));
				set_cookie(init_cookie('hash', password_hash($user['id'].$user['hash'], PASSWORD_DEFAULT)));
				
				set_flash('site', action_result('success', fa5s('check mr5') . ' Добро пожаловать, <strong>' . $user['name'] . '</strong> в Ваш кабинет!'));
				
				$redirect = $this->input->post('redirect') ?? 'cabinet';
				redirect($redirect);
			}
			catch(Exception $e)
			{
				$this->data['error'] = action_result('error', $e->getMessage());
			}
		}
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
		
		$this->output('cabinet/common/login');
	}
	
	public function password()
	{
		$this->init('cabinet_recovery');
		
		if($_POST)
		{
			try
			{
				$this->validate('recovery');
				
				$login = $this->input->post('login');
				
				$user = $this->model->getUserByLogin($login);
				
				if(empty($user))
					throw new Exception(fa5s('exclamation-triangle mr5').' Пользователь не найден!');
				
				if($user['delete'] == 1)
					throw new Exception(fa5s('exclamation-triangle mr5').' Ваш аккаунт был удален!');
				
				$password = $this->model->generate_password();
				$hash = $this->model->generate_hash();
				
				$this->model->update(['password' => password_hash($password, PASSWORD_DEFAULT), 'hash' => $hash], ['id' => $user['id']]);
				
				$this->load->model('email_model');
				$this->email_model->send(['password' => $password], 'passwordRecovery', 'Восстановление пароля', $user['email']);
				
				set_flash('site', action_result('error', fa5s('check mr5') . " Пароль для пользователя <strong>{$login}</strong> был выслан на контактный e-mail"));
				
				redirect('login');
			}
			catch(Exception $e)
			{
				$this->data['error'] = action_result('error', $e->getMessage());
			}
		}
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
		
		$this->output('cabinet/common/password');
	}
	
	public function logout()
	{
		$this->model->logout();
		redirect('/');
	}

    public function login_social()
    {
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $this->input->post('token') . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);
        if($this->model->social($user))
            redirect('/');
        else
            redirect('cabinet/profile');
    }
}
