<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class POin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}
	public function index()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}
		else
		{
			$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();
		
			$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();

			$this->load->view('admin/sales_report',$data);
		}
	}

	// SALES REPORT

	public function sales_report_cari(){
		$data['sales_report'] = $this->Usermodel->sales_report_cari();	
		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report();	

		$this->load->view('admin/sales_report',$data);
	}

	public function sales_report(){
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();
		
		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
	}

	public function tambah_sales_report(){
		$this->load->view('admin/sales_report_tambah');
	}

	public function tambah_sales_report_1(){
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'paket' => $this->input->post('paket'),
			'tgl_berangkat' => $this->input->post('tgl_berangkat'),
			'jml_jamaah' => $this->input->post('jml_jamaah'),
			'keterangan' => $this->input->post('keterangan'),
			'bulan' => $this->input->post('bulan'),
			'tahun' => $this->input->post('tahun')
			);

		$this->Usermodel->tambahSalesReport($data);

		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
	}

	public function ubah_sales_report($id_sales_report){
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

	    $this->load->view('admin/sales_report_ubah',$data);
	}

  	public function ubah_simpan_sales_report(){

	    $this->load->model('Usermodel');	    
	    $this->Usermodel->ubahSalesReport();

		$data['sales_report'] = $this->Usermodel->sales_report();
		$this->load->view('admin/sales_report',$data);

  	}

	public function hapus_sales_report($id_sales_report){
		$this->id_sales_report = $id_sales_report;
		$this->Usermodel->hapusSalesReport($id_sales_report); 		

		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
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
			$this->template->load('template','admin/login_form_poin');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('poin');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->template->load('template','admin/login_form_poin',$data);		
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
		redirect('index.php/poin');
	}
}