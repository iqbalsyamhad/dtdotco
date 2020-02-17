<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}
	public function index()
	{
     	$this->load->view('web/odyssey/contact');
	}
	public function contact_send()
	{
     	$this->load->view('web/odyssey/contact_send');
	}
}