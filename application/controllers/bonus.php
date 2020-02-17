<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonus extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bonusmodel');
	}
	public function index()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}
		else
		{
			//$data['sales_report'] = $this->Bonusmodel->sales_report_after_tambah();
		
			//$data['poin_sales_report'] = $this->Bonusmodel->poin_sales_report_after_tambah();

			//$this->load->view('bonus/sales_report',$data);
			redirect('bonus/sales_report');
		}
	}

	// SALES REPORT

	public function sales_report_cari(){
		$this->auth->restrict();
		$data['sales_report'] = $this->Bonusmodel->sales_report_cari();	
		$data['poin_sales_report'] = $this->Bonusmodel->poin_sales_report();	

		$this->load->view('bonus/sales_report',$data);
	}

	public function sales_report(){
		$this->auth->restrict();
		$data['sales_report'] = $this->Bonusmodel->sales_report_after_tambah();
		
		$data['poin_sales_report'] = $this->Bonusmodel->poin_sales_report_after_tambah();

		$this->load->view('bonus/sales_report',$data);
	}

	public function tambah_sales_report(){
		$this->auth->restrict();
		$this->load->view('bonus/sales_report_tambah');
	}

	public function tambah_sales_report_1(){
		$this->auth->restrict();
		$this->Bonusmodel->tambahSalesReport();

		$data['poin_sales_report'] = $this->Bonusmodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Bonusmodel->sales_report_after_tambah();

		$this->load->view('bonus/sales_report',$data);
	}


	public function ubah_sales_report($id_sales_report){
		$this->auth->restrict();
		$this->load->model('Usermodel');
	    $where['id_sales_report'] = $id_sales_report;
	    $a=$this->db->get_where('tb_sales_report',$where)->row();
	    $data['id_sales_report']=$id_sales_report;
	    $data['user_id']=$a->user_id;
	    $data['paket']=$a->paket;
	    $data['tgl_berangkat']=$a->tgl_berangkat;
	    $data['jml_jamaah']=$a->jml_jamaah;
	    $data['total_poin']=$a->total_poin;
	    $data['keterangan']=$a->keterangan;

	    $this->load->view('bonus/sales_report_ubah',$data);
	}

  	public function ubah_simpan_sales_report(){
  		$this->auth->restrict();
	    $this->load->model('Bonusmodel');	    
	    $this->Bonusmodel->ubahSalesReport();

		$data['sales_report'] = $this->Bonusmodel->sales_report();
		$this->load->view('bonus/sales_report',$data);

  	}

	public function hapus_sales_report($id_sales_report){
		$this->auth->restrict();
		$this->id_sales_report = $id_sales_report;
		$this->Bonusmodel->hapusSalesReport($id_sales_report); 		

		$data['poin_sales_report'] = $this->Bonusmodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Bonusmodel->sales_report_after_tambah();

		$this->load->view('bonus/sales_report',$data);
	}

	public function ubah_approve($id_sales_report){
		$this->auth->restrict();
		$this->Bonusmodel->ubah_approve($id_sales_report);

		redirect('bonus');
	}

	public function login()
	{	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->template->set('title','Login Form | DreamTour.co');
			$this->template->load('template','bonus/login_form_poin');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('bonus');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->template->load('template','bonus/login_form_poin',$data);		
			}
		}
	}
	function logout()
	{
		if($this->auth->is_logged_in() == true)
		{
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('bonus');
	}
}