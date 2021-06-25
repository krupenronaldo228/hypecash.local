<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 * @property Feedback_model feedback
 * @property Reviews_model reviews
 * @property News_model news
 * @property Articles_model articles
 * @property Pages_model pages
 */

class Home extends ADMIN_Controller {
	
	public $page = 'home';
	
	public function index()
	{
		$this->init($this->page);
		
		$this->load->model('feedback_model', 'feedback');
		$this->data['counter']['feedback'] = $this->feedback->getCount(['is_read' => 0]);
		$this->data['feedbacks'] = $this->feedback->getItems([], 'add_date DESC', 10);
		
		$this->load->model('reviews_model', 'reviews');
		$this->data['reviews'] = $this->reviews->getItems([], 'add_date DESC', 10);
		
		$this->load->model('news_model', 'news');
		$this->data['counter']['news'] = $this->news->getCount();
		$this->data['news'] = $this->news->getItems(null, 'add_date DESC', 3);
		
		$this->load->model('articles_model', 'articles');
		$this->data['counter']['articles'] = $this->articles->getCount();
		$this->data['articles'] = $this->articles->getItems(null, 'add_date DESC', 3);
		
		$this->load->model('pages_model', 'pages');
		$this->data['counter']['pages'] = $this->pages->getCount();
		
		$this->data['pagecontent'] = false;
		
		$this->output('common/index');
	}
	
	public function common()
	{
		$this->init($this->page);
		
		$this->breadcrumbs->add('Элементы управления', null);
		
		$this->output('common/common');
	}
	
	public function errors()
	{
		$this->init($this->page);
		
		$this->data['pageinfo']['title'] = 'Ошибка 404';
		$this->data['pageinfo']['meta_title'] = 'Ошибка 404';
		
		$this->breadcrumbs->add('Ошибка 404', null);

		$this->output->set_status_header('404');
		
		$this->output('common/error404');
	}
}
