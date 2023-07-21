<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_staff extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_staff_model', 'auth');
	}

	/*Cek Session Login*/
	private function _has_login()
	{
		if ($this->session->has_userdata('staff_login_session')) {
			redirect('dashboard_staff');
		}
	}

	public function index()
	{
		$this->_has_login();

		$this->form_validation->set_rules('nik', 'NIK', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		/*Ambil Data dari Form @View*/
		$nik 		= $this->input->post('nik');
		$getStaff 	= $this->db->get_where('data_staff', ['nik' => $nik])->row_array();

		if ($this->form_validation->run() == false) {
			/*Title*/
			$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
			$data['title']			= 'E-Learning '.$pengaturan->nama_sekolah;
			$data['nama_sekolah']	= $pengaturan->nama_sekolah;

			$this->load->view('auth_staff/index', $data);

		} else {
			$input = $this->input->post(null, true);

			$cek_nik = $this->auth->cek_nik($input['nik']);
			if ($cek_nik > 0) {
				$password = $this->auth->get_password($input['nik']);
				if($getStaff['status_staff'] == aktif){
					if (password_verify($input['password'], $password)) {
						$user_db = $this->auth->userdata($input['nik']);
						$userdata = [
							'user'  => $user_db['id_staff'],
							'nama'  => $user_db['nama_staff'],
							'role'  => $user_db['role'],
							'timestamp' => time()
						];
						$this->session->set_userdata('staff_login_session', $userdata);
						redirect('dashboard_staff');
					}
				} else {
					set_pesan('Akun Staff Non-Aktif', false);
					redirect('auth_staff');
				}
			} else {
				set_pesan('NIK Tidak Terdaftar', false);
				redirect('auth_staff');
			}
			set_pesan('Password Salah', false);
			redirect('auth_staff');
		}
	}

	/*Keluar Sistem*/
	public function logout()
	{
		$this->session->unset_userdata('staff_login_session');
		set_pesan('Berhasil Keluar');
		redirect('auth_staff');
	}

}
