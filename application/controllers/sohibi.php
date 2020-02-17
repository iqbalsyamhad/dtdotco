<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sohibi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sohibi_usermodel');
	}

	public function index()
	{
		$this->load->view('sohibi/intro');
	}

	public function login_member()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}
		else
		{
			// load model 'usermodel'
			$this->load->model('sohibi_usermodel');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->sohibi_usermodel->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('sohibi/awal',$data);
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
			$this->load->view('sohibi/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('sohibi/login_member');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('sohibi/login',$data);		
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
		redirect('sohibi');
	}

	public function daftar()
	{
		$this->load->view('sohibi/daftar');
	}

	public function daftar_send()
	{
     	$this->load->view('sohibi/daftar_send');
	}

	public function calon_jamaah()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(39);

		$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilCalonJamaah();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('sohibi/calon_jamaah',$data);
	}

	public function tambah_calon_jamaah()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(39);


		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('sohibi/tambah_calon_jamaah');
	}

	public function tambah_calon_jamaah_1()
	{	
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'user_id' => $this->input->post('user_id'),
			'nama' => $this->input->post('nama'),
			'no_paspor' => $this->input->post('no_paspor'),
			'scan_paspor' => $this->input->post('scan_paspor'),
			'status' => $this->input->post('status')
			);

		$this->Sohibi_usermodel->tambahCalonJamaah($data);

		redirect ('sohibi/calon_jamaah');
	}

	public function do_upload_scan_paspor()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/images/calonJamaah';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'jpg|jpeg',
            'max_size'      => 5000,
            'remove_space'  => TRUE,
            
        );
        // $data['ticket'] = $this->Usermodel->tampilTicket();

		// $this->template->set('title','Ticketing | DreamTour.co');
		// $this->template->load('template','admin/ticketing',$data);

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            //echo json_encode($upload_error);
			redirect ('sohibi/calon_jamaah');
        } else {
            //$file_info = $this->upload->data();
           // echo json_encode($file_info);
			$data = $this->upload->data();
			foreach($data as $item => $value):
				if($item == 'file_name')
				{
					$nama_file = $value;
				}
			endforeach;

			$this->Sohibi_usermodel->tambahCalonJamaah1($nama_file);
			
			
			$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilCalonJamaah();

			// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
			$this->load->view('sohibi/calon_jamaah',$data);
        }
    }

	public function hapus_calon_jamaah($id)
	{
		$this->id = $id;
		$this->Sohibi_usermodel->hapusCalonJamaah($id); 

		$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilCalonJamaah();

		$this->load->view('sohibi/calon_jamaah',$data);
	}

	public function ubah_calon_jamaah($id){
	    $this->load->model('Sohibi_usermodel');
	    $where['id'] = $id;
	    $a=$this->db->get_where('tb_calon_jamaah',$where)->row();
	    $data['id']=$id;
	    $data['no_paspor']=$a->no_paspor;
	    $data['nama']=$a->nama;
	    $data['status']=$a->status;
	    $data['tanggal']=$a->tanggal;

	    $this->load->view('sohibi/ubah_calon_jamaah',$data);

    // $data = $this->input->post('ds');
	}

  	public function ubah_simpan_calon_jamaah()
  	{
	    $this->load->model('Sohibi_usermodel');
	    
	    $this->Sohibi_usermodel->ubahCalonJamaah();
	    
		$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilCalonJamaah();

		redirect('sohibi/calon_jamaah');

  	}

  	// ADMIN  	

	public function admin_calon_jamaah()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(39);

		$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilAdminCalonJamaah();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('sohibi/admin_calon_jamaah',$data);
	}

	public function admin_ubah_status($id){
		$this->id = $id;
		$this->Sohibi_usermodel->adminUbahStatus($id);

		$data['calon_jamaah'] = $this->Sohibi_usermodel->tampilAdminCalonJamaah();
		$this->load->view('sohibi/admin_calon_jamaah',$data);
	}	

	public function admin_komisi_sohibi()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(39);

		$data['komisi_sohibi'] = $this->Sohibi_usermodel->tampilAdminKomisiSohibi();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('sohibi/admin_komisi_sohibi',$data);
	}

	//KOMISI

	public function komisi()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(39);

		$data['calon_jamaah_confirmed'] = $this->Sohibi_usermodel->tampilCalonJamaahConfirmed();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('sohibi/komisi',$data);
	}

	public function ubah_komisi_umroh($id){
		$this->id = $id;
		$this->Sohibi_usermodel->ubahKomisiUmroh($id);

		$data['calon_jamaah_confirmed'] = $this->Sohibi_usermodel->tampilCalonJamaahConfirmed();
		$this->load->view('sohibi/komisi',$data);
	}

	public function ubah_komisi_cash($id){
		$this->id = $id;
		$this->Sohibi_usermodel->ubahKomisiCash($id);

		$data['calon_jamaah_confirmed'] = $this->Sohibi_usermodel->tampilCalonJamaahConfirmed();
		$this->load->view('sohibi/komisi',$data);
	}
}