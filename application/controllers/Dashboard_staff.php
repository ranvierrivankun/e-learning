<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_staff extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login_staff();
	}

	/*View Dashboard Staff*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Dashboad Staff '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/dashboard/index');
		$this->load->view('template_staff/footer');
	}

	/*Modal Ganti Password*/
	public function modal_ganti_password_staff()
	{
		$id_staff 				= $this->input->post('id_staff');
		$ganti_password 		= $this->bd->edit('data_staff', 'id_staff', $id_staff)->row();

		$data['ganti_password'] 	= $ganti_password;
		$this->load->view('staff/dashboard/modal_ganti_password_staff', $data, FALSE);
	}

	/*Proses Ganti Password*/
	public function proses_ganti_password_staff()
	{
		$id_staff 					= staffdata('id_staff');
		$password_lama 				= $this->input->post('password_lama');
		$password_baru_1 			= $this->input->post('password_baru_1');

		$cek_password_lama 			= $this->bd->where('data_staff', 'id_staff', $id_staff)->row();

		if (password_verify($password_lama, $cek_password_lama->password)) {
			$data['password'] 		= password_hash($password_baru_1, PASSWORD_DEFAULT);
			$this->bd->update('data_staff', $data, 'id_staff', $id_staff);

			$output['status'] 		= true;
			$output['keterangan'] 	= "Password Berhasil diganti!";
			$this->session->unset_userdata('staff_login_session');

		} else {
			$output['status'] 		= false;
			$output['keterangan'] 	= "Password Lama Salah";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}