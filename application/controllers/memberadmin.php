<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memberadmin extends CI_Controller
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
			// load model 'usermodel'
			$this->load->model('usermodel');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->usermodel->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 

			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/contact/awal'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 5; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact'] = $this->Usermodel->tampilContactMember($config['per_page'],$this->uri->segment(3));

			//$data['contact'] = $this->Usermodel->tampilContact();
			// mencegah user yang belum login untuk mengakses halaman ini
			$this->auth->restrict();
			// mencegah user mengakses menu yang tidak boleh ia buka
			$this->auth->cek_menu(36);

			$this->load->view('memberadmin/dashboard');
			$this->load->view('memberadmin/index',$data);
		}
	}

	public function member()
	{
		$this->db->select('*');
		$this->db->from('customer_contact');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'memberadmin/member'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '25'; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['contact'] = $this->Usermodel->tampilMember($config['per_page'],$this->uri->segment(3));

	//	$data['contact'] = $this->Usermodel->cariContact();

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/member',$data);

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
			$this->load->view('memberadmin/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('memberadmin');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('memberadmin/login_view',$data);		
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
		redirect('memberadmin');
	}

	public function tambah()
	{	
		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/tambah');
	}

	public function simpan(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'hp' => $this->input->post('hp'),
			'tgl_lahir' => $this->input->post('lahir'),
			'tempat_lahir' => $this->input->post('empat_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'email' => $this->input->post('email'),
			'lokasi' => $this->input->post('lokasi'),
			'grade' => $this->input->post('grade'),
			'jenis' => "2",
			);

		$this->Usermodel->simpanContactMember($data);
		$this->Usermodel->simpanMember1();

		$this->db->select('*');
		$this->db->from('customer_contact');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/memberadmin/index'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 5; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact'] = $this->Usermodel->tampilMember($config['per_page'],$this->uri->segment(3));

		//$data['contact'] = $this->Usermodel->tampilContact();
			redirect('memberadmin/member',$data);
		}

		public function hapus_contact($id_contact){
			$this->id_contact = $id_contact;
			$this->Usermodel->hapus_contact($id_contact);

			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/contact/awal'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 5; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact'] = $this->Usermodel->tampilContact($config['per_page'],$this->uri->segment(3));

		//$data['contact'] = $this->Usermodel->tampilContact();
			redirect('contact/',$data);
		}

		function bemember($id_contact){
			$where['id_contact'] = $id_contact;
			$a = $this->db->get_where('customer_contact',$where)->row();
			$data['id_contact'] = $id_contact;
			$data['nama'] = $a->nama;
			$data['tempat_lahir'] = $a->tempat_lahir;
			$data['jenis_kelamin'] = $a->jenis_kelamin;
			$data['tgl_lahir'] = $a->tgl_lahir;
			$data['hp'] = $a->hp;
			$data['email'] = $a->email;
			$data['lokasi'] = $a->lokasi;
			$data['grade'] = $a->grade;

			$this->load->view('memberadmin/dashboard',$data);
			$this->load->view('memberadmin/bemember',$data);
		}

		function simpan_bemember(){
		//Update customer_contact table
			$this->Usermodel->cek_bemember();

			$this->Usermodel->simpanMember();

			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/contact/awal'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 5; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact'] = $this->Usermodel->tampilContact($config['per_page'],$this->uri->segment(3));
		//$data['contact'] = $this->Usermodel->tampilContact();
			redirect('memberadmin/',$data);
		}

		function cariContact(){
		$this->db->select('*');
		$this->db->from('customer_contact');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/contact/awal'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '25'; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['contact'] = $this->Usermodel->cariContactMember($config['per_page'],$this->uri->segment(3));

	//	$data['contact'] = $this->Usermodel->cariContact();

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/index',$data);
	}

		function cariMember(){
			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
			
		$config['base_url'] = base_url().'index.php/contact/awal'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '25'; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['contact'] = $this->Usermodel->cariMember($config['per_page'],$this->uri->segment(3));

	//	$data['contact'] = $this->Usermodel->cariContact();

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/member',$data);

	}

	function tampilRedeem(){
		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/redeem');		
	}

	function redeemLengkap(){             
		$data['member'] = $this->Usermodel->cariNamaMember();		

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/redeemLengkap',$data);		
	}

	function redeemPoin(){
		$this->Usermodel->simpanRedeemPoin();
		$this->Usermodel->updateRedeemPoin();

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/redeem');
	}

	function tampilTambah(){
		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/tambahPoin');		
	}

	function tambahLengkap(){             
		$data['member'] = $this->Usermodel->cariNamaMember();		

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/tambahPoinLengkap',$data);		
	}

	function tambahPoin(){
		$this->Usermodel->simpanTambahPoin();
		$this->Usermodel->updateTambahPoin();

		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/tambahPoin');
	}

	function history(){
		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/history');
	}

	function historyLengkap(){
		$data['member'] =  $this->Usermodel->historyMember();
		$this->load->view('memberadmin/dashboard');
		$this->load->view('memberadmin/historyTransaksi',$data);
	}

}