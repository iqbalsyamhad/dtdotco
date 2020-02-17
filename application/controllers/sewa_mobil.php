<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sewa_mobil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sewamobil_model');
	}
	public function indonesia()
	{
     	$this->load->view('sewa_mobil/car_rental');
	}

	public function indonesia_terbaik()
	{
     	$this->load->view('sewa_mobil/car_rental_notif');
	}

	public function kota()
	{
		$data['kota'] = $this->Sewamobil_model->cari_kota();
		$data['tarif'] = $this->Sewamobil_model->tarif_sewa();

		$this->load->view('sewa_mobil/car',$data);
	}

	public function murah($kota)
	{
		$data['detail'] = $this->Sewamobil_model->detail($kota);

		$this->load->view('sewa_mobil/car_rental_detail',$data);
	}

	public function booking()
	{
		$this->load->view('sewa_mobil/rent_car_book');
	}

	public function booking_send()
	{
		$this->load->view('sewa_mobil/rent_car_send');
	}


	public function pilihan()
	{
		$this->load->view('sewa_mobil/car_pilihan');
	}
}