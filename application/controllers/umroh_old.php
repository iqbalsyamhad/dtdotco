<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umroh extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		// $where['id_status'] = 2;
                            // $a = $this->db->get_where('status',$where)->row();
                            // $dua = $data['status'] = $a->id_status_web;

		// if ($dua =="construct") {
     		// $this->load->view('web/construct');	
		// }elseif ($data!="online") {
     		$this->load->view('web/odyssey/umroh');
		// }     	
	}

	// PAKET UMROH

	public function paket_umroh_exclusive()
	{
     	$this->load->view('web/odyssey/umroh_reguler');
	}
	
	public function paket_umroh_signature()
	{
     	$this->load->view('web/odyssey/umroh_signature');
	}
	
	public function paket_umroh_plus_turki_12hari()
	{
     	$this->load->view('web/odyssey/umroh_plus_turki_12hari');
	}

	public function paket_umroh_akhir_tahun_11hari()
	{
     	$this->load->view('web/odyssey/umroh_akhir_tahun_11hari');
	}
	
	public function paket_umroh_akhir_tahun_2018()
	{
     	$this->load->view('web/odyssey/umroh_akhir_tahun');
	}

	public function paket_umroh_reguler()
	{
		//$this->load->view('web/umroh/paket_umroh_reguler');
		redirect('umroh');
	}

	public function paket_umroh_stop_over()
	{
		$this->load->view('web/umroh/paket_umroh_stopover');
	}

	public function paket_umroh_plus()
	{
		$this->load->view('web/umroh/paket_umroh_plus');
	}
	
    public function paket_umroh_syawal()
    {
        $this->load->view('web/odyssey/umroh_syawal_1439');
    }
    
    public function paket_umroh_akhir_ramadhan()
	{
		$this->load->view('web/odyssey/umroh_akhir_ramadhan_1439');
	}
	
	public function paket_umroh_awal_ramadhan()
	{
		$this->load->view('web/odyssey/umroh_awal_ramadhan_1440');
	}

	// PAKET UMROH REGULER
	public function paket_umroh_reguler_1()
    {
        //$this->load->view('web/umroh/paket_umroh_reguler_kamis');
        redirect('umroh/paket_umroh_exclusive');
    }

    public function paket_umroh_stopover_turki()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_stopover_turki');
    }

    public function paket_umroh_reguler_10day()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_11hari');
    }

    public function paket_umroh_reguler_2()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_senin');
    }

    public function paket_umroh_reguler_3()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_selasa');
    }

    public function paket_umroh_reguler_4()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_rabu');
    }

    public function paket_umroh_liburan_sekolah()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_liburan_sekolah');
    }

	public function paket_umrah_awal_desember_2016()
	{
     	$this->load->view('web/umroh/paket_umroh_reguler_desember_awal');
	}

	public function paket_umrah_pertengahan_desember_2016()
	{
     	$this->load->view('web/umroh/paket_umroh_reguler_desember_pertengahan');
	}

	public function paket_umrah_akhir_desember_2016()
	{
     	$this->load->view('web/umroh/paket_umroh_reguler_desember_akhir');
	}



	public function paket_umroh_nuzulul_ramadhan()
	{
		$this->load->view('web/umroh/paket_umroh_reguler_nuzulul_ramadhan');
	}
	



    public function paket_umroh_reguler_2017()
    {
        $this->load->view('web/umroh/paket_umroh_reguler_2017');
    }

    // PAKET UMROH PLUS
    public function paket_umrah_plus_turki()
    {
        $this->load->view('web/odyssey/umroh_plus_turki');
    }
    
    public function paket_umrah_plus_turki_desember_2018()
    {
        $this->load->view('web/odyssey/umroh_plus_turki_desember');
    }

    public function paket_umrah_plus_aqsa()
    {
        $this->load->view('web/odyssey/umroh_plus_aqsa');
    }

    public function paket_umrah_plus_eropa()
    {
        $this->load->view('web/odyssey/umroh_plus_eropa');
    }

    public function paket_umrah_plus_cairo()
    {
        $this->load->view('web/odyssey/umroh_plus_cairo');
    }

    public function paket_umrah_plus_dubaii()
    {
        $this->load->view('web/odyssey/umroh_plus_dubai');
    }



    public function paket_umrah_plus_turki_april()
    {
        $this->load->view('web/umroh/paket_umroh_plus_turki_april');
    }

    public function paket_umrah_plus_turki_mei()
    {
        $this->load->view('web/umroh/paket_umroh_plus_turki_mei');
    }

    public function paket_umrah_plus_dubai()
    {
        $this->load->view('web/umroh/paket_umroh_plus_dubai');
    }

	public function paket_umrah_plus_maroko()
	{
     	$this->load->view('web/umroh/paket_umroh_plus_maroko');
	}

	public function paket_umroh_plus_mini_eropa()
	{
     	$this->load->view('web/umroh/paket_umroh_plus_mini_eropa');
	}

	public function paket_umroh_plus_spain()
	{
     	$this->load->view('web/umroh/paket_umroh_plus_spain');
	}

	public function paket_umroh_plus_west_eropa()
	{
     	$this->load->view('web/umroh/paket_umroh_plus_west_eropa');
	}

	// BIAYA UMROH
	public function biaya_umroh()
	{
     	//$this->load->view('web/umroh/biaya_umroh');
     	redirect('umroh');
	}

	
	public function umrah_book()
	{
     	$this->load->view('web/umroh/umrah_book');
	}

	public function umrah_send()
	{
     	$this->load->view('web/umroh/umrah_send');
	}

	
	public function umrah_book_telkomsel()
	{
     	$this->load->view('web/umroh/umrah_book_telkomsel');
	}

	public function umrah_send_telkomsel()
	{
     	$this->load->view('web/umroh/umrah_send_telkomsel');
	}

	
	public function send_reservation()
	{
     	$this->load->view('web/umroh/send_reservation');
	}
}