<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 * @property Slider_model slider
 * @property Sitemap_model sitemap
 */

class Home extends SITE_Controller {

	protected $page = 'home';
	
	public function index()
	{
		$this->init($this->page);
		
		$this->load->model('slider_model', 'slider');
		$this->data['slider'] = $this->slider->getItems(['visibility' => 1], 'num DESC');
		
		$this->data['canonical'] = '/';
		
		$this->add_script(PATH_PLUGINS.'/owl.carousel/owl.carousel.min.js');

		$this->output('common/index');
	}


	# CAP
	
	public function cap()
	{
		$this->init();
		
		if($this->data['siteinfo']['enable'] == 1)
			redirect('/');
		
		$this->data['pageinfo'] = [
			'alias' => 'cap',
			'meta_title' => $this->data['siteinfo']['title'].' - '.$this->data['siteinfo']['cap_title'],
			'meta_keywords' => null,
			'meta_description' => null,
		];
		
		$this->data['template'] = 'site/common/cap';

		$this->output();
	}


	# SITEMAP
	
	public function sitemap()
	{
		$this->load->model('sitemap_model', 'sitemap');
		
		$error = $this->sitemap->generate();
		
		var_dump($error);
	}

    # CART

    public function cart()
    {
        $this->load->library('cart');
        $this->add_script([
            PATH_SITE.'site/js/cart.js',
        ]);
    }
}
