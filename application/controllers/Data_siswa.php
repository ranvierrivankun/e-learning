<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_siswa_model', 'data_siswa');
		cek_login_staff();
		admin_staff();
	}

	/*View Data Siswa*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Data Siswa '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_siswa/index');
		$this->load->view('staff/data_siswa/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Data Siswa*/
	public function table_data_siswa()
	{
		$table 	= $this->data_siswa->table_data_siswa();
		$filter = $this->data_siswa->filter_table_data_siswa();
		$total 	= $this->data_siswa->total_table_data_siswa();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_siswa='$tb->id_siswa'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_siswa)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nisn;
			$td[] = $tb->nama_siswa;
			$td[] = $tb->nama_kelas.' - '.$tb->nama_kejuruan;
			$td[] = $tb->jk_siswa;
			$td[] = $tb->notelp_siswa;
			$td[] = $tb->email_siswa;

			$ifelse="";
			if ($tb->status_siswa === 'aktif') {
				$td[] = "<span class='badge border border-success text-success mt-2'>Aktif</span>";
			} else if ($tb->status_siswa === 'nonaktif') {
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

	/*Modal Tambah Data Siswa*/
	public function modal_tambah_data_siswa()
	{
		$this->load->view('staff/data_siswa/modal_tambah_data_siswa', FALSE);
	}

	/*Proses Tambah Data Siswa*/
	public function proses_tambah_data_siswa()
	{
		$kelas 			= $this->input->post('kelas');
		$nisn 			= $this->input->post('nisn');
		$password 		= $this->input->post('password');
		$status_siswa 	= $this->input->post('status_siswa');
		$nama_siswa 	= $this->input->post('nama_siswa');
		$jk_siswa 		= $this->input->post('jk_siswa');
		$notelp_siswa 	= $this->input->post('notelp_siswa');
		$email_siswa 	= $this->input->post('email_siswa');
		$foto 			= 'siswa.jpg';

		$proses 		= $this->bd->edit('data_siswa', 'nisn', $nisn)->num_rows();
		$proses2 		= $this->bd->edit('data_siswa', 'email_siswa', $email_siswa)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NISN ".$nisn." Sudah terdaftar";

		} else if($proses2 > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Email ".$email_siswa." Sudah terdaftar";

		} else {

			$data['kelas']			= $kelas;
			$data['nisn']			= $nisn;
			$data['password']		= password_hash($password, PASSWORD_DEFAULT);
			$data['status_siswa']	= $status_siswa;
			$data['nama_siswa']		= $nama_siswa;
			$data['jk_siswa']		= $jk_siswa;
			$data['notelp_siswa']	= $notelp_siswa;
			$data['email_siswa']	= $email_siswa;
			$data['foto']			= $foto;

			$save = $this->bd->save('data_siswa', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Edit Data Siswa*/
	public function modal_edit_data_siswa()
	{
		$id_siswa 		= $this->input->post('id_siswa');
		$edit 			= $this->db->select('*')->from('data_siswa')->where('id_siswa', $id_siswa)->join('data_kelas','id_kelas=kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('staff/data_siswa/modal_edit_data_siswa', $data, FALSE);
	}

	/*Proses Edit Data Siswa*/
	public function proses_edit_data_siswa()
	{
		$id_siswa 		= $this->input->post('id_siswa');

		$kelas 			= $this->input->post('kelas');
		$nisn 			= $this->input->post('nisn');
		$password 		= $this->input->post('password');
		$status_siswa 	= $this->input->post('status_siswa');
		$nama_siswa 	= $this->input->post('nama_siswa');
		$jk_siswa 		= $this->input->post('jk_siswa');
		$notelp_siswa 	= $this->input->post('notelp_siswa');
		$email_siswa 	= $this->input->post('email_siswa');

		$proses 		= $this->bd->edit('data_siswa', 'nisn', $nisn)->num_rows();
		$proses2 		= $this->bd->edit('data_siswa', 'email_siswa', $email_siswa)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NIK ".$nisn." Sudah terdaftar";

		} else if($proses2 > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Email ".$email_siswa." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_siswa', ['id_siswa' => $id_siswa])->row_array();

			if($nisn == null) {
				$nisn_edit = $query['nisn'];
			} else {
				$nisn_edit =  $this->input->post('nisn');
			}

			if($email_siswa == null) {
				$email_siswa_edit = $query['email_siswa'];
			} else {
				$email_siswa_edit =  $this->input->post('email_siswa');
			}

			if($password == null) {
				$password_edit = $query['password'];
			} else {
				$password_edit =  password_hash($password, PASSWORD_DEFAULT);
			}

			$data['kelas']			= $kelas;
			$data['nisn']			= $nisn_edit;
			$data['password']		= $password_edit;
			$data['status_siswa']	= $status_siswa;
			$data['nama_siswa']		= $nama_siswa;
			$data['jk_siswa']		= $jk_siswa;
			$data['notelp_siswa']	= $notelp_siswa;
			$data['email_siswa']	= $email_siswa_edit;

			$update = $this->bd->update('data_siswa', $data, 'id_siswa', $id_siswa);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Delete Data Siswa*/
	public function delete_data_siswa()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_siswa 	= $this->input->post('id',true);
			$hapus 			= $this->bd->delete('data_siswa','id_siswa', $id_siswa);

			if($hapus){
				$msg = [ 'sukses' => 'Data Siswa Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}