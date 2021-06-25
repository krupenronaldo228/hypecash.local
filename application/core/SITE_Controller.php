<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class SITE_Controller
 * @property CI_Loader load
 * @property CI_Input input
 * @property CI_Output output
 * @property CI_Config config
 * @property CI_DB_query_builder db
 * @property CI_Form_validation form_validation
 * @property CI_Pagination pagination
 * @property CI_Security security
 * @property CI_Session session
 * @property CI_URI uri
 * @property Base_model base_model
 * @property Settings_model settings_model
 * @property Template_model template
 * @property Social_model social
 * @property Breadcrumbs breadcrumbs
 * @property Users_site_model users_site_model
 */

class SITE_Controller extends CI_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('base_model');
		$this->load->model('template_model', 'template');
		$this->load->model('users_site_model');

		$this->check_redirects();
	}
	
	# BASIC

	public function init($page = null)
	{
		$settings = $this->template->getSettings();
		if (empty($settings)) exit('No current settings');
		
		# check enable
		
		$this->check_enable($settings['enable']);

		$user_data = $this->check_auth();

		
		# create data
		
		$this->data = [
			'siteinfo'	=> $settings,
			'pageinfo'	=> $this->template->getPage($page),

			'nav_header' => $this->template->getNavigation('top'),
			'nav_footer'=> $this->template->getNavigation('footer'),
			'nav_mobile'=> $this->template->getNavigation('mobile'),
			
			'error'		=> false,
			'csrf'		=> $this->security->get_csrf_hash(),
			
			'version'	=> '?v='.$settings['template_version'],
			'styles'	=> [],
			'scripts'	=> [],
		];

		# user data

		$this->data = array_merge($this->data, $user_data);


		# social

		$this->load->model('social_model', 'social');
		$this->data['socials'] = $this->social->getFront(['visibility' => 1]);

	}
	
	public function output($view = null)
	{
		$this->data['seo'] = $this->siteseo();
		
		if(!is_null($view))
			$this->data['view'] = $view;
		
		$template = empty($this->data['template'])
			? 'site/common/template'
			: $this->data['template'];
		
		$this->load->view($template, $this->data);
	}

	public function siteseo()
	{
		$seo = [];

		$siteinfo = $this->data['siteinfo'];
		$pageinfo = $this->data['pageinfo'];
		$item = $this->data['item'] ?? [];


		# META

		if (isset($item['meta_title'])) $seo['title'] = $item['meta_title'];
		elseif (isset($pageinfo['meta_title'])) $seo['title'] = $pageinfo['meta_title'];
		else $seo['title'] = $siteinfo['title'];

		if (isset($item['meta_description'])) $seo['description'] = $item['meta_description'];
		elseif (isset($pageinfo['meta_description'])) $seo['description'] = $pageinfo['meta_description'];
		else $seo['description'] = null;

		$seo['title'] = htmlspecialchars($seo['title']);
		$seo['description'] = htmlspecialchars($seo['description']);
		$seo['keywords'] = null;

		$seo['canonical'] = base_url($this->data['canonical'] ?? $this->uri->uri_string);


		# OPEN GRAPH

		$seo['og'] = [
			'type' => 'website',
			'title' => htmlspecialchars($seo['title']),
			'description' => htmlspecialchars($seo['description']),
			'url' => $seo['canonical'],
			'site_name' => htmlspecialchars($siteinfo['title']),
		];

		$og_image = PATH_SITE . '/img/og_image.jpg';
		if(!empty($this->data['og_image']) && file_exists('./'.$this->data['og_image']) && !is_dir('./'.$this->data['og_image']))
		{
			$og_image =  trim($this->data['og_image'], '/');
		}

		if(file_exists('./'.$og_image))
		{
			$og_image_size = getimagesize('./'.$og_image);
			$seo['og']['image'] = base_url($og_image);
			$seo['og']['image:type'] = $og_image_size['mime'];
			$seo['og']['image:width'] = $og_image_size[0];
			$seo['og']['image:height'] = $og_image_size[1];
		}


		# RETURN

		return $seo;
	}
	
	private function check_enable($enable)
	{
		if($enable == 0)
		{
			$admin = get_cookie('adminid');
			if(empty($admin) && uri(1) != 'cap')
				redirect('cap');
		}
	}

	private function check_redirects()
	{
		$request = $_SERVER['REQUEST_URI'];

		$check = $this->template->getRedirect(['url_from' => $request]);
		if(!empty($check))
		{
			redirect($check['url_to'], 'location', 301);
			exit();
		}
	}

	private function check_auth()
	{
		$userid = get_cookie('userid');
		$hash = get_cookie('hash');
		$user = [];

		if (!is_null($userid))
		{
			$user = $this->users_site_model->getItem(['id' => $userid, 'delete' => 0]);

			if (empty($user) or !password_verify($user['id'].$user['hash'], $hash))
			{
				$user = [];
				$this->users_site_model->logout();
			}
		}

		if (uri(1) == 'cabinet')
		{
			if (empty($user))
			{
				set_flash('site', action_result('error', fa5s('exclamation-triangle mr5') . ' Для входа в кабинет необходима авторизация!'));
				redirect('login');
			}

			$this->data['nav_cabinet'] = $this->template->getNavigationCabinet();
			$cabinet_page = $this->template->getPage('cabinet');
			$this->breadcrumbs->add($cabinet_page['name'], uri(1));
		}

		return [
			'userid' => $userid,
			'userinfo' => $user,
		];
	}
	
	# HELPERS
	
	public function add_style($files)
	{
		if(is_array($files))
		{
			foreach($files as $file) $this->data['styles'][] = $file;
		} else {
			$this->data['styles'][] = $files;
		}
		
		return $this;
	}
	
	public function add_script($files)
	{
		if(is_array($files))
		{
			foreach($files as $file) $this->data['scripts'][] = $file;
		} else {
			$this->data['scripts'][] = $files;
		}
		
		return $this;
	}
	
	public function validate($group)
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
		
		if($this->form_validation->run($group))
			return true;
		
		$message = fa5s('exclamation-triangle fa-fw mr5') . ' Проверьте правильность заполненных полей.' .
			'<ul class="note-list">'.validation_errors('<li>', '</li>').'</ul>';
			
		throw new Exception($message);
	}
}
