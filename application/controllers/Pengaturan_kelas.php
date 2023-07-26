<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_kelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Pengaturan_kelas_model', 'pengaturan_kelas');
		cek_login_staff();
		admin();
	}

	/*View Pengaturan Kelas*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Pengaturan Kelas '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/pengaturan_kelas/index');
		$this->load->view('staff/pengaturan_kelas/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Data Kejuruan*/
	public function table_data_kejuruan()
	{
		$table 	= $this->pengaturan_kelas->table_data_kejuruan();
		$filter = $this->pengaturan_kelas->filter_table_data_kejuruan();
		$total 	= $this->pengaturan_kelas->total_table_data_kejuruan();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_kejuruan='$tb->id_kejuruan'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_kejuruan)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nama_kejuruan;

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

	/*Table Data Kelas*/
	public function table_data_kelas()
	{
		$table 	= $this->pengaturan_kelas->table_data_kelas();
		$filter = $this->pengaturan_kelas->filter_table_data_kelas();
		$total 	= $this->pengaturan_kelas->total_table_data_kelas();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_kelas='$tb->id_kelas'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data2($tb->id_kelas)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nama_kelas;
			$td[] = $tb->nama_kejuruan;

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

	/*Modal Tambah Data Kejuruan*/
	public function modal_tambah_data_kejuruan()
	{
		$this->load->view('staff/pengaturan_kelas/modal_tambah_data_kejuruan', FALSE);
	}

	/*Proses Tambah Data Kejuruan*/
	public function proses_tambah_data_kejuruan()
	{
		$nama_kejuruan 	= $this->input->post('nama_kejuruan');

		$proses 		= $this->bd->edit('data_kejuruan', 'nama_kejuruan', $nama_kejuruan)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Kejuruan ".$nama_kejuruan." Sudah terdaftar";

		} else {

			$data['nama_kejuruan']	= $nama_kejuruan;

			$save = $this->bd->save('data_kejuruan', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Edit Data Kejuruan*/
	public function modal_edit_data_kejuruan()
	{
		$id_kejuruan 	= $this->input->post('id_kejuruan');
		$edit 			= $this->db->select('*')->from('data_kejuruan')->where('id_kejuruan', $id_kejuruan)->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('staff/pengaturan_kelas/modal_edit_data_kejuruan', $data, FALSE);
	}

	/*Proses Edit Data Kejuruan*/
	public function proses_edit_data_kejuruan()
	{
		$id_kejuruan 		= $this->input->post('id_kejuruan');

		$nama_kejuruan 		= $this->input->post('nama_kejuruan');

		$proses 				= $this->bd->edit('data_kejuruan', 'nama_kejuruan', $nama_kejuruan)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Kejuruan ".$nama_kejuruan." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_kejuruan', ['id_kejuruan' => $id_kejuruan])->row_array();

			if($nama_kejuruan == null) {
				$nama_kejuruan_edit = $query['nama_kejuruan'];
			} else {
				$nama_kejuruan_edit =  $this->input->post('nama_kejuruan');
			}

			$data['nama_kejuruan']	= $nama_kejuruan_edit;

			$update = $this->bd->update('data_kejuruan', $data, 'id_kejuruan', $id_kejuruan);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Delete Data Kejuruan*/
	public function delete_data_kejuruan()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_kejuruan 	= $this->input->post('id',true);
			$hapus 			= $this->bd->delete('data_kejuruan','id_kejuruan', $id_kejuruan);
			$hapus 			= $this->bd->delete('data_kelas','kejuruan', $id_kejuruan);

			if($hapus){
				$msg = [ 'sukses' => 'Data Kejuruan Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

/*Modal Tambah Data Kelas*/
public function modal_tambah_data_kelas()
{
	$this->load->view('staff/pengaturan_kelas/modal_tambah_data_kelas', FALSE);
}

/*Proses Tambah Data Kelas*/
public function proses_tambah_data_kelas()
{
	$nama_kelas 	= $this->input->post('nama_kelas');
	$kejuruan 		= $this->input->post('kejuruan');

	$data['kejuruan']	= $kejuruan;
	$data['nama_kelas']	= $nama_kelas;
	

	$save = $this->bd->save('data_kelas', $data);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*Modal Edit Data Kelas*/
public function modal_edit_data_kelas()
{
	$id_kelas 	= $this->input->post('id_kelas');
	$edit 			= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();

	$data['edit'] 	= $edit;
	$this->load->view('staff/pengaturan_kelas/modal_edit_data_kelas', $data, FALSE);
}

/*Proses Edit Data Kelas*/
public function proses_edit_data_kelas()
{
	$id_kelas 		= $this->input->post('id_kelas');

	$nama_kelas 	= $this->input->post('nama_kelas');
	$kejuruan 		= $this->input->post('kejuruan');

	$data['nama_kelas']	= $nama_kelas;
	$data['kejuruan']	= $kejuruan;

	$update = $this->bd->update('data_kelas', $data, 'id_kelas', $id_kelas);

	$output['status'] 	= true;
	
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*Delete Data Kelas*/
public function delete_data_kelas()
{
	if ($this->input->is_ajax_request() == true) {
		$id_kelas 	= $this->input->post('id',true);
		$hapus 			= $this->bd->delete('data_kelas','id_kelas', $id_kelas);

		if($hapus){
			$msg = [ 'sukses' => 'Data Kelas Berhasil Dihapus'
		];
	}
	echo json_encode($msg);
}

}

}