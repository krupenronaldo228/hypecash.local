<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Slider
 * @property Slider_model model
 */

class Slider extends ADMIN_Controller {
	
	public $page = 'slider';
	
	function __construct ()
	{	
		parent::__construct();

		$this->load->model('slider_model');
		$this->model = $this->slider_model;
		
		$this->init($this->page);
	}
	
	public function index()
	{
		$count = $this->model->getCount();
		$pagination = admin_pagination($this->page.'/index', $count);
		
		$this->data['items'] = $this->model->getItems(null, 'num DESC', $pagination['per_page'], $pagination['offset']);
		
		$this->load->library('pagination');
		$this->pagination->initialize($pagination);
		
		$this->output($this->page.'/index');
	}
	
	public function create()
	{
		$this->load->library('upload', $this->model->file_config());
		
		$imgs = $this->model->thumb_size();
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$files_error = null;
				$files = $this->model->file_multiload([Slider_model::IMG_MAIN, Slider_model::IMG_MOBILE]);
				if($files['error']) $files_error = $files['error'];
				unset($files['error']);
				
				if(!empty($files))
					$insert = array_merge($insert, $files);
				
				$this->model->insert($insert);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно добавлена!'.$files_error, true));
				redirect('admin/'.$this->page);
			}
			catch(Exception $e)
			{
				if(!empty($files))
				{
					foreach ($files as $file)
						$this->model->file_delete($file);
				}
				
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['imgs'] = $imgs;
		$this->data['aligns'] = $this->model->aligns();
		
		$this->breadcrumbs->add('Добавить', '');
		
		$this->output($this->page.'/create');
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
		
		$this->load->library('upload', $this->model->file_config());
		
		$imgs = $this->model->thumb_size();
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post();
				
				$files_error = null;
				$files = $this->model->file_multiload([Slider_model::IMG_MAIN, Slider_model::IMG_MOBILE]);
				if($files['error']) $files_error = $files['error'];
				unset($files['error']);
				
				if(!empty($files))
					$insert = array_merge($insert, $files);
				
				$this->model->update($insert, $id);
				
				foreach($files as $key => $file)
					$this->model->file_delete($item[$key]);
				
				set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['title'].'"</strong> успешно обновлена!'.$files_error, true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				if(!empty($files))
				{
					foreach($files as $key => $file)
						$this->model->file_delete($file);
				}
				
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->data['item'] = $item;
		
		$this->data['imgs'] = $imgs;
		$this->data['aligns'] = $this->model->aligns();
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
	
	public function delete()
	{
		$id = uri(4);
		$error = fa5s('exclamation-triangle mr5').' Ошибка данных POST!';
		
		try
		{
			if($_POST && $this->input->post('delete') == 'delete')
			{
				$item = $this->model->getItem('id', $id);
				if(empty($item))
					throw new Exception(fa5s('exclamation-triangle mr5').' Запись не найдена!');
				
				$this->model->delete($id);
				
				$imgs = $this->model->thumb_size();
				foreach($imgs as $key => $file)
					$this->model->file_delete($item[$key]);
				
				$error = false;
			}
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
		
		if($error)
		{
			set_flash('result', action_result('error', $error, true));
		} else {
			set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$item['title'].'"</strong> успешно удалена!', true));
		}
		
		redirect('admin/'.$this->page);
	}

}
