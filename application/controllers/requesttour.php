<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requesttour extends CI_Controller
{
	public function index()
	{
		$this->load->view('web/requesttour');
	}
	public function requestb2b_send()
	{
		$this->load->view('web/requestb2b_send');
	}
	public function requesttour_send()
	{
		$this->load->view('web/requesttour_send');
	}


}


