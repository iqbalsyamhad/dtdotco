<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}
	public function index()
	{
     	$this->load->view('web/ticket');
	}
	public function ticket_book()
	{
		$this->template->load('templatehome','web/ticket_book');
	}
	public function ticket_send()
	{
		$this->template->load('templatehome','web/ticket_send');
	}
}