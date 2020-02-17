<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek_poin_sales extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		$this->template->load('templatepoinsales','web/cek_poin_sales');
	}

	public function cekPoin()
	{
		$data['poin'] = $this->Usermodel->cekPoin();
		$this->template->load('templatepoinsales','web/cek_poin_sales_1',$data);		
	}
}