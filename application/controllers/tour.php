<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webmodel');
	}
	public function index()
	{	
		$where['id_status'] = 1;
        $a = $this->db->get_where('status',$where)->row();
        $dua = $data['status'] = $a->id_status_web;

		if ($dua =="construct") {
     		$this->load->view('web/construct');	
		}elseif ($data!="on") {
			//$data['tour'] = $this->Webmodel->tampil_tour();
			//$data['tour_internasional'] = $this->Webmodel->tampil_tour_internasional();
     	    //$this->load->view('web/tour/tour',$data);	
		    redirect('tour/wisata_tour');
		}		
	}

	public function wisata_tour()
	{
		$this->load->view('web/odyssey/tour/tour');
	}

	public function muslim_tour()
	{
		$this->load->view('web/tour/muslim_tour');
	}
	public function domestik()
	{
		$this->load->view('web/tour/domestik');
	}
	public function internasional()
	{
		$this->load->view('web/tour/internasional');
	}
	public function open_trip()
	{
		$this->load->view('web/tour/opentrip');
	}
	public function honeymoon()
	{
		$this->load->view('web/tour/honeymoon');
	}
	public function tour_book()
	{
		$this->load->view('web/tour/tour_book');
	}
	public function tour_send()
	{
		$this->load->view('web/tour/tour_send');
	}
	public function tour_detail($id_tour)
	{
		$where['id_tour'] = $id_tour;
		$a = $this->db->get_where('tb_tour',$where)->row();
		$b = $this->db->get_where('tb_tour_detail',$where)->row();
		$c = $this->db->get_where('tb_itinerary',$where)->row();

		$data['gambar'] = $a->gambar;
		$data['nama_tour'] = $a->nama_tour;
		$data['ket1'] = $a->ket1;
		$data['ket2'] = $a->ket1;
		$data['link'] = $a->link;

		$data['include'] = $b->include;
		$data['exclude'] = $b->exclude;
		$data['term'] = $b->term;
		$data['highlight'] = $b->highlight;
		$data['gambar_detail'] = $b->gambar_detail;

		$data['file_itinerary'] = $c->file_itinerary;
		$data['tour_highlight'] = $c->tour_highlight;

		$this->template->load('templatetour','web/tour_detail',$data);
	}
	// MUSLIM TOUR
	public function muslim_tour_eropa()
	{
		$this->load->view('web/odyssey/tour/muslim_tour_eropa');		
	}
	
	public function muslim_tour_maroko()
	{
		$this->load->view('web/odyssey/tour/muslim_tour_maroko');		
	}

	// INTERNASIONAL TOUR
	public function internasional_tour_turki()
	{
		$this->load->view('web/odyssey/tour/internasional_tour_turki');		
	}

	public function internasional_tour_roma()
	{
		$this->load->view('web/odyssey/tour/internasional_tour_roma');		
	}

	//HONEYMOON
	public function honeymoon_maldives()
	{
		$this->load->view('web/odyssey/tour/honeymoon_maldives');		
	}

	public function muslim_tour_spanyol()
	{
		$this->load->view('web/tour/muslim_tour_spanyol');		
	}

	public function paket_wisata_muslim_jepang()
	{
		$this->load->view('web/tour/tour_detail_muslim_japan');		
	}

	public function paket_wisata_muslim_korea()
	{
		$this->load->view('web/tour/tour_detail_muslim_korea');		
	}

	public function paket_wisata_muslim_bangkok()
	{
		$this->load->view('web/tour/tour_detail_muslim_bangkok');		
	}

	public function paket_wisata_muslim_cina()
	{
		$this->load->view('web/tour/tour_detail_muslim_china');		
	}
	
	public function paket_wisata_muslim_hongkong()
	{
		$this->load->view('web/tour/tour_detail_muslim_hongkong');		
	}

	public function tour_detail_motogp()
	{
		$this->template->load('templatetour','web/tour/tour_detail_motogp');		
	}

	// OPEN TRIP
	public function open_trip_bali()
	{
		$this->load->view('web/tour/opentrip_bali');		
	}

	public function open_trip_derawan()
	{
		$this->load->view('web/tour/opentrip_derawan');		
	}

	public function open_trip_maratua()
	{
		$this->load->view('web/tour/opentrip_maratua');		
	}

	public function open_trip_pahawang()
	{
		$this->load->view('web/tour/opentrip_pahawang');
	}

	public function open_trip_ora()
	{
		$this->load->view('web/tour/opentrip_ora');	
	}

	public function open_trip_tanatoraja()
	{
		$this->load->view('web/tour/opentrip_tanatoraja');	
	}

	public function open_trip_rajaampat()
	{
		$this->load->view('web/tour/opentrip_rajaampat');	
	}
	
	public function open_trip_karimun_jawa()
	{
		$this->load->view('web/tour/opentrip_karimun');	
	}
	
	public function open_trip_pulau_tidung()
	{
		$this->load->view('web/tour/opentrip_tidung');	
	}

	public function open_trip_pulau_harapan()
	{
		$this->load->view('web/tour/opentrip_harapan');	
	}

	// DOMESTIK
	public function raja_ampat()
	{
		$this->load->view('web/tour/domestik_rajaampat');		
	}

	public function bali()
	{
		$this->load->view('web/tour/domestik_bali');		
	}

	public function lombok()
	{
		$this->load->view('web/tour/domestik_lombok');		
	}

	// INTERNASIONAL
	public function internasional_korea()
	{
		$this->load->view('web/tour/internasional_korea');		
	}
	
	public function internasional_singapura()
	{
		$this->load->view('web/tour/internasional_singapur');		
	}

	public function internasional_hokaido()
	{
		$this->load->view('web/tour/internasional_hokaido');		
	}
	
	public function internasional_east_coast()
	{
		$this->load->view('web/tour/internasional_east_coast');		
	}

	public function internasional_west_coast()
	{
		$this->load->view('web/tour/internasional_west_coast');		
	}

	public function internasional_turki()
	{
		$this->load->view('web/tour/internasional_turki');
	}

	public function internasional_tokyo_penisula()
	{
		$this->load->view('web/tour/internasional_tokyo_penisula');
	}
	
	public function internasional_phi_island()
	{
		$this->load->view('web/tour/internasional_phi_island');
	}
	
	public function internasional_hongkong()
	{
		$this->load->view('web/tour/internasional_hongkong');
	}
	
	

}