<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class calender extends CI_Controller
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
		$this->auth->cek_menu(22);

		
		$data['a1']=$this->Usermodel->calender1();
		$data['a2']=$this->Usermodel->calender2();
		$data['a3']=$this->Usermodel->calender3();
		$data['a4']=$this->Usermodel->calender4();
		$data['a5']=$this->Usermodel->calender5();
		$data['a6']=$this->Usermodel->calender6();
		$data['a7']=$this->Usermodel->calender7();
		$data['a8']=$this->Usermodel->calender8();
		$data['a9']=$this->Usermodel->calender9();
		$data['a10']=$this->Usermodel->calender10();
		$data['a11']=$this->Usermodel->calender11();
		$data['a12']=$this->Usermodel->calender12();
		
		
		$this->template->set('title','Calender | DreamTour.co');
		$this->template->load('template','calender/index',$data);


	}

	public function tambah(){


		$this->template->set('title','Calender | DreamTour.co');
		$this->template->load('template','calender/add');
	}

	public function simpan(){
		$data = array(
   				'target' => $this->input->post('target'),
   				'uraian' => $this->input->post('uraian'),
   				'id_bulan' => $this->input->post('id_bulan'),
   				'appointment' => $this->input->post('appoinment'),
   				'tahun' => $this->input->post('tahun')
  				);

		$this->Usermodel->tambah_calender($data);

		$data['a1'] = $this->Usermodel->calender1();
		redirect('calender/index',$data);
	}

	public function hapus($id_calender){
		$this->id_calender = $id_calender;
		$this->Usermodel->hapus_calender($id_calender);

		
		$data['a1'] = $this->Usermodel->calender1();
		redirect('calender/index',$data);
		
	}

	function ubah($id_calender){
		$where['id_calender'] = $id_calender;
		$a = $this->db->get_where('calender',$where)->row();
		$data['id_calender'] = $id_calender;
		$data['target'] = $a->target;
		$data['uraian'] = $a->uraian;
		$data['appointment'] = $a->appointment;
		$data['id_bulan'] = $a->id_bulan;
		$data['tahun'] = $a->tahun;
		$data['status'] = $a->status;

		$this->template->set('title','Ubah Calender | DreamTour.co');
		$this->template->load('template','calender/ubah',$data);
	}

	function simpanubah(){
		$this->Usermodel->ubahCalender();

		$data['a1'] = $this->Usermodel->calender1();
		redirect('calender/index',$data);
	}

	function ubahstatus($id_calender){
		$this->id_calender = $id_calender;
		$this->Usermodel->ubahStatusCalender($id_calender);

		$data['a1'] = $this->Usermodel->calender1();
		redirect('calender/index',$data);
	}

}