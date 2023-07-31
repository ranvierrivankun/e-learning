<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_mapel_model', 'data_mata_pelajaran');
		cek_login_staff();
		admin_staff();
	}

	/*View Data Mata Pelajaran*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Data Mata Pelajaran '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_mapel/index');
		$this->load->view('staff/data_mapel/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Data Mapel*/
	public function table_data_mapel()
	{
		$table 	= $this->data_mata_pelajaran->table_data_mapel();
		$filter = $this->data_mata_pelajaran->filter_table_data_mapel();
		$total 	= $this->data_mata_pelajaran->total_table_data_mapel();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_mapel='$tb->id_mapel'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_mapel)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit</a></center>";
			$td[] = $tb->nama_mapel;

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

	/*Modal Tambah Data Mapel*/
	public function modal_tambah_data_mapel()
	{
		$this->load->view('staff/data_mapel/modal_tambah_data_mapel', FALSE);
	}

	/*Proses Tambah Data Mapel*/
	public function proses_tambah_data_mapel()
	{
		$nama_mapel 	= $this->input->post('nama_mapel');

		$proses 		= $this->bd->edit('data_mapel', 'nama_mapel', $nama_mapel)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Mata Pelajaran ".$nama_mapel." Sudah terdaftar";

		} else {

			$data['nama_mapel']	= $nama_mapel;

			$save = $this->bd->save('data_mapel', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Edit Data Mapel*/
	public function modal_edit_data_mapel()
	{
		$id_mapel 	= $this->input->post('id_mapel');
		$edit 			= $this->db->select('*')->from('data_mapel')->where('id_mapel', $id_mapel)->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('staff/data_mapel/modal_edit_data_mapel', $data, FALSE);
	}

	/*Proses Edit Data Mapel*/
	public function proses_edit_data_mapel()
	{
		$id_mapel 		= $this->input->post('id_mapel');

		$nama_mapel 		= $this->input->post('nama_mapel');

		$proses 				= $this->bd->edit('data_mapel', 'nama_mapel', $nama_mapel)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Kejuruan ".$nama_mapel." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_mapel', ['id_mapel' => $id_mapel])->row_array();

			if($nama_mapel == null) {
				$nama_mapel_edit = $query['nama_mapel'];
			} else {
				$nama_mapel_edit =  $this->input->post('nama_mapel');
			}

			$data['nama_mapel']	= $nama_mapel_edit;

			$update = $this->bd->update('data_mapel', $data, 'id_mapel', $id_mapel);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Delete Data Mapel*/
	public function delete_data_mapel()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_mapel 	= $this->input->post('id',true);
			$hapus 			= $this->bd->delete('data_mapel','id_mapel', $id_mapel);

			if($hapus){
				$msg = [ 'sukses' => 'Data Mata Pelajaran Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}