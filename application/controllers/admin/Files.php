<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends ADMIN_Controller {

    public function index()
    {
        $this->init('files');
        $this->data['template'] = 'admin/common/files';
        $this->output();
    }

    public function ck_files()
    {
        $this->init('files');
        $this->data['template'] = 'admin/common/files_ckeditor';
        $this->output();
    }


    public function elfinder_init()
    {
        $this->load->helper('path');

        $opts = array(
			'roots' => array(
				// Items volume
				array(
					'driver'        => 'LocalFileSystem',
					'path'          => set_realpath(FCPATH . '/assets/uploads/files/'),
					'URL'           => site_url('/assets/uploads/files/'),
					'trashHash'     => 't1_Lw',
					'winHashFix'    => DIRECTORY_SEPARATOR !== '/',
					'uploadDeny'    => [
						'all'
					],
					'uploadAllow'   => ['all'],
					'uploadOrder'   => [],
					'accessControl' => [
						$this, 'elfinderAccess'
					],
				),
				// Trash volume
				array(
					'id'            => '1',
					'driver'        => 'Trash',
					'path'          => set_realpath(FCPATH . '/assets/uploads/files/.trash/'),
					'tmbURL'        => site_url('/assets/uploads/files/.trash/.tmb/'),
					'winHashFix'    => DIRECTORY_SEPARATOR !== '/',
					'uploadDeny'    => [
						'all'
					],
					'uploadAllow'   => [
						'image', 'text/plain'
					],
					'uploadOrder'   => [
						'deny', 'allow'
					],
					'accessControl' => [
						$this, 'elfinderAccess'
					],                    // Same as above
				)
			)

        );
        $this->load->library('ElfinderLib', $opts);
    }
	
	
	public function elfinderAccess($attr, $path, $data, $volume, $isDir, $relpath)
	{
		$basename = basename($path);
		return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
		&& strlen($relpath) !== 1           // but with out volume root
			? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
			:  null;                                 // else elFinder decide it itself
	}
    
    
    
    
    # FOR CKEditor

    function translit($string)
    {
        $converter = array(
            '??' => 'a', '??' => 'b', '??' => 'v',
            '??' => 'g', '??' => 'd', '??' => 'e',
            '??' => 'e', '??' => 'zh', '??' => 'z',
            '??' => 'i', '??' => 'y', '??' => 'k',
            '??' => 'l', '??' => 'm', '??' => 'n',
            '??' => 'o', '??' => 'p', '??' => 'r',
            '??' => 's', '??' => 't', '??' => 'u',
            '??' => 'f', '??' => 'h', '??' => 'c',
            '??' => 'ch', '??' => 'sh', '??' => 'sch',
            '??' => '\'', '??' => 'y', '??' => '\'',
            '??' => 'e', '??' => 'yu', '??' => 'ya',

            '??' => 'A', '??' => 'B', '??' => 'V',
            '??' => 'G', '??' => 'D', '??' => 'E',
            '??' => 'E', '??' => 'Zh', '??' => 'Z',
            '??' => 'I', '??' => 'Y', '??' => 'K',
            '??' => 'L', '??' => 'M', '??' => 'N',
            '??' => 'O', '??' => 'P', '??' => 'R',
            '??' => 'S', '??' => 'T', '??' => 'U',
            '??' => 'F', '??' => 'H', '??' => 'C',
            '??' => 'Ch', '??' => 'Sh', '??' => 'Sch',
            '??' => '\'', '??' => 'Y', '??' => '\'',
            '??' => 'E', '??' => 'Yu', '??' => 'Ya',
        );
        return strtr($string, $converter);
    }

    function str2url($str)
    {
        $str = $this->translit($str);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_.]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

    public function upload(){
        $callback = $_GET['CKEditorFuncNum'];
        $file_name = $this->str2url($_FILES['upload']['name']);
        $file_name_tmp = $this->translit($_FILES['upload']['tmp_name']);
        $file_new_name = FCPATH.'assets/uploads/files/ckimages/'; // ?????????????????? ?????????? - ?????????? ?????? ???????????????????? ????????????. (?????????? ?????????? ???? ????????????)
        $full_path = $file_new_name.$file_name;
        while (file_exists($full_path)) {
            $file_name = md5(uniqid())[0] . $file_name;
            $full_path = $file_new_name . $file_name;;
        }

        $http_path = uri(0).'/assets/uploads/files/ckimages/'.$file_name; // ?????????? ?????????????????????? ?????? ?????????????????? ?????????? http
        $error = '';
        if (move_uploaded_file($file_name_tmp, $full_path))
        {
        } else
        {
            $error = '????????????, ?????????????????? ?????????????? ??????????'; // ?????? ???????????? ???????????????? ?? ???????????????? ???????? ???????????? ???? ???????? ?????????????????? ????????
            $http_path = '';
        }
        echo '<script type="text/javascript">';
        echo 'window.parent.CKEDITOR.tools.callFunction('.$callback.',  "'.addslashes($http_path).'","'.$error.'");';
        echo '</script>';
    }
}
