<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charterx extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('charter_model');
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
			$this->load->model('charter_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->charter_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('charterx/dashboard',$data);
			$this->load->view('charterx/awal');
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
			$this->load->view('charterx/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('charterx');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('charterx/login_view',$data);		
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
		redirect('charterx');
	}

	public function ubah_password($user_id)
	{
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

		$this->load->view('charterx/dashboard',$data);
		$this->load->view('charterx/ubah_password');
	}

	public function ubahSimpanPassword()
	{
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->load->view('charterx/login_view');	
	}

	public function awal()
	{
		$this->load->view('charterx/dashboard');
		$this->load->view('charterx/awal');
	}

	public function charter1_1() //kloter 1 tripuri
	{
		$data['kloter'] = "1";
		$data['tanggal'] = "03 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_2() //kloter 2 tripuri
	{	
		$data['kloter'] = "2";
		$data['tanggal'] = "07 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_3() //kloter 3 tripuri
	{
		$data['kloter'] = "3";
		$data['tanggal'] = "10 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_4() //kloter 4 tripuri
	{
		$data['kloter'] = "4";
		$data['tanggal'] = "14 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_5() //kloter 5 tripuri
	{
		$data['kloter'] = "5";
		$data['tanggal'] = "16 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_6() //kloter 6 tripuri
	{
		$data['kloter'] = "6";
		$data['tanggal'] = "21 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_7() //kloter 7 tripuri
	{
		$data['kloter'] = "7";
		$data['tanggal'] = "23 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_8() //kloter 8 tripuri
	{
		$data['kloter'] = "8";
		$data['tanggal'] = "28 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_9() //kloter 9 tripuri
	{
		$data['kloter'] = "9";
		$data['tanggal'] = "30 Desember 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_10() //kloter 10 tripuri
	{
		$data['kloter'] = "10";
		$data['tanggal'] = "04 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_11() //kloter 11 tripuri
	{
		$data['kloter'] = "11";
		$data['tanggal'] = "06 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_12() //kloter 12 tripuri
	{
		$data['kloter'] = "12";
		$data['tanggal'] = "11 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_13() //kloter 13 tripuri
	{
		$data['kloter'] = "13";
		$data['tanggal'] = "13 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_14() //kloter 14 tripuri
	{	
		$data['kloter'] = "14";
		$data['tanggal'] = "18 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_15() //kloter 15 tripuri
	{
		$data['kloter'] = "15";
		$data['tanggal'] = "20 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_16() //kloter 16 tripuri
	{
		$data['kloter'] = "16";
		$data['tanggal'] = "25 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_17() //kloter 17 tripuri
	{
		$data['kloter'] = "17";
		$data['tanggal'] = "27 Januari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_18() //kloter 18 tripuri
	{
		$data['kloter'] = "18";
		$data['tanggal'] = "01 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_19() //kloter 19 tripuri
	{
		$data['kloter'] = "19";
		$data['tanggal'] = "03 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_20() //kloter 20 tripuri
	{
		$data['kloter'] = "20";
		$data['tanggal'] = "08 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_21() //kloter 21 tripuri
	{
		$data['kloter'] = "21";
		$data['tanggal'] = "10 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_22() //kloter 22 tripuri
	{
		$data['kloter'] = "22";
		$data['tanggal'] = "15 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_23() //kloter 23 tripuri1
	{
		$data['kloter'] = "23";
		$data['tanggal'] = "17 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_24() //kloter 24 tripuri1
	{
		$data['kloter'] = "24";
		$data['tanggal'] = "22 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_25() //kloter 25 tripuri
	{
		$data['kloter'] = "25";
		$data['tanggal'] = "24 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_26() //kloter 26 tripuri
	{
		$data['kloter'] = "26";
		$data['tanggal'] = "29 Februari 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_27() //kloter 27 tripuri
	{
		$data['kloter'] = "27";
		$data['tanggal'] = "02 Maret 2016";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_28() //kloter 27 tripuri
	{
		$data['kloter'] = "28";
		$data['tanggal'] = "07 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}

	public function charter1_29() //kloter 27 tripuri
	{
		$data['kloter'] = "29";
		$data['tanggal'] = "09 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_30() //kloter 27 tripuri
	{
		$data['kloter'] = "30";
		$data['tanggal'] = "14 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_31() //kloter 27 tripuri
	{
		$data['kloter'] = "31";
		$data['tanggal'] = "16 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_32() //kloter 27 tripuri
	{
		$data['kloter'] = "32";
		$data['tanggal'] = "21 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_33() //kloter 27 tripuri
	{
		$data['kloter'] = "33";
		$data['tanggal'] = "23 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_34() //kloter 27 tripuri
	{
		$data['kloter'] = "34";
		$data['tanggal'] = "28 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	public function charter1_35() //kloter 27 tripuri
	{
		$data['kloter'] = "35";
		$data['tanggal'] = "30 Maret 2015";
		$this->load->view('charterx/dashboard1');
		$this->load->view('charterx/1/view2',$data);
	}
	

	//kloter 1 tripuri tambah
	public function charter1_1_tambah()
	{
		// load model 'usermodel'
		$this->load->model('usermodel');
		// level untuk user ini
		$level = $this->session->userdata('level');
		// ambil menu dari database sesuai dengan level
		$data['menu'] = $this->usermodel->get_menu_for_level($level);
		$this->load->view('charterx/dashboard',$data);
		$this->load->view('charterx/1/view1_tambah');
	}

	public function charter1_1_tambah1()
	{		
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'id_pemesanan' => $this->input->post('id_pemesanan'),
			'id_kloter' => $this->input->post('id_kloter'),
			'jumlah' => $this->input->post('jumlah'),
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('keterangan')
			);
		$this->charter_model->charterx_tambah($data);


		if ($this->input->post('id_kloter')==1) {
			$data['kloter'] = "1";
			$data['tanggal'] = "03 Desember 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==2){ 
			$data['kloter'] = "2";
			$data['tanggal'] = "07 Desember 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==3){ 
			$data['kloter'] = "3";
			$data['tanggal'] = "10 Desember 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==4){ 
			$data['kloter'] = "4";
			$data['tanggal'] = "14 Desember 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==5){ 
			$data['kloter'] = "5";
			$data['tanggal'] = "16 Desember 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==6){ 
			$data['kloter'] = "6";
			$data['tanggal'] = "21 Desember 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==7){ 
			$data['kloter'] = "7";
			$data['tanggal'] = "23 Desember 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==8){ 
			$data['kloter'] = "8";
			$data['tanggal'] = "28 Desember 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==9){ 
			$data['kloter'] = "9";
			$data['tanggal'] = "30 Desember 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==10){ 
			$data['kloter'] = "10";
			$data['tanggal'] = "04 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==11){ 
			$data['kloter'] = "11";
			$data['tanggal'] = "06 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==12){ 
			$data['kloter'] = "12";
			$data['tanggal'] = "11 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==13){ 
			$data['kloter'] = "13";
			$data['tanggal'] = "13 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==14){ 
			$data['kloter'] = "14";
			$data['tanggal'] = "18 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==15){ 
			$data['kloter'] = "15";
			$data['tanggal'] = "20 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==16){ 
			$data['kloter'] = "16";
			$data['tanggal'] = "25 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==17){ 
			$data['kloter'] = "17";
			$data['tanggal'] = "27 Januari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==18){ 
			$data['kloter'] = "18";
			$data['tanggal'] = "01 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==19){ 
			$data['kloter'] = "19";
			$data['tanggal'] = "03 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==20){ 
			$data['kloter'] = "20";
			$data['tanggal'] = "08 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==21){ 
			$data['kloter'] = "21";
			$data['tanggal'] = "10 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==22){ 
			$data['kloter'] = "22";
			$data['tanggal'] = "15 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==23){ 
			$data['kloter'] = "23";
			$data['tanggal'] = "17 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==24){ 
			$data['kloter'] = "24";
			$data['tanggal'] = "22 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==25){ 
			$data['kloter'] = "25";
			$data['tanggal'] = "24 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==26){ 
			$data['kloter'] = "26";
			$data['tanggal'] = "29 Februari 2016";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==27){ 
			$data['kloter'] = "27";
			$data['tanggal'] = "02 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==28){ 
			$data['kloter'] = "28";
			$data['tanggal'] = "07 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==29){ 
			$data['kloter'] = "29";
			$data['tanggal'] = "09 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==30){ 
			$data['kloter'] = "30";
			$data['tanggal'] = "14 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==31){ 
			$data['kloter'] = "31";
			$data['tanggal'] = "16 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==32){ 
			$data['kloter'] = "32";
			$data['tanggal'] = "21 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==33){ 
			$data['kloter'] = "33";
			$data['tanggal'] = "23 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==34){ 
			$data['kloter'] = "34";
			$data['tanggal'] = "28 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==35){ 
			$data['kloter'] = "35";
			$data['tanggal'] = "30 Maret 2015";
			$this->load->view('charterx/dashboard1');
			$this->load->view('charterx/1/view2',$data);
		}


	}

}