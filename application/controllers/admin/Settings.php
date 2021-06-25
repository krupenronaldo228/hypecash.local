<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Settings
 * @property Settings_model model
 * @property Redirects_model redirects
 */

class Settings extends ADMIN_Controller {
	
	public $page = 'settings';
	
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
		$this->load->library('upload', $this->model->file_config());
		
		if($_POST)
		{
			try
			{
				$this->validate($this->page);
				
				$insert = $this->model->post_main();
				
				$file = $this->model->file_load('image');
				if($file) $insert['image'] = 'logo.' . pathinfo(PATH_UPLOADS.'/settings/' . $file, PATHINFO_EXTENSION);
				
				$this->model->siteinfo_update($insert);
				
				if($file)
				{
					$this->model->file_delete($this->data['siteinfo']['image']);
					rename('./'.PATH_UPLOADS.'/settings/'.$file, './'.PATH_UPLOADS.'/settings/'. $insert['image']);
				}
				
				set_flash('result', action_result('success', fa5s('check mr5').' Настройки успешно изменены!', true));
				redirect(uri(4) == 'close' ? '/admin/'.$this->page : current_url());
			}
			catch(Exception $e)
			{
				if(!empty($file)) $this->model->file_delete($file);
				$this->data['error'] = $e->getMessage();
			}
		}
		
		$this->breadcrumbs->add('Редактирование', '');
		
		$this->output($this->page.'/edit');
	}
	
	public function cache()
	{
		try
		{
			$this->model->cache();
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
		
		if(!empty($error))
		{
			set_flash('result', action_result('error', $error, true));
		} else {
			set_flash('result', action_result('success', fa5s('sync-alt mr5').' <strong>Кэш сайта</strong> успешно обновлен!', true));
		}
		
		redirect('admin/'.$this->page);
	}
	
	public function robots()
	{
		$file = './robots.txt';
		
		if($_POST)
		{
			$text = $this->input->post('text');
			file_put_contents($file, $text);
			
			set_flash('result', action_result('success', fa5s('check mr5').' <strong>Robots.txt</strong> успешно обновлен!', true));
			redirect(uri(4) == 'close' ? '/admin/'.$this->page : current_url());
		}
		
		$this->data['file'] = file_get_contents($file);
		
		$this->breadcrumbs->add('Robots.txt', '');
		
		$this->output($this->page.'/editor');
	}
	
	public function htaccess()
	{
		$file = './.htaccess';
		
		if($_POST)
		{
			$text = $this->input->post('text');
			file_put_contents($file, $text);
			
			set_flash('result', action_result('success', fa5s('check mr5').' <strong>.htaccess</strong> успешно обновлен!', true));
			redirect(uri(4) == 'close' ? '/admin/'.$this->page : current_url());
		}
		
		$this->data['file'] = file_get_contents($file);
		
		$this->breadcrumbs->add('.htaccess', '');
		
		$this->output($this->page.'/editor');
	}



	# REDIRECTS



	public function redirects()
	{
		$this->load->model('redirects_model', 'redirects');

		$this->data['search'] = $this->input->get('search');

		$this->data['count'] = $this->redirects->getCount();
		$pagination = admin_pagination($this->page.'/redirects', $this->data['count'], 20);

		$this->data['items'] = $this->redirects->getItems(null, null, $pagination['per_page'], $pagination['offset']);

		$this->load->library('pagination');
		$this->pagination->initialize($pagination);

		$this->data['pageinfo']['title'] = 'Редиректы';

		$this->breadcrumbs->add('Редиректы', $this->page.'/redirects');

		$this->output($this->page.'/redirects');
	}

	public function redirects_create()
	{
		$this->load->model('redirects_model', 'redirects');

		if($_POST)
		{
			try
			{
				$this->validate('redirects');

				$insert = $this->redirects->post();

				$this->redirects->insert($insert);

				set_flash('result', action_result('success', fa('check mr5').' Редирект <strong>"'.$insert['url_from'].'"</strong> успешно добавлен!', true));
				redirect('admin/'.$this->page.'/redirects');

			} catch(Exception $e) {

				$this->data['error'] = $e->getMessage();
			}
		}

		$this->data['pageinfo']['title'] = 'Добавить редирект';

		$this->breadcrumbs
			->add('Редиректы', $this->page.'/redirects')
			->add('Добавить', '');

		$this->output($this->page.'/redirects_create');
	}

	public function redirects_edit()
	{
		$this->load->model('redirects_model', 'redirects');

		$id = uri(4);

		$item = $this->redirects->getItem('id', $id);
		if(empty($item))
		{
			set_flash('result', action_result('error', fa('warning mr5').' Запись не найдена!', true));
			redirect('admin/'.$this->page.'/redirects');
		}

		if($_POST)
		{
			try
			{
				$this->validate('redirects');

				$insert = $this->redirects->post();

				$this->redirects->update($insert, $id);

				set_flash('result', action_result('success', fa('check mr5').' Редирект <strong>"'.$insert['url_from'].'"</strong> успешно обновлен!', true));
				redirect(uri(5) == 'close' ? '/admin/'.$this->page.'/redirects' : current_url());

			} catch(Exception $e) {

				$this->data['error'] = $e->getMessage();
			}
		}

		$this->data['item'] = $item;

		$this->data['pageinfo']['title'] = 'Редактирование редиректа';

		$this->breadcrumbs
			->add('Редиректы', $this->page.'/redirects')
			->add('Редактирование', '');

		$this->output($this->page.'/redirects_edit');
	}

	public function redirect_editor()
	{
		$this->load->model('redirects_model', 'redirects');

		if($_POST)
		{
			try
			{
				$post = $this->input->post('redirects');

				$insert = [];
				$redirects = explode("\r\n", $post);

				foreach ($redirects as $row)
				{
					$redirect = explode(' ', trim($row));

					if(!empty($redirect[0]))
					{
						$insert[] = [
							'url_from' => $redirect[0],
							'url_to' => $redirect[1] ?? '/',
						];
					}
				}

				$this->redirects->truncate();
				if(!empty($insert))
				{
					$this->redirects->insert_batch($insert);
				}

				set_flash('result', action_result('success', fa('check mr5').' Редиректы успешно обновлены!', true));
				redirect(uri(4) == 'close' ? '/admin/'.$this->page.'/redirects' : current_url());

			} catch(Exception $e) {

				$this->data['error'] = $e->getMessage();
			}
		}

		$this->data['items'] = $this->redirects->getItems();

		$this->data['pageinfo']['title'] = 'Быстрое редактирование';

		$this->breadcrumbs
			->add('Редиректы', $this->page.'/redirects')
			->add('Быстрое редактирование', '');

		$this->output($this->page.'/redirects_editor');
	}

	public function redirects_delete()
	{
		$this->load->model('redirects_model', 'redirects');

		$id = uri(4);
		$error = fa('warning mr5').' Ошибка данных POST!';

		try
		{
			if($_POST && $this->input->post('delete') == 'delete')
			{
				$item = $this->redirects->getItem('id', $id);
				if(empty($item))
					throw new Exception(fa('warning mr5').' Запись не найдена!');

				$this->redirects->delete($id);
				$error = false;
			}
		}  catch(Exception $e) {
			$error = $e->getMessage();
		}

		if($error)
		{
			set_flash('result', action_result('error', $error, true));
		} else {
			set_flash('result', action_result('success', fa('trash mr5').' Запись <strong>"'.$item['url_from'].'"</strong> успешно удалена!', true));
		}

		redirect('admin/'.$this->page.'/redirects');
	}
}
