<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	/*Cek Session Login*/
	private function _has_login()
	{
		if ($this->session->has_userdata('login_session')) {
			redirect('dashboard');
		}
	}

	public function index()
	{
		$this->_has_login();

		$this->form_validation->set_rules('nisn', 'NISN', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		/*Ambil Data dari Form @View*/
		$nisn 		= $this->input->post('nisn');
		$getSiswa 	= $this->db->get_where('data_siswa', ['nisn' => $nisn])->row_array();

		if ($this->form_validation->run() == false) {
			/*Title*/
			$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
			$data['title']			= 'E-Learning '.$pengaturan->nama_sekolah;
			$data['nama_sekolah']	= $pengaturan->nama_sekolah;

			$this->load->view('auth/index', $data);

		} else {
			$input = $this->input->post(null, true);

			$cek_nisn = $this->auth->cek_nisn($input['nisn']);
			if ($cek_nisn > 0) {
				$password = $this->auth->get_password($input['nisn']);
				if($getSiswa['status_siswa'] == aktif){
					if (password_verify($input['password'], $password)) {
						$user_db = $this->auth->userdata($input['nisn']);
						$userdata = [
							'user'  => $user_db['id_siswa'],
							'nama'  => $user_db['nama_siswa'],
							'timestamp' => time()
						];
						$this->session->set_userdata('login_session', $userdata);
						redirect('dashboard');
					}
				} else {
					set_pesan('Akun Siswa Non-Aktif', false);
					redirect('auth');
				}
			} else {
				set_pesan('NISN Tidak Terdaftar', false);
				redirect('auth');
			}
			set_pesan('Password Salah', false);
			redirect('auth');
		}
	}

	/*Keluar Sistem*/
	public function logout()
	{
		$this->session->unset_userdata('login_session');
		set_pesan('Berhasil Keluar');
		redirect('auth');
	}

}
