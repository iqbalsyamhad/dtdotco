<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kuesioner_model');
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
			$this->load->model('kuesioner_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->kuesioner_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('kuesioner/dashboard',$data);
			$this->load->view('kuesioner/awal');
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
			$this->load->view('kuesioner/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('kuesioner');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('kuesioner/login_view',$data);		
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
		redirect('kuesioner');
	}

	public function ubah_password($user_id)
	{	$this->auth->restrict();
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(10);
		$where['user_id'] = $user_id;
		$a = $this->db->get_where('user',$where)->row();
		$data['user_id'] = $user_id;
		$data['user_nama'] = $a->user_nama;
		$data['user_username'] = $a->user_username;
		$data['user_password'] = $a->user_password;
		$data['user_level'] = $a->user_level;


			// load model 'usermodel'
		$this->load->model('usermodel');
			// level untuk user ini
		$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
		$data['menu'] = $this->usermodel->get_menu_for_level($level);

		$this->load->view('kuesioner/dashboard',$data);
		$this->load->view('kuesioner/ubah_password');
	}

	public function ubahSimpanPassword()
	{	$this->auth->restrict();
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->load->view('kuesioner/login_view');	
	}

	public function awal()
	{	$this->auth->restrict();
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/awal');
	}

	//tambah
	public function tambah()
	{	
		$this->auth->restrict();
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view1_tambah');
	}

	public function tambah1()
	{	$this->auth->restrict();		
		$this->Kuesioner_model->kuesioner_simpan();

		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view1_tambah');
	}

	public function tambah_keberangkatan()
	{
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view2_tambah');
	}

	public function tambah_keberangkatan1()
	{	$this->auth->restrict();
		$this->Kuesioner_model->keberangkatan_simpan();

		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view2_tambah');
	}

	public function laporan_keberangkatan()
	{	$this->auth->restrict();
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view1');
	}

	public function laporan_keberangkatan1()
	{	$this->auth->restrict();
		$data['id_keberangkatan'] = $this->input->post('keberangkatan');

		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view0',$data);
	}

	public function laporan()
	{	$this->auth->restrict();
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/1/view2');
	}

	public function kuesioner2_1_tambah1()
	{	$this->auth->restrict();	
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'id_pemesanan' => $this->input->post('id_pemesanan'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_kloter' => $this->input->post('id_kloter'),
			'jumlah' => $this->input->post('jumlah')
			);
		$this->Usermodel->kuesioner1_1_tambah($data);

		$this->load->view('kuesioner/dashboard1');
		$this->load->view('kuesioner/2/view1');
	}

	public function view_2()
	{	$this->auth->restrict();
		$this->load->view('kuesioner/dashboard');
		$this->load->view('kuesioner/view_kano');
	}

}