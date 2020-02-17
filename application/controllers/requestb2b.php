<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requestb2b extends CI_Controller
{
	public function index()
	{
		$this->load->view('web/requestb2b');
	}
	public function requestb2b_send()
	{
		$this->load->view('web/requestb2b_send');
	}
}