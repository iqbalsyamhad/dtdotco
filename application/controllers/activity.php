<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller
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
			$this->load->view('activity/dashboard'); 
			$this->load->view('activity/homepage'); 
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
			$this->load->view('activity/login_view');
		}
		else

		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke 
				redirect('activity');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('activity/login_view',$data);		
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
		redirect('activity');
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

		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/listabsent',$data);
	}

	public function lihatabsent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		
		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/lihatabsent');
	}

	//EVENT
	public function listevent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['event'] = $this->Employee_model->listevent();

		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/listevent',$data);

	}

	//ABSENT
	public function enter_absent()
	{
		$this->auth->restrict();

		$data['senin'] = $this->Employee_model->absentsenin();
		$data['selasa'] = $this->Employee_model->absentselasa();
		$data['rabu'] = $this->Employee_model->absentrabu();
		$data['kamis'] = $this->Employee_model->absentkamis();
		$data['jumat'] = $this->Employee_model->absentjumat();
		$data['sabtu'] = $this->Employee_model->absentsabtu();
		$data['minggu'] = $this->Employee_model->absentminggu();
		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/tambahabsen',$data);

	}

	public function simpantambahabsent()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict(); // mencegah user mengakses menu yang tidak boleh ia buka
		$this->Employee_model->simpantambahabsent(); 
		//$this->Employee_model->updatesisajam();

		$project = $this->input->post('project');

		$count ="select count(id_absent) as count
			from employee_absent where id_project = '$project'";
			$maxquery= mysql_query($count);
			while($row = mysql_fetch_assoc($maxquery)) {
			$terpakai=$row['count'];}
		// jumlah jam
		$jumlah_jam ="select jumlah_jam as jam
			from employee_project where id_project = '$project'";
			$maxquery= mysql_query($jumlah_jam);
			while($row = mysql_fetch_assoc($maxquery)) {
			$jam=$row['jam'];}
		// sisa jumlah jam
		$sisajam = $jam - ($terpakai);

		// update sisa jam
		$data['jam_sisa'] = $sisajam;
		$this->db->where('id_project',$project);
		$this->db->update('employee_project',$data);

		//simpan absen
		redirect('activity/enter_absent');
	}

	public function efficiency()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['project'] = $this->Employee_model->listproject();

		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/efficiency',$data);
	}

	// Information
	public function listinformation()
	{
		$this->auth->restrict(); // mencegah user yang belum login untuk mengakses halaman ini

		$data['information'] = $this->Employee_model->listinformation();

		$this->load->view('activity/dashboard'); 
		$this->load->view('activity/listinformation',$data);
	}
	
}
?>