<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umrah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		redirect('umroh');    	
	}

	public function paket_umrah_bintang_5_berangkat_kamis()
    {
        $this->load->view('web/umrah_detail');
    }

    public function paket_umrah_bintang_5_berangkat_minggu()
    {
        $this->load->view('web/umrah_detail_1');
    }

    public function paket_umrah_plus_turki()
    {
        $this->load->view('web/umrah_detail_2');
    }

    public function paket_umrah_bintang_5_berangkat_rabu()
    {
        $this->load->view('web/umrah_detail_3');
    }

    public function paket_umrah_plus_dubai()
    {
        $this->load->view('web/umrah_detail_4');
    }

    public function paket_umrah_bintang_5_berangkat_senin()
    {
        $this->load->view('web/umrah_detail_5');
    }

	public function paket_umrah_plus_maroko()
	{
     	$this->load->view('web/umrah_detail_6');
	}

	public function umrah_detail_7()
	{
     	$this->load->view('web/umrah_detail_7');
	}

	public function umrah_detail_8()
	{
     	$this->load->view('web/umrah_detail_8');
	}

	public function paket_umrah_awal_desember_2015()
	{
     	$this->load->view('web/umrah_detail_11');
	}

	public function paket_umrah_pertengahan_desember_2015()
	{
     	$this->load->view('web/umrah_detail_12');
	}

	public function paket_umrah_akhir_desember_2015()
	{
     	$this->load->view('web/umrah_detail_13');
	}
	
	public function umrah_book()
	{
     	$this->load->view('web/umrah_book');
	}

	public function umrah_send()
	{
     	$this->load->view('web/umrah_send');
	}

	
	public function umrah_book_telkomsel()
	{
     	$this->load->view('web/umrah_book_telkomsel');
	}

	public function umrah_send_telkomsel()
	{
     	$this->load->view('web/umrah_send_telkomsel');
	}

	
	public function send_reservation()
	{
     	$this->load->view('web/send_reservation');
	}
}