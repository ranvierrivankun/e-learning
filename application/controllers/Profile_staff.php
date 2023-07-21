<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_staff extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login_staff();
	}

	/*View Profile Staff*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$id_staff				= staffdata('id_staff');
		$getDataStaff			= $this->db->select('*')->from('data_staff')->where('id_staff', $id_staff)->join('data_role','id_role=role')->get()->row();
		$data['getDataStaff'] 	= $getDataStaff;
		$data['title']			= 'Profile '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/profile/index');
		$this->load->view('template_staff/footer');
	}

	/*Proses Edit Profile*/
	public function proses_edit_profile()
	{
		$id_staff 				= $this->input->post('id_staff');

		$notelp_staff 			= $this->input->post('notelp_staff');
		$email_staff 			= $this->input->post('email_staff');
		$motto_staff 			= $this->input->post('motto_staff');

		$proses 				= $this->bd->edit('data_staff', 'email_staff', $email_staff)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! ".$email_staff." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_staff', ['id_staff' => $id_staff])->row_array();

			if($email_staff == null) {
				$email_staff_edit 	= $query['email_staff'];
			} else {
				$email_staff_edit 	= $email_staff;
			}

			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']     = '5048';
				$config['upload_path'] = './file/foto';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$old_image = $query['foto'];
					if ($old_image != 'staff.jpg') {
						unlink(FCPATH . 'file/foto/' . $old_image);
					}

					$new_image 		= $this->upload->data('file_name');
					$data['foto']	= $new_image;
				} else {
					set_pesan('Gagal ganti Foto', false);
					echo json_encode(array("status" => FALSE));
				}
			}

			$data['email_staff']			= $email_staff_edit;
			$data['notelp_staff']			= $notelp_staff;
			$data['motto_staff']			= $motto_staff;

			$this->db->where('id_staff', $id_staff);
			$update = $this->db->update('data_staff', $data);

			$output['status'] 	= true;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}