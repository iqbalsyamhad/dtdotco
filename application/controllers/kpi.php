<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kpi_model');
	}

	public function index()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}
		else
		{
			// load model 'usermodel'
			$this->load->model('usermodel');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->usermodel->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('kpi/dashboard'); 
			$this->load->view('kpi/view_performa_awal',$data);
		}
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
			$this->load->view('kpi/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('kpi');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('kpi/login_view',$data);		
			}
		}
	}

	public function logout()
	{
		if($this->auth->is_logged_in() == true)
		{
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('kpi');
	}

	public function listkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$data['karyawan'] = $this->Kpi_model->listkaryawan();
		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/listkaryawan',$data);
	}

	public function tambahkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/tambahkaryawan');
	}

	public function simpantambahkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Kpi_model->tambahkaryawan_simpan();

		redirect('kpi/tambahkaryawan');

	}

	public function updateperforma()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/updateperforma');
	}

	public function viewperforma()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/view_performa_awal');
	}

	public function lihatperforma()
	{
		$this->auth->restrict();
		$data['performa'] = $this->Kpi_model->lihatperforma();
		$this->load->view('kpi/dashboard');
		$this->load->view('kpi/view_performa',$data);
	}

	public function updateperformabod()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		
		$this->Kpi_model->updateperformabod_simpan();

		redirect('kpi/updateperforma');
	}

	public function updateperformahr()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		
		$this->Kpi_model->updateperformahr_simpan();

		redirect('kpi/updateperforma');
	}

	public function view_absen()
	{
		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/view_absensi');
	}

	public function updateabsen()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('kpi/dashboard'); 
		$this->load->view('kpi/updateabsensi');
		
		//$this->Kpi_model->updateabsen_simpan();

		//redirect('kpi/updateabsen');
	}

	public function updateabsensi()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		
		$this->Kpi_model->updateabsen_simpan();

		redirect('kpi/updateabsen');
	}

	public function lihatabsensi()
	{
		$this->auth->restrict();
		$data['absen'] = $this->Kpi_model->lihatabsensi();
		$this->load->view('kpi/dashboard');
		$this->load->view('kpi/view_absensi',$data);
	}


	

	

	
}