<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car_rental extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}
	public function index()
	{
     	$this->load->view('web/car_rental');
	}
}