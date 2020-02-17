<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(13);
		
		$data['cuti'] = $this->Usermodel->cariCuti2();

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/index',$data);


	}

	public function cariCuti(){
		$data['cuti'] = $this->Usermodel->cariCuti();

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/index',$data);
	}

	public function simpan(){
		$data = array(
   				'id_user' => $this->input->post('id_user'),
   				'tanggal' => $this->input->post('tanggal'),
   				'status' => $this->input->post('status')
  				);

		$this->Usermodel->tambah_cuti($data);

		$data['cuti'] = $this->Usermodel->cariCuti1();

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/index',$data);
	}

	public function hapus($id_cal_cuti){
		$this->id_cal_cuti = $id_cal_cuti;
		$this->Usermodel->hapus_cuti($id_cal_cuti);
		
		$data['cuti'] = $this->Usermodel->cariCuti2();

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/index',$data);
		
	}

	function ubah($id_cal_cuti){
		$where['id_cal_cuti'] = $id_cal_cuti;
		$a = $this->db->get_where('calender_cuti',$where)->row();
		$data['id_cal_cuti'] = $id_cal_cuti;
		$data['tanggal'] = $a->tanggal;
		$data['id_user'] = $a->id_user;
		$data['status'] = $a->status;

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/ubah',$data);
	}

	function simpanubah(){
		$this->Usermodel->ubahCuti();

		$data['cuti'] = $this->Usermodel->cariCuti2();

		$this->template->set('title','Cuti | DreamTour.co');
		$this->template->load('template','cuti/index',$data);
	}

}