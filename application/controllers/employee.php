<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');
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
			$this->load->model('employee_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->employee_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('employee/dashboard'); 
			$this->load->view('employee/homepage'); 
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
			$this->load->view('employee/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				 if ($username == 'dania') {
					redirect('employee');
					}
			  if ($username == 'halid') {
					redirect('employee');
					}
			  if ($username == 'dewi') {
					redirect('employee');
					}
			  if ($username == 'ryan') {
					redirect('employee');
					}
			  if ($username == 'reza.mehtha@dreamtour.co') {
					redirect('employee');
					} else{
				// lemparkan ke halaman index user
				redirect('activity');}
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('employee/login_view',$data);		
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
		redirect('employee');
	}

	// EMPLOYEE
	public function listkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listkaryawan');
	}

	public function tambahkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/tambahkaryawan');
	}

	public function simpantambahkaryawan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->tambahkaryawan_simpan();

		redirect('employee/listkaryawan');
	}	

	public function hapuskaryawan($user_lembur)
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		$this->user_lembur = $user_lembur;
		$this->Employee_model->hapusKaryawan($user_lembur);

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listkaryawan');
	}

	public function edit_karyawan($user_lembur)
	{
		$where['user_lembur'] = $user_lembur;
		$a = $this->db->get_where('lembur_user',$where)->row();
		$data['user_lembur'] = $user_lembur;
		$data['nama'] = $a->nama;
		$data['email'] = $a->email;
		$data['jenis'] = $a->jenis;
		$data['lv'] = $a->level;
		$data['tanggal_masuk'] = $a->tanggal_masuk;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/edit_karyawan',$data);
	}

	public function edit_karyawan_simpan()
	{
		$this->Employee_model->editKaryawan();

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listkaryawan');
	}

	// PROJECT
	public function listproject()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['project'] = $this->Employee_model->listproject();

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listproject',$data);
	}

	// tambah project
	public function tambahproject()
	{
	$this->load->view('employee/dashboard'); 
		$this->load->view('employee/tambahproject');
	}

	// simpan tambah project
	public function simpantambahproject()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->tambahproject_simpan();

		redirect('employee/listproject');
	}

	// edit project
	public function editteam($id_project)
	{
		$where['id_project'] = $id_project;
		$a = $this->db->get_where('employee_project',$where)->row();
		$data['id_project'] = $id_project;
		$data['jenis'] = $a->jenis;
		$data['nama'] = $a->nama;
		$data['jumlah_jam'] = $a->jumlah_jam;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/updateproject',$data);
	}

	// simpan edit project
	public function updateproject_simpan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->updateproject_simpan();

		redirect('employee/listproject');
	}

	// tambah team
	public function tambahteam($id_project)
	{
		$where['id_project'] = $id_project;
		$a = $this->db->get_where('employee_project',$where)->row();
		$data['id_project'] = $id_project;
		$data['jenis'] = $a->jenis;
		$data['nama'] = $a->nama;
		$data['jumlah_jam'] = $a->jumlah_jam;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/tambahproject_team',$data);
	}

	// tambah team yang kirim email
	public function tambahteamsend($id_project)
	{
		$where['id_project'] = $id_project;
		$a = $this->db->get_where('employee_project',$where)->row();
		$data['id_project'] = $id_project;
		$data['jenis'] = $a->jenis;
		$data['nama'] = $a->nama;
		$data['jumlah_jam'] = $a->jumlah_jam;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/tambahproject_team_send',$data);
	}


	// simpan tambah team 
	public function simpantambahteam()
	{
	$this->load->view('employee/dashboard'); 
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->tambahteam_simpan(); 
		$id = $this->input->post('id_project');
		redirect('employee/tambahteamsend/'.$id);
	}

	public function hapusteam($id)
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		$this->id = $id;
		$this->Employee_model->hapusTeam($id);

		//$this->load->view('employee/dashboard'); 
		//$this->load->view('employee/tambahproject');

		redirect('employee/listproject');
	}


	
	public function hapusproject($id_project)
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		$this->id_project = $id_project;
		$this->Employee_model->hapusProject($id_project);

		redirect('employee/listproject');
	}

	// LIST ABSENT
	public function lihatabsent()
	{	
		
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		//$data['project'] = $this->Employee_model->listproject();
		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/lihatabsent');
	}

	public function listabsent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$karyawan = $_POST['karyawan'];
		$data['bulan'] = $_POST['bulan'];
		$data['tahun'] = $_POST['tahun'];
		$data['karyawan'] = $karyawan;
		
		$where['user_id'] = $karyawan;
		$a = $this->db->get_where('lembur_user',$where)->row();
		$data['nama'] = $a->nama;

		

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listabsent',$data);
	}

	// EVENT
	public function listevent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['event'] = $this->Employee_model->listevent();

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listevent',$data);
	}

	public function hapusevent($id_event)
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		$this->id_event = $id_event;
		$this->Employee_model->hapusEvent($id_event);

		redirect('employee/listevent');
	}

	public function tambahevent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/tambahevent');
	}

	public function simpantambahevent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->tambahevent_simpan();

		redirect('employee/listevent');
	}

	public function updateevent($id_event)
	{
		$where['id_event'] = $id_event;
		$a = $this->db->get_where('employee_event',$where)->row();
		$data['id_event'] = $a->id_event;
		$data['nama'] = $a->nama;
		$data['tanggal'] = $a->tanggal;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/updateevent',$data);
	}

	public function updateevent_simpan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->updateevent_simpan();

		redirect('employee/listevent');
	}	

	// Information
	public function listinformation()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['information'] = $this->Employee_model->listinformation();

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/listinformation',$data);
	}

	public function simpantambahinformation()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->tambahinformation_simpan();

		redirect('employee/listinformation');
	}

	public function hapusinformation($id_information)
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->id_information = $id_information;
		$this->Employee_model->hapusinformation($id_information);

		redirect('employee/listinformation');
	}

	public function updateinformation($id_information)
	{
		$where['id_information'] = $id_information;
		$a = $this->db->get_where('employee_information',$where)->row();
		$data['id_information'] = $id_information;
		$data['information'] = $a->information;

		$this->load->view('employee/dashboard'); 
		$this->load->view('employee/updateinformation',$data);
	}

	public function updateinformation_simpan()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka

		$this->Employee_model->updateinformation_simpan();

		redirect('employee/listinformation');
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

?>