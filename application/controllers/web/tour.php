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
		redirect('tour');		
	}

	public function tour_book()
	{
		$this->load->view('web/tour_book');
	}
	public function tour_send()
	{
		$this->load->view('web/tour_send');
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

	public function paket_muslim_tour_jepang()
	{
		$this->load->view('web/tour/tour_detail_muslim_japan');		
	}

	public function tour_detail_muslim_korea()
	{
		$this->template->load('templatetour','web/tour_detail_muslim_korea');		
	}

	public function tour_detail_muslim_bangkok()
	{
		$this->template->load('templatetour','web/tour_detail_muslim_bangkok');		
	}

	public function tour_detail_muslim_china()
	{
		$this->template->load('templatetour','web/tour_detail_muslim_china');		
	}
	
	public function tour_detail_muslim_hongkong()
	{
		$this->template->load('templatetour','web/tour_detail_muslim_hongkong');		
	}

	public function tour_detail_motogp()
	{
		$this->template->load('templatetour','web/tour_detail_motogp');		
	}

	public function opentrip_bali()
	{
		$this->template->load('templatetour','web/opentrip_bali');		
	}

	public function opentrip_derawan()
	{
		$this->template->load('templatetour','web/opentrip_derawan');		
	}

	public function opentrip_maratua()
	{
		$this->template->load('templatetour','web/opentrip_maratua');		
	}
}