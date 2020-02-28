<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		$data['slider'] = $this->Usermodel->ambilData('ol_paketumroh');
     	$this->load->view('web/odyssey/home',$data);
	}


}