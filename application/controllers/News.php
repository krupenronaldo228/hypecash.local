<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class News
 * @property News_model news
 */

class News extends SITE_Controller {
	
	public	$page = 'news';
	private	$model = '';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('news_model', 'news');
		
		$this->init($this->page);
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
	}
	
	public function index()
	{
		$params = ['visibility' => 1, 'pub_date <=' => date('Y-m-d H:i:s')];
		
		$count = $this->news->getCount($params);
		$pagination = site_pagination($this->page, $count);
		
		$this->data['items'] = $this->news->getItems($params, 'pub_date DESC', $pagination['per_page'], $pagination['offset']);
		
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->data['canonical'] = $this->page;
		
		$this->output('pages/news-list');
	}
	
	public function view()
	{
		$date = date('Y-m-d H:i:s');
		$params = ['alias' => uri(2), 'visibility' => 1, 'pub_date <=' => $date];
		
		$item = $this->news->getItem($params);
		if(empty($item)) show_404();
		
		$this->data['item'] = $item;


		# get extra
		
		$similar = ['id !=' => $item['id'], 'visibility' => 1, 'pub_date <=' => $date];
		$this->data['similar'] = $this->news->getItems($similar, 'RANDOM', 3);


		# output

		$this->data['og_image'] = PATH_UPLOADS.'/'.$this->page.'/'.$item['img'];
		
		$this->breadcrumbs->add($item['title'], $this->page.'/'.$item['alias']);
		
		$this->add_script('assets/plugins/share42/share.js');
		
		$this->output('pages/news-view');
	}
}
