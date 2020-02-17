<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller
{
	public function index()
	{
		$this->load->view('web/request');
	}
	public function request_send()
	{
		$this->load->view('web/request_send');
	}
}