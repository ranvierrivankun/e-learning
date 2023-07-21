<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_staff extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_staff_model', 'data_staff');
		cek_login_staff();
		admin();
	}

	/*View Data Staff*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Data Staff '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_staff/index');
		$this->load->view('staff/data_staff/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Data Staff*/
	public function table_data_staff()
	{
		$table 	= $this->data_staff->table_data_staff();
		$filter = $this->data_staff->filter_table_data_staff();
		$total 	= $this->data_staff->total_table_data_staff();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_staff='$tb->id_staff'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_staff)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nama_role;
			$td[] = $tb->nik;
			$td[] = $tb->nama_staff;
			$td[] = $tb->jk_staff;
			$td[] = $tb->notelp_staff;
			$td[] = $tb->email_staff;

			$ifelse="";
			if ($tb->status_staff === 'aktif') {
				$td[] = "<span class='badge border border-success text-success mt-2'>Aktif</span>";
			} else if ($tb->status_staff === 'nonaktif') {
				$td[] = "<span class='badge border border-danger text-danger mt-2'>Nonaktif</span>";
			} 

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->post('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data'=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Tambah Data Staff*/
	public function modal_tambah_data_staff()
	{
		$this->load->view('staff/data_staff/modal_tambah_data_staff', FALSE);
	}

	/*Proses Tambah Data Staff*/
	public function proses_tambah_data_staff()
	{
		$role 			= $this->input->post('role');
		$nik 			= $this->input->post('nik');
		$password 		= $this->input->post('password');
		$status_staff 	= $this->input->post('status_staff');
		$nama_staff 	= $this->input->post('nama_staff');
		$jk_staff 		= $this->input->post('jk_staff');
		$notelp_staff 	= $this->input->post('notelp_staff');
		$email_staff 	= $this->input->post('email_staff');
		$foto 			= 'staff.jpg';

		$proses 		= $this->bd->edit('data_staff', 'nik', $nik)->num_rows();
		$proses2 		= $this->bd->edit('data_staff', 'email_staff', $email_staff)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NIK ".$nik." Sudah terdaftar";

		} else if($proses2 > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Email ".$email_staff." Sudah terdaftar";

		} else {

			$data['role']			= $role;
			$data['nik']			= $nik;
			$data['password']		= password_hash($password, PASSWORD_DEFAULT);
			$data['status_staff']	= $status_staff;
			$data['nama_staff']		= $nama_staff;
			$data['jk_staff']		= $jk_staff;
			$data['notelp_staff']	= $notelp_staff;
			$data['email_staff']	= $email_staff;
			$data['foto']			= $foto;

			$save = $this->bd->save('data_staff', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Edit Data Staff*/
	public function modal_edit_data_staff()
	{
		$id_staff 		= $this->input->post('id_staff');
		$edit 			= $this->db->select('*')->from('data_staff')->where('id_staff', $id_staff)->join('data_role','id_role=role')->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('staff/data_staff/modal_edit_data_staff', $data, FALSE);
	}

	/*Proses Edit Data Staff*/
	public function proses_edit_data_staff()
	{
		$id_staff 		= $this->input->post('id_staff');

		$role 			= $this->input->post('role');
		$nik 			= $this->input->post('nik');
		$password 		= $this->input->post('password');
		$status_staff 	= $this->input->post('status_staff');
		$nama_staff 	= $this->input->post('nama_staff');
		$jk_staff 		= $this->input->post('jk_staff');
		$notelp_staff 	= $this->input->post('notelp_staff');
		$email_staff 	= $this->input->post('email_staff');

		$proses 		= $this->bd->edit('data_staff', 'nik', $nik)->num_rows();
		$proses2 		= $this->bd->edit('data_staff', 'email_staff', $email_staff)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NIK ".$nik." Sudah terdaftar";

		} else if($proses2 > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Email ".$email_staff." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_staff', ['id_staff' => $id_staff])->row_array();

			if($nik == null) {
				$nik_edit = $query['nik'];
			} else {
				$nik_edit =  $this->input->post('nik');
			}

			if($email_staff == null) {
				$email_staff_edit = $query['email_staff'];
			} else {
				$email_staff_edit =  $this->input->post('email_staff');
			}

			if($password == null) {
				$password_edit = $query['password'];
			} else {
				$password_edit =  password_hash($password, PASSWORD_DEFAULT);
			}

			$data['role']			= $role;
			$data['nik']			= $nik_edit;
			$data['password']		= $password_edit;
			$data['status_staff']	= $status_staff;
			$data['nama_staff']		= $nama_staff;
			$data['jk_staff']		= $jk_staff;
			$data['notelp_staff']	= $notelp_staff;
			$data['email_staff']	= $email_staff_edit;

			$update = $this->bd->update('data_staff', $data, 'id_staff', $id_staff);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Delete Data Staff*/
	public function delete_data_staff()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_staff 	= $this->input->post('id',true);
			$hapus 			= $this->bd->delete('data_staff','id_staff', $id_staff);

			if($hapus){
				$msg = [ 'sukses' => 'Data Staff Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}