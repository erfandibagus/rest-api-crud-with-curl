<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

	protected $_ci;
	
	public function __construct()
	{
		$this->_ci=&get_instance();
	}

	public function load($content, $data=NULL)
	{
		$data['_content'] = $this->_ci->load->view($content, $data, TRUE);
		$this->_ci->load->view('template.php', $data);
    }   
}