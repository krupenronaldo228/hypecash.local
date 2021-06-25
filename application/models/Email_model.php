<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends Base_Model {
	
	private $config = array();
	private $tpl = array();
	
	public function __construct ()
	{
		parent::__construct();
		$this->load->library('email');
		
		$this->config = [
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'priority' => '1'
		];
		
		$this->tpl = [
			'color' => '#202D33',
		];
	}

	public function send($data, $view, $title, $to = null, $template = true)
	{

		$site = $data['site'] = array_column($this->db->get('settings')->result_array(), 'value', 'key');
		
		$data['tpl'] = $this->tpl;

		$emails = explode("\r\n", $site['email_recipient']);
		foreach ($emails as $k => $v) $emails[$k] = trim($v);

		$to = $to ?? $emails;
		
		if($template)
		{
			$data['view'] = $view;
			$message = $this->load->view('emails/template', $data, TRUE);
		} else {
			$message = $this->load->view('emails/'.$view, $data, TRUE);
		}
		
		$this->email
			->initialize($this->config)
			->from($site['email_sender'], $site['title'])
			->to($to)
			->subject($title)
			->message($message)
			->send();
	}

	public function preview($data, $view, $template = true)
	{
		$this->db->select('email, email_sender, title, descr, img');
		$site = $data['site'] = $this->db->get('settings')->row_array();
		
		$data['tpl'] = $this->tpl;
		
		if($template)
		{
			$data['view'] = $view;
			$this->load->view('emails/template', $data);
		} else {
			$message = $this->load->view('emails/'.$view, $data);
		}
	}
}
