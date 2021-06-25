<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Base_model
 * @property CI_Loader load
 * @property CI_Input input
 * @property CI_Upload upload
 * @property CI_DB_query_builder db
 * @property CI_Form_validation form_validation
 * @property SimpleImage simpleimage
 */

class Base_model extends CI_Model {
	
	public $table 		= null;
	public $folder		= null;
	public $page		= null;
	
	# GET
	
	public function getItems($params = [], $order = null, $limit = null, $offset = null)
	{
		$this->setOrder($order);
		
		return $this->db
			->get_where($this->table, $params, $limit, $offset)
			->result_array();
	}
	
	public function getItem($field, $value = null)
	{
		return $this->db
			->get_where($this->table, $this->_params_to_array($field, $value))
			->row_array();
	}
	
	public function getCount($field = null, $value = null)
	{
		return $this->db
			->where($this->_params_to_array($field, $value))
			->count_all_results($this->table);
	}
	
	public function setOrder($order)
	{
		if($order == 'RANDOM')
			$this->db->order_by('', 'RANDOM');
		else
			$this->db->order_by(str_replace(['|', '//'], [' ', ', '], $order));
	}
	
	
	# ACTIONS
	
	public function insert($data)
	{
		if(!$this->db->insert($this->table, $data))
		{
			$error = $this->db->error();
			$message = fa5s('exclamation-triangle fa-fw mr5') . ' Ошибка при добавлении записи в базу данных.' .
				'<div><strong>Код ошибки: ' . $error['code'] . '.</strong> ' . $error['message'] . '</div>';
				
			throw new Exception($message);
		}
		
		return $this->db->insert_id();
	}
	
	public function update($data, $param)
	{
		if(is_array($param)) $where = $param;
		else $where['id'] = $param;
		
		if(!$this->db->update($this->table, $data, $where))
		{
			$error = $this->db->error();
			$message = fa5s('exclamation-triangle fa-fw mr5') . ' Ошибка при обновлении записи в базе данных.' .
				'<div><strong>Код ошибки: ' . $error['code'] . '.</strong> ' . $error['message'] . '</div>';
				
			throw new Exception($message);
		}
		
		return true;
	}
	
	public function delete($param)
	{
		if(is_array($param)) $where = $param;
		else $where['id'] = $param;
		
		if(!$this->db->delete($this->table, $where))
		{
			$error = $this->db->error();
			$message = fa5s('exclamation-triangle fa-fw mr5') . ' Ошибка при удалении записи из базы данных.' .
				'<div><strong>Код ошибки: ' . $error['code'] . '.</strong> ' . $error['message'] . '</div>';
				
			throw new Exception($message);
		}
		
		return true;
	}
	
	
	# FILES
	
	public function file_config()
	{
		return [
			'upload_path'	=> './'.PATH_UPLOADS.'/'.$this->folder.'/',
			'allowed_types'	=> 'gif|jpg|png|jpeg',
			'max_size'		=> 2048,
			'encrypt_name'	=> true,
			'remove_spaces'	=> false,
			'overwrite'		=> true,
		];
	}
	
	public function file_load($key)
	{
		$error = false;
		$filename = null;
		
		if(!empty($_FILES[$key]['name']))
		{
			$this->load->helper('file');
			
			if($this->upload->do_upload($key))
			{
				$file = $this->upload->data();
				$filename = $file['file_name'];
				
				$this->thumb_create($key, $filename);
				
			}
			else {
				
				throw new Exception(fa5s('exclamation-triangle fa-fw mr5').' Ошибка загрузки изображения <strong>'.$_FILES[$key]['name'].'</strong>' .
					'<ul class="note-list">'.$this->upload->display_errors('<li>', '</li>').'</ul>');
			
			}
		}
		
		return $filename;
	}
	
	public function file_clear($id, $key)
	{
		return $this->update([$key => null], $id);
	}
	
	public function file_delete($file)
	{
		$paths = array(
			'/'.PATH_UPLOADS.'/'.$this->folder.'/'.$file,
			'/'.PATH_UPLOADS.'/'.$this->folder.'/thumb/'.$file,
		);
		deletefile($paths);
	}
	
	public function thumb_create($key, $filename)
	{
		$thumb = $this->thumb_size($key);
		if(!empty($thumb))
		{
			$this->load->library('SimpleImage');
			
			$path = PATH_UPLOADS.'/'.$this->folder.'/';
			$path_thumb = PATH_UPLOADS.'/'.$this->folder.'/thumb/';
			$path_webp = PATH_UPLOADS.'/'.$this->folder.'/webp/';
			
			$this->check_dir($path_thumb);
			$this->check_dir($path_webp);
			
			if($thumb['type'] == 'best_fit')
			{
				$this->simpleimage
					->fromFile($path.$filename)
					->bestFit($thumb['x'], $thumb['y'])
					->toFile($path_thumb.$filename);
			} else {
				$this->simpleimage
					->fromFile($path.$filename)
					->thumbnail($thumb['x'], $thumb['y'])
					->toFile($path_thumb.$filename);
			}
			
			$this->simpleimage
				->fromFile($path_thumb.$filename)
				->toFile($path_webp.$filename.'.webp', 'image/webp', 99);
		}
	}
	
	public function thumb_size()
	{
		$item = $this->db
			->select('thumb_x as x, thumb_y as y, thumb_type as type')
			->get_where('pageinfo_site', ['alias' => $this->page])
			->row_array();

		return $item;
	}
	
	
	# HELPERS
	
	function check_unique($str, $key, $not_id = null)
	{
		$params[$key] = $str;
		
		if($not_id) $params['id !='] = $not_id;
		
		$check = $this->getCount($params);
		if($check == 0) return true;
		
		return false;
	}
	
	function _params_to_array($field, $value)
	{
		$params = array();
		
		if(is_array($field)) $params = $field;
		elseif(!is_null($field)) $params[$field] = $value;
		
		return $params;
	}
	
	function check_dir($dir)
	{
		if(!is_dir($dir))
			mkdir($dir, 0755);
	}
}
