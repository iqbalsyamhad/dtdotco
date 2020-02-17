<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charter extends CI_Controller
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
			$this->load->view('charter/dashboard',$data);
			$this->load->view('charter/awal');
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
			$this->load->view('charter/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('charter');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('charter/login_view',$data);		
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
		redirect('charter');
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

		$this->load->view('charter/dashboard',$data);
		$this->load->view('charter/ubah_password');
	}

	public function ubahSimpanPassword()
	{
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->load->view('charter/login_view');	
	}

	public function awal()
	{
		$this->load->view('charter/dashboard');
		$this->load->view('charter/awal');
	}

	public function charter1_1() //kloter 1 tripuri
	{
		$data['kloter'] = "62";
		$data['tanggal'] = "3 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_2() //kloter 2 tripuri
	{	
		$data['kloter'] = "63";
		$data['tanggal'] = "10 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_3() //kloter 3 tripuri
	{
		$data['kloter'] = "64";
		$data['tanggal'] = "17 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_4() //kloter 4 tripuri
	{
		$data['kloter'] = "65";
		$data['tanggal'] = "24 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_5() //kloter 5 tripuri
	{
		$data['kloter'] = "66";
		$data['tanggal'] = "31 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_6() //kloter 6 tripuri
	{
		$data['kloter'] = "67";
		$data['tanggal'] = "07 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_7() //kloter 7 tripuri
	{
		$data['kloter'] = "68";
		$data['tanggal'] = "14 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_8() //kloter 8 tripuri
	{
		$data['kloter'] = "69";
		$data['tanggal'] = "21 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_9() //kloter 9 tripuri
	{
		$data['kloter'] = "70";
		$data['tanggal'] = "28 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_10() //kloter 10 tripuri
	{
		$data['kloter'] = "71";
		$data['tanggal'] = "04 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_11() //kloter 11 tripuri
	{
		$data['kloter'] = "72";
		$data['tanggal'] = "11 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_12() //kloter 12 tripuri
	{
		$data['kloter'] = "73";
		$data['tanggal'] = "18 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_13() //kloter 13 tripuri
	{
		$data['kloter'] = "74";
		$data['tanggal'] = "25 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_14() //kloter 14 tripuri
	{
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view14',$data);
	}

	public function charter1_15() //kloter 15 tripuri
	{
		$data['kloter'] = "75";
		$data['tanggal'] = "03 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_16() //kloter 16 tripuri
	{
		$data['kloter'] = "76";
		$data['tanggal'] = "10 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_17() //kloter 17 tripuri
	{
		$data['kloter'] = "77";
		$data['tanggal'] = "17 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_18() //kloter 18 tripuri
	{
		$data['kloter'] = "78";
		$data['tanggal'] = "24 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_19() //kloter 19 tripuri
	{
		$data['kloter'] = "79";
		$data['tanggal'] = "31 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_20() //kloter 20 tripuri
	{
		$data['kloter'] = "80";
		$data['tanggal'] = "07 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_21() //kloter 21 tripuri
	{
		$data['kloter'] = "81";
		$data['tanggal'] = "14 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_22() //kloter 22 tripuri
	{
		$data['kloter'] = "82";
		$data['tanggal'] = "21 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_23() //kloter 23 tripuri1
	{
		$data['kloter'] = "83";
		$data['tanggal'] = "28 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_24() //kloter 24 tripuri1
	{
		$data['kloter'] = "84";
		$data['tanggal'] = "05 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_25() //kloter 25 tripuri
	{
		$data['kloter'] = "85";
		$data['tanggal'] = "12 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_26() //kloter 26 tripuri
	{
		$data['kloter'] = "86";
		$data['tanggal'] = "19 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_27() //kloter 27 tripuri
	{
		$data['kloter'] = "87";
		$data['tanggal'] = "26 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_28() //kloter 27 tripuri
	{
		$data['kloter'] = "88";
		$data['tanggal'] = "02 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_29() //kloter 27 tripuri
	{
		$data['kloter'] = "89";
		$data['tanggal'] = "07 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_30() //kloter 27 tripuri
	{
		$data['kloter'] = "90";
		$data['tanggal'] = "09 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_31() //kloter 27 tripuri
	{
		$data['kloter'] = "91";
		$data['tanggal'] = "14 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_32() //kloter 27 tripuri
	{
		$data['kloter'] = "92";
		$data['tanggal'] = "16 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_33() //kloter 27 tripuri
	{
		$data['kloter'] = "93";
		$data['tanggal'] = "21 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_34() //kloter 27 tripuri
	{
		$data['kloter'] = "94";
		$data['tanggal'] = "23 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_35() //kloter 27 tripuri
	{
		$data['kloter'] = "95";
		$data['tanggal'] = "28 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_36() //kloter 27 tripuri
	{
		$data['kloter'] = "96";
		$data['tanggal'] = "30 Desember 2015";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_101() 
	{
		$data['kloter'] = "97";
		$data['tanggal'] = "02 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_37() 
	{
		$data['kloter'] = "98";
		$data['tanggal'] = "04 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_38() 
	{
		$data['kloter'] = "99";
		$data['tanggal'] = "06 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_39() 
	{
		$data['kloter'] = "100";
		$data['tanggal'] = "09 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_40() 
	{
		$data['kloter'] = "101";
		$data['tanggal'] = "11 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_41() 
	{
		$data['kloter'] = "102";
		$data['tanggal'] = "13 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_42() 
	{
		$data['kloter'] = "103";
		$data['tanggal'] = "16 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_43() 
	{
		$data['kloter'] = "104";
		$data['tanggal'] = "18 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_44() 
	{
		$data['kloter'] = "105";
		$data['tanggal'] = "20 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_45() 
	{
		$data['kloter'] = "106";
		$data['tanggal'] = "23 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_46() 
	{
		$data['kloter'] = "107";
		$data['tanggal'] = "25 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_47() 
	{
		$data['kloter'] = "108";
		$data['tanggal'] = "27 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_48() 
	{
		$data['kloter'] = "109";
		$data['tanggal'] = "30 Januari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_49() 
	{
		$data['kloter'] = "110";
		$data['tanggal'] = "01 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	
	public function charter1_50() 
	{
		$data['kloter'] = "111";
		$data['tanggal'] = "03 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_51() 
	{
		$data['kloter'] = "112";
		$data['tanggal'] = "06 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_52() 
	{
		$data['kloter'] = "113";
		$data['tanggal'] = "08 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_53() 
	{
		$data['kloter'] = "114";
		$data['tanggal'] = "10 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_54() 
	{
		$data['kloter'] = "115";
		$data['tanggal'] = "13 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_55() 
	{
		$data['kloter'] = "116";
		$data['tanggal'] = "15 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_56() 
	{
		$data['kloter'] = "117";
		$data['tanggal'] = "17 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_57() 
	{
		$data['kloter'] = "118";
		$data['tanggal'] = "20 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_58() 
	{
		$data['kloter'] = "119";
		$data['tanggal'] = "22 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_59() 
	{
		$data['kloter'] = "120";
		$data['tanggal'] = "24 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_60() 
	{
		$data['kloter'] = "121";
		$data['tanggal'] = "27 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_61() 
	{
		$data['kloter'] = "122";
		$data['tanggal'] = "29 Februari 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_62() 
	{
		$data['kloter'] = "123";
		$data['tanggal'] = "02 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_63() 
	{
		$data['kloter'] = "124";
		$data['tanggal'] = "05 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_64() 
	{
		$data['kloter'] = "125";
		$data['tanggal'] = "07 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_65() 
	{
		$data['kloter'] = "126";
		$data['tanggal'] = "09 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_66() 
	{
		$data['kloter'] = "127";
		$data['tanggal'] = "12 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_67() 
	{
		$data['kloter'] = "128";
		$data['tanggal'] = "14 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_68() 
	{
		$data['kloter'] = "129";
		$data['tanggal'] = "16 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_69() 
	{
		$data['kloter'] = "130";
		$data['tanggal'] = "19 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_70() 
	{
		$data['kloter'] = "131";
		$data['tanggal'] = "21 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_71() 
	{
		$data['kloter'] = "160";
		$data['tanggal'] = "23 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_72() 
	{
		$data['kloter'] = "161";
		$data['tanggal'] = "26 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_73() 
	{
		$data['kloter'] = "132";
		$data['tanggal'] = "28 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_74() 
	{
		$data['kloter'] = "133";
		$data['tanggal'] = "30 Maret 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_75() 
	{
		$data['kloter'] = "134";
		$data['tanggal'] = "02 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_76() 
	{
		$data['kloter'] = "135";
		$data['tanggal'] = " 04 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_77() 
	{
		$data['kloter'] = "136";
		$data['tanggal'] = " 06 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_78() 
	{
		$data['kloter'] = "137";
		$data['tanggal'] = " 09 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_79() 
	{
		$data['kloter'] = "138";
		$data['tanggal'] = " 11 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_80() 
	{
		$data['kloter'] = "139";
		$data['tanggal'] = " 13 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_81() 
	{
		$data['kloter'] = "140";
		$data['tanggal'] = " 16 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_82() 
	{
		$data['kloter'] = "141";
		$data['tanggal'] = " 18 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_83() 
	{
		$data['kloter'] = "142";
		$data['tanggal'] = " 20 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_84() 
	{
		$data['kloter'] = "143";
		$data['tanggal'] = " 23 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_85() 
	{
		$data['kloter'] = "144";
		$data['tanggal'] = " 25 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_86() 
	{
		$data['kloter'] = "145";
		$data['tanggal'] = " 27 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_87() 
	{
		$data['kloter'] = "146";
		$data['tanggal'] = " 30 April 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}

	public function charter1_88() 
	{
		$data['kloter'] = "147";
		$data['tanggal'] = "02 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_89() 
	{
		$data['kloter'] = "148";
		$data['tanggal'] = "04 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_90() 
	{
		$data['kloter'] = "149";
		$data['tanggal'] = "07 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_91() 
	{
		$data['kloter'] = "150";
		$data['tanggal'] = "09 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_92() 
	{
		$data['kloter'] = "151";
		$data['tanggal'] = "11 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_93() 
	{
		$data['kloter'] = "152";
		$data['tanggal'] = "14 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_94() 
	{
		$data['kloter'] = "153";
		$data['tanggal'] = "16 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_95() 
	{
		$data['kloter'] = "154";
		$data['tanggal'] = "18 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_96() 
	{
		$data['kloter'] = "155";
		$data['tanggal'] = "21 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_97() 
	{
		$data['kloter'] = "156";
		$data['tanggal'] = "23 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_98() 
	{
		$data['kloter'] = "157";
		$data['tanggal'] = "25 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_99() 
	{
		$data['kloter'] = "158";
		$data['tanggal'] = "28 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
	}
	public function charter1_100() 
	{
		$data['kloter'] = "159";
		$data['tanggal'] = "30 Mei 2016";
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2',$data);
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
		$this->load->view('charter/dashboard',$data);
		$this->load->view('charter/1/view1_tambah');
	}

	public function charter1_1_tambah1()
	{		
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'id_pemesanan' => $this->input->post('id_pemesanan'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_kloter' => $this->input->post('id_kloter'),
			'jumlah' => $this->input->post('jumlah'),
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('keterangan')
			);
		$this->charter_model->charter1_1_tambah($data);


		if ($this->input->post('id_kloter')==62) {
			$data['kloter'] = "62";
			$data['tanggal'] = "3 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==63){ 
			$data['kloter'] = "63";
			$data['tanggal'] = "10 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==64){ 
			$data['kloter'] = "64";
			$data['tanggal'] = "17 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==65){ 
			$data['kloter'] = "65";
			$data['tanggal'] = "24 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==66){ 
			$data['kloter'] = "66";
			$data['tanggal'] = "31 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==67){ 
			$data['kloter'] = "67";
			$data['tanggal'] = "07 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==68){ 
			$data['kloter'] = "68";
			$data['tanggal'] = "14 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==69){ 
			$data['kloter'] = "69";
			$data['tanggal'] = "21 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==70){ 
			$data['kloter'] = "70";
			$data['tanggal'] = "28 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==71){ 
			$data['kloter'] = "71";
			$data['tanggal'] = "04 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==72){ 
			$data['kloter'] = "72";
			$data['tanggal'] = "11 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==73){ 
			$data['kloter'] = "73";
			$data['tanggal'] = "18 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==74){ 
			$data['kloter'] = "74";
			$data['tanggal'] = "25 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==75){ 
			$data['kloter'] = "75";
			$data['tanggal'] = "03 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==76){ 
			$data['kloter'] = "76";
			$data['tanggal'] = "10 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==77){ 
			$data['kloter'] = "77";
			$data['tanggal'] = "17 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==78){ 
			$data['kloter'] = "78";
			$data['tanggal'] = "24 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==79){ 
			$data['kloter'] = "79";
			$data['tanggal'] = "31 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==80){ 
			$data['kloter'] = "80";
			$data['tanggal'] = "07 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==81){ 
			$data['kloter'] = "81";
			$data['tanggal'] = "14 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==82){ 
			$data['kloter'] = "82";
			$data['tanggal'] = "21 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==83){ 
			$data['kloter'] = "83";
			$data['tanggal'] = "28 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==84){ 
			$data['kloter'] = "84";
			$data['tanggal'] = "05 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==85){ 
			$data['kloter'] = "85";
			$data['tanggal'] = "12 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==86){ 
			$data['kloter'] = "86";
			$data['tanggal'] = "19 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==87){ 
			$data['kloter'] = "87";
			$data['tanggal'] = "26 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==88){ 
			$data['kloter'] = "88";
			$data['tanggal'] = "02 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==89){ 
			$data['kloter'] = "89";
			$data['tanggal'] = "07 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==90){ 
			$data['kloter'] = "90";
			$data['tanggal'] = "09 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==91){ 
			$data['kloter'] = "91";
			$data['tanggal'] = "14 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==92){ 
			$data['kloter'] = "92";
			$data['tanggal'] = "16 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==93){ 
			$data['kloter'] = "93";
			$data['tanggal'] = "21 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==94){ 
			$data['kloter'] = "94";
			$data['tanggal'] = "23 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==95){ 
			$data['kloter'] = "95";
			$data['tanggal'] = "28 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==96){ 
			$data['kloter'] = "96";
			$data['tanggal'] = "30 Desember 2015";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==97){ 
			$data['kloter'] = "97";
			$data['tanggal'] = "02 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==98){ 
			$data['kloter'] = "98";
			$data['tanggal'] = "04 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==99){ 
			$data['kloter'] = "99";
			$data['tanggal'] = "06 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==100){ 
			$data['kloter'] = "100";
			$data['tanggal'] = "09 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==101){ 
			$data['kloter'] = "101";
			$data['tanggal'] = "11 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==102){ 
			$data['kloter'] = "102";
			$data['tanggal'] = "13 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==103){ 
			$data['kloter'] = "103";
			$data['tanggal'] = "16 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==104){ 
			$data['kloter'] = "104";
			$data['tanggal'] = "18 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==105){ 
			$data['kloter'] = "105";
			$data['tanggal'] = "20 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==106){ 
			$data['kloter'] = "106";
			$data['tanggal'] = "23 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==107){ 
			$data['kloter'] = "107";
			$data['tanggal'] = "25 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==108){ 
			$data['kloter'] = "108";
			$data['tanggal'] = "27 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==109){ 
			$data['kloter'] = "109";
			$data['tanggal'] = "30 Januari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}

		elseif ($this->input->post('id_kloter')==110){ 
			$data['kloter'] = "110";
			$data['tanggal'] = "01 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==111){ 
			$data['kloter'] = "111";
			$data['tanggal'] = "03 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==112){ 
			$data['kloter'] = "112";
			$data['tanggal'] = "06 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==113){ 
			$data['kloter'] = "113";
			$data['tanggal'] = "08 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==114){ 
			$data['kloter'] = "114";
			$data['tanggal'] = "10 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==115){ 
			$data['kloter'] = "115";
			$data['tanggal'] = "13 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==116){ 
			$data['kloter'] = "116";
			$data['tanggal'] = "15 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==117){ 
			$data['kloter'] = "117";
			$data['tanggal'] = "17 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==118){ 
			$data['kloter'] = "118";
			$data['tanggal'] = "20 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==119){ 
			$data['kloter'] = "119";
			$data['tanggal'] = "22 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==120){ 
			$data['kloter'] = "120";
			$data['tanggal'] = "24 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==121){ 
			$data['kloter'] = "121";
			$data['tanggal'] = "27 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==122){ 
			$data['kloter'] = "122";
			$data['tanggal'] = "29 Februari 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		
		elseif ($this->input->post('id_kloter')==123){ 
			$data['kloter'] = "123";
			$data['tanggal'] = "02 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==124){ 
			$data['kloter'] = "124";
			$data['tanggal'] = "05 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==125){ 
			$data['kloter'] = "125";
			$data['tanggal'] = "07 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==126){ 
			$data['kloter'] = "126";
			$data['tanggal'] = "09 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==127){ 
			$data['kloter'] = "127";
			$data['tanggal'] = "12 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==128){ 
			$data['kloter'] = "128";
			$data['tanggal'] = "14 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==129){ 
			$data['kloter'] = "129";
			$data['tanggal'] = "16 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==130){ 
			$data['kloter'] = "130";
			$data['tanggal'] = "19 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==131){ 
			$data['kloter'] = "131";
			$data['tanggal'] = "21 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==160){ 
			$data['kloter'] = "160";
			$data['tanggal'] = "23 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==161){ 
			$data['kloter'] = "161";
			$data['tanggal'] = "26 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==132){ 
			$data['kloter'] = "132";
			$data['tanggal'] = "28 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==133){ 
			$data['kloter'] = "133";
			$data['tanggal'] = "30 Maret 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}

		elseif ($this->input->post('id_kloter')==134){ 
			$data['kloter'] = "134";
			$data['tanggal'] = "02 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==135){ 
			$data['kloter'] = "135";
			$data['tanggal'] = "04 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==136){ 
			$data['kloter'] = "136";
			$data['tanggal'] = "06 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==137){ 
			$data['kloter'] = "137";
			$data['tanggal'] = "09 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==138){ 
			$data['kloter'] = "138";
			$data['tanggal'] = "11 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==139){ 
			$data['kloter'] = "139";
			$data['tanggal'] = "13 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==140){ 
			$data['kloter'] = "140";
			$data['tanggal'] = "16 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==141){ 
			$data['kloter'] = "141";
			$data['tanggal'] = "18 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==142){ 
			$data['kloter'] = "142";
			$data['tanggal'] = "20 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==143){ 
			$data['kloter'] = "143";
			$data['tanggal'] = "23 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==144){ 
			$data['kloter'] = "144";
			$data['tanggal'] = "25 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==145){ 
			$data['kloter'] = "145";
			$data['tanggal'] = "27 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==146){ 
			$data['kloter'] = "146";
			$data['tanggal'] = "30 April 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==147){ 
			$data['kloter'] = "147";
			$data['tanggal'] = "02 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==148){ 
			$data['kloter'] = "148";
			$data['tanggal'] = "04 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==149){ 
			$data['kloter'] = "149";
			$data['tanggal'] = "07 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==150){ 
			$data['kloter'] = "150";
			$data['tanggal'] = "09 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==151){ 
			$data['kloter'] = "151";
			$data['tanggal'] = "11 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==152){ 
			$data['kloter'] = "152";
			$data['tanggal'] = "14 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==153){ 
			$data['kloter'] = "153";
			$data['tanggal'] = "16 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==154){ 
			$data['kloter'] = "154";
			$data['tanggal'] = "18 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==155){ 
			$data['kloter'] = "155";
			$data['tanggal'] = "21 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==156){ 
			$data['kloter'] = "156";
			$data['tanggal'] = "23 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==157){ 
			$data['kloter'] = "157";
			$data['tanggal'] = "25 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==158){ 
			$data['kloter'] = "158";
			$data['tanggal'] = "28 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}
		elseif ($this->input->post('id_kloter')==159){ 
			$data['kloter'] = "159";
			$data['tanggal'] = "30 Mei 2016";
			$this->load->view('charter/dashboard1');
			$this->load->view('charter/1/view2',$data);
		}


	}
	

	//kloter 2 tripuri tambah
	public function charter1_2_tambah()
	{
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view1_tambah');
	}

	public function charter1_2_tambah1()
	{		
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'id_pemesanan' => $this->input->post('id_pemesanan'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_kloter' => $this->input->post('id_kloter'),
			'jumlah' => $this->input->post('jumlah')
			);
		$this->Usermodel->charter1_1_tambah($data);

		$this->load->view('charter/dashboard1');
		$this->load->view('charter/1/view2');
	}

	public function charter2_1_tambah()
	{
		$this->load->view('charter/dashboard1');
		$this->load->view('charter/2/view1_tambah');
	}

	public function charter2_1_tambah1()
	{		
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'id_pemesanan' => $this->input->post('id_pemesanan'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_kloter' => $this->input->post('id_kloter'),
			'jumlah' => $this->input->post('jumlah')
			);
		$this->Usermodel->charter1_1_tambah($data);

		$this->load->view('charter/dashboard1');
		$this->load->view('charter/2/view1');
	}

	public function view_2()
	{
		$this->load->view('charter/dashboard');
		$this->load->view('charter/view_kano');
	}

}