<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Settings_template
 * @property Settings_model model
 */

class Settings_template extends ADMIN_Controller {
	
	public $page = 'settings_template';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->model = $this->settings_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$this->output($this->page.'/index');
	}
	
	public function edit()
	{
		$this->load->library('upload', $this->load->library('upload', [
			'upload_path'	=> './'.PATH_SITE.'/img/',
			'allowed_types'	=> 'jpg|png',
			'max_size'		=> 2048,
			'encrypt_name'	=> true,
			'remove_spaces'	=> false,
			'overwrite'		=> true,
		]));

		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post_template();

				$this->model->favicon($this->data['siteinfo']['title']);

				$this->model->og_image();

				$this->model->siteinfo_update($insert);

				set_flash('result', action_result('success', fa5s('check mr5').' Настройки успешно изменены!', true));
				redirect(uri(4) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}

}
