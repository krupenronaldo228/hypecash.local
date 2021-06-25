<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends ADMIN_Controller {
	
	private $page = 'home';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->init('');
		
		$this->data['pageinfo'] = array(
			'title' => 'Готовые стили',
			'name' => 'Готовые стили',
			'link' => 'common',
			'mTitle' => 'Готовые стили'
		);
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->data['pageinfo']['link']);
	}
	
	public function index()
	{
		$this->output('common/common/index');
	}
	
	
	/* TYPOGRAPHY */
	
	public function typography()
	{
		$page = 'Typography';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/typography');
	}
	
	public function labels()
	{
		$page = 'Labels';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/labels');
	}
	
	public function lists()
	{
		$page = 'Lists';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/lists');
	}
	
	public function tables()
	{
		$page = 'Tables';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/tables');
	}
	
	
	/* FORMS */
	
	public function buttons()
	{
		$page = 'Buttons';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/buttons');
	}
	
	public function inputs()
	{
		$page = 'Inputs';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/inputs');
	}
	
	public function checkers()
	{
		$page = 'Checkers';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/checkers');
	}
	
	public function forms()
	{
		$page = 'Form stuff';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/forms');
	}
	
	
	/* ELEMENTS */
	
	public function grid()
	{
		$page = 'Bootstrap grid';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/grid');
	}
	
	public function colors()
	{
		$page = 'Colors';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/colors');
	}
	
	public function dropdowns()
	{
		$page = 'Dropdowns';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/dropdowns');
	}
	
	public function alerts()
	{
		$page = 'Alerts, notes';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/alerts');
	}
	
	public function tags()
	{
		$page = 'Tags';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/tags');
	}
	
	public function panels()
	{
		$page = 'Panels';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/panels');
	}
	
	public function tabs()
	{
		$page = 'Tabs';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/tabs');
	}
	
	public function tiles()
	{
		$page = 'Tiles';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/tiles');
	}
	
	public function flags()
	{
		$page = 'Flags';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/flags');
	}
	
	
	/* PLUGINS */
	
	public function modals()
	{
		$page = 'Bootstrap modals';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/modals');
	}
	
	public function calendars()
	{
		$page = 'Bootstrap calendars';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script('assets/plugins/bootstrap/plugins/datepicker.js');
		
		$this->output('common/common/calendars');
	}
	
	public function tooltips()
	{
		$page = 'Bootstrap tooltips';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/tooltips');
	}
	
	public function editor()
	{
		$page = 'CKEditor';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script('assets/plugins/ckeditor/ckeditor.js');
		
		$this->output('common/common/editor');
	}
	
	
	/* FEATURES */
	
	public function clipboard()
	{
		$page = 'Clipboard';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script('assets/plugins/clipboard/clipboard.min.js');
		
		$this->output('common/common/clipboard');
	}
	
	
	/* TEMPLATES */
	
	public function template_entries()
	{
		$page = 'Entries list';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->data['count'] = 100;
		$pagination = admin_pagination(uri(2).'/'.uri(3), $this->data['count']);
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->output('common/common/template-entries');
	}
	
	public function template_tree()
	{
		$page = 'Entries tree';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->data['items'] = [
			[
				'id' => 1, 'parent' => 0, 'title' => 'Audi',
				'childs' => [
					[
						'id' => 2, 'parent' => 1, 'title' => 'A-series',
						'childs' => [
							['id' => 3, 'parent' => 2, 'title' => 'A3'],
							['id' => 4, 'parent' => 2, 'title' => 'A4'],
							['id' => 5, 'parent' => 2, 'title' => 'A5'],
							['id' => 6, 'parent' => 2, 'title' => 'A6'],
							['id' => 7, 'parent' => 2, 'title' => 'A7'],
							['id' => 8, 'parent' => 2, 'title' => 'A8'],
						],
					],
					[
						'id' => 9, 'parent' => 1, 'title' => 'Q-series',
						'childs' => [
							['id' => 10, 'parent' => 9, 'title' => 'Q3'],
							['id' => 11, 'parent' => 9, 'title' => 'Q5'],
							['id' => 12, 'parent' => 9, 'title' => 'Q7'],
							['id' => 13, 'parent' => 9, 'title' => 'Q8'],
						],
					],
				],
			],
			[
				'id' => 14, 'parent' => 0, 'title' => 'BMW',
				'childs' => [
					['id' => 15, 'parent' => 14, 'title' => '1-series'],
					['id' => 16, 'parent' => 14, 'title' => '2-series'],
					['id' => 17, 'parent' => 14, 'title' => '3-series'],
					['id' => 18, 'parent' => 14, 'title' => '4-series'],
					['id' => 19, 'parent' => 14, 'title' => '5-series'],
				],
			],
			['id' => 20, 'parent' => 0, 'title' => 'Volkswagen']
		];
		
		$this->output('common/common/template-tree');
	}
	
	public function template_view()
	{
		$page = 'Entries view';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->output('common/common/template-view');
	}
	
	public function template_form()
	{
		$page = 'Page form';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script('assets/plugins/ckeditor/ckeditor.js');
		
		$this->output('common/common/template-form');
	}
	
	public function template_gallery()
	{
		$page = 'Gallery';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script([
			'assets/plugins/vix-gallery/js/jquery.vix-gallery.js',
		]);
		
		$this->add_style([
			'assets/plugins/vix-gallery/css/gallery.css',
		]);
		
		$this->output('common/common/template-gallery');
	}
	
	public function dragndrop()
	{
		$page = 'Drag & Drop';
		$this->data['item']['title'] = $page;
		$this->breadcrumbs->add($page, '');
		
		$this->add_script([
			'assets/plugins/vix-gallery/js/jquery.vix-gallery.js',
		]);
		
		$this->output('common/common/dragndrop');
	}
}
