<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login_siswa();
	}

	/*View Dashboard*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Dashboad '.$pengaturan->nama_sekolah;

		$this->load->view('template_siswa/header', $data);
		$this->load->view('template_siswa/navbar');
		$this->load->view('template_siswa/sidebar');
		$this->load->view('siswa/dashboard/index');
		$this->load->view('template_siswa/footer');
	}

	/*Modal Ganti Password*/
	public function modal_ganti_password()
	{
		$id_siswa 				= $this->input->post('id_siswa');
		$ganti_password 		= $this->bd->edit('data_siswa', 'id_siswa', $id_siswa)->row();

		$data['ganti_password'] 	= $ganti_password;
		$this->load->view('siswa/dashboard/modal_ganti_password', $data, FALSE);
	}

	/*Proses Ganti Password*/
	public function proses_ganti_password()
	{
		$id_siswa 					= userdata('id_siswa');
		$password_lama 				= $this->input->post('password_lama');
		$password_baru_1 			= $this->input->post('password_baru_1');

		$cek_password_lama 			= $this->bd->where('data_siswa', 'id_siswa', $id_siswa)->row();

		if (password_verify($password_lama, $cek_password_lama->password)) {
			$data['password'] 		= password_hash($password_baru_1, PASSWORD_DEFAULT);
			$this->bd->update('data_siswa', $data, 'id_siswa', $id_siswa);

			$output['status'] 		= true;
			$output['keterangan'] 	= "Password Berhasil diganti!";
			$this->session->unset_userdata('login_session');

		} else {
			$output['status'] 		= false;
			$output['keterangan'] 	= "Password Lama Salah";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}