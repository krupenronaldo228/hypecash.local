<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Pageinfo
 * @property Pageinfo_model model
 */

class Pageinfo extends ADMIN_Controller {

	public $page = 'pageinfo';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('pageinfo_model');
		$this->model = $this->pageinfo_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$params = ['access' => 1];
		
		$count = $this->model->getCount($params);
		$pagination = admin_pagination(uri(2).'/index', $count);
		
		$this->data['items'] = $this->model->getItems(null, 'title ASC', $pagination['per_page'], $pagination['offset']);
		
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->output($this->page.'/index');
	}
	
	public function edit()
	{
		$id = uri(4);
		
		$item = $this->model->getItem('id', $id);
		if(empty($item))
		{
			set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
			redirect('admin/'.$this->page);
		}
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$this->model->update($insert, $id);
				
				if(isset($insert['thumb_x']) && isset($insert['thumb_y']))
				{
					if($insert['thumb_x'] != $item['thumb_x'] || $insert['thumb_y'] != $item['thumb_y'])
					{
						$this->model->thumbResize($item['alias'], $insert['thumb_x'], $insert['thumb_y'], $item['thumb_type']);
					}
				}
				
				set_flash('result', action_result('success', fa5s('check mr5').' Раздел <strong>"'.$insert['name'].'"</strong> успешно обновлен!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		$this->add_script(PATH_PLUGINS.'/ckeditor/ckeditor.js');
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
}
