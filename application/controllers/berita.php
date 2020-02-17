<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function liburan_sambil_ibadah_asiknya()
	{
		$this->load->view('berita/liburan_sambil_ibadah_asiknya');
	}

	public function tawaf_makna_dan_waktu_paling_afdol()
	{
		$this->load->view('berita/tawaf_makna_dan_waktu_paling_afdol');
	}

	public function mengejar_mustajabnya_doa_ditaman_raudhah()
	{
		$this->load->view('berita/mengejar_mustajabnya_doa_ditaman_raudhah');
	}

	public function percetakan_alquran_terbesar_dunia()
	{
		$this->load->view('berita/percetakan_alquran_terbesar_dunia');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */