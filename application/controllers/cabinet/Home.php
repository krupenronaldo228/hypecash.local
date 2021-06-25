<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 */

class Home extends SITE_Controller {

	public $page = 'cabinet';
	
	public function __construct ()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->init($this->page);
		
		$this->data['subview'] = 'common/index';
		
		$this->output('cabinet/common/template');
	}
}
