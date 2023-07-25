<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login_siswa();
	}

	/*View Profile Staff*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$id_siswa				= userdata('id_siswa');
		$getDataSiswa			= $this->db->select('*')->from('data_siswa')->where('id_siswa', $id_siswa)->join('data_kelas','id_kelas=kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
		$data['getDataSiswa'] 	= $getDataSiswa;
		$data['title']			= 'Profile '.$pengaturan->nama_sekolah;

		$this->load->view('template_siswa/header', $data);
		$this->load->view('template_siswa/navbar');
		$this->load->view('template_siswa/sidebar');
		$this->load->view('siswa/profile/index');
		$this->load->view('template_siswa/footer');
	}

	/*Proses Edit Profile*/
	public function proses_edit_profile()
	{
		$id_siswa 				= $this->input->post('id_siswa');

		$notelp_siswa 			= $this->input->post('notelp_siswa');
		$email_siswa 			= $this->input->post('email_siswa');
		$motto_siswa 			= $this->input->post('motto_siswa');

		$proses 				= $this->bd->edit('data_siswa', 'email_siswa', $email_siswa)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! ".$email_siswa." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_siswa', ['id_siswa' => $id_siswa])->row_array();

			if($email_siswa == null) {
				$email_siswa_edit 	= $query['email_siswa'];
			} else {
				$email_siswa_edit 	= $email_siswa;
			}

			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']     = '5048';
				$config['upload_path'] = './file/foto';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$old_image = $query['foto'];
					if ($old_image != 'siswa.jpg') {
						unlink(FCPATH . 'file/foto/' . $old_image);
					}

					$new_image 		= $this->upload->data('file_name');
					$data['foto']	= $new_image;
				} else {
					set_pesan('Gagal ganti Foto', false);
					echo json_encode(array("status" => FALSE));
				}
			}

			$data['email_siswa']			= $email_siswa_edit;
			$data['notelp_siswa']			= $notelp_siswa;
			$data['motto_siswa']			= $motto_siswa;

			$this->db->where('id_siswa', $id_siswa);
			$update = $this->db->update('data_siswa', $data);

			$output['status'] 	= true;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}