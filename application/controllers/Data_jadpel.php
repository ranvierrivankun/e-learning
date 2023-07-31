<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_jadpel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_jadpel_model', 'data_jadwal_pelajaran');
		cek_login_staff();
		admin_staff();
	}

	/*View Data Jadwal Pelajaran*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Data Jadwal Pelajaran '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_jadpel/index');
		$this->load->view('staff/data_jadpel/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Data Jadpel*/
	public function table_data_jadpel()
	{
		$table 	= $this->data_jadwal_pelajaran->table_data_jadpel();
		$filter = $this->data_jadwal_pelajaran->filter_table_data_jadpel();
		$total 	= $this->data_jadwal_pelajaran->total_table_data_jadpel();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn text-dark edit' data-id_jadpel='$tb->id_jadpel'>
			<i class='fa-solid fa-pen-to-square'></i></i>
			</a>";

			$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_jadpel)''>
			<i class='fa-solid fa-delete-left'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nama_mapel;
			$td[] = $tb->nama_kelas.' - '.$tb->nama_kejuruan;
			$td[] = $tb->nama_hari.' / '.$tb->waktu_mulai.' - '.$tb->waktu_selesai;
			$td[] = $tb->nama_staff;

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

	/*Modal Tambah Data Jadpel*/
	public function modal_tambah_data_jadpel()
	{
		$this->load->view('staff/data_jadpel/modal_tambah_data_jadpel', FALSE);
	}

	/*Proses Tambah Data Jadpel*/
	public function proses_tambah_data_jadpel()
	{
		$kelas 			= $this->input->post('kelas');
		$mapel 			= $this->input->post('mapel');
		$hari 			= $this->input->post('hari');
		$waktu_mulai 	= $this->input->post('waktu_mulai');
		$waktu_selesai 	= $this->input->post('waktu_selesai');
		$pengajar 		= $this->input->post('pengajar');
		$absen 			= 'nonaktif';

		$data['jadpel_kelas']	= $kelas;
		$data['jadpel_mapel']	= $mapel;
		$data['hari']			= $hari;
		$data['waktu_mulai']	= $waktu_mulai;
		$data['waktu_selesai']	= $waktu_selesai;
		$data['pengajar']		= $pengajar;
		$data['absen']			= $absen;

		$save = $this->bd->save('data_jadpel', $data);
		$output['status'] 	= true;
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Modal Edit Data Jadpel*/
	public function modal_edit_data_jadpel()
	{
		$id_jadpel 	= $this->input->post('id_jadpel');
		$edit 		= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();

		$edit2		= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_hari','id_hari=hari')->join('data_staff','id_staff=pengajar')->get()->row();

		$data['edit'] 	= $edit;
		$data['edit2'] 	= $edit2;
		$this->load->view('staff/data_jadpel/modal_edit_data_jadpel', $data, FALSE);
	}

	/*Proses Edit Data Jadpel*/
	public function proses_edit_data_jadpel()
	{
		$id_jadpel 		= $this->input->post('id_jadpel');

		/*$kelas 			= $this->input->post('kelas');
		$mapel 			= $this->input->post('mapel');*/
		$hari 			= $this->input->post('hari');
		$waktu_mulai 	= $this->input->post('waktu_mulai');
		$waktu_selesai 	= $this->input->post('waktu_selesai');
		$pengajar 		= $this->input->post('pengajar');

		/*$data['jadpel_kelas']	= $kelas;
		$data['jadpel_mapel']	= $mapel;*/
		$data['hari']			= $hari;
		$data['waktu_mulai']	= $waktu_mulai;
		$data['waktu_selesai']	= $waktu_selesai;
		$data['pengajar']		= $pengajar;

		$update = $this->bd->update('data_jadpel', $data, 'id_jadpel', $id_jadpel);
		$output['status'] 	= true;
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Delete Data Jadpel*/
	public function delete_data_jadpel()
	{
		if ($this->input->is_ajax_request() == true) {

			$id_jadpel 	= $this->input->post('id',true);

			/* Query */
			$query_1 = $this->db->select('*')->from('data_materi')->where('id_jadpel_materi', $id_jadpel)->get();
			$query_2 = $this->db->select('*')->from('data_tugas')->where('id_jadpel_tugas', $id_jadpel)->get();
			$query_3 = $this->db->select('*')->from('data_absen')->where('id_jadpel_absen', $id_jadpel)->get();

			if ($query_1->num_rows() > 0) {
				$result_1 = $query_1->row();
				$id_materi = $result_1->id_materi;

				/*Delete File Materi*/
				$query_materi = $this->db->get_where('data_materi', ['id_materi' => $id_materi])->row_array();
				$old_file_materi = $query_materi['file_materi'];

				if ($old_file_materi && file_exists(FCPATH . 'file/materi/' . $old_file_materi)) {
					unlink(FCPATH . 'file/materi/' . $old_file_materi);
				}

				/*Delete Data Materi*/
				$this->bd->delete('data_materi','id_materi', $id_materi);

			} else {
				$id_materi = null;
			}

			if ($query_2->num_rows() > 0) {
				$result_2 = $query_2->row();
				$id_tugas = $result_2->id_tugas;

				/*Delete File Tugas*/
				$query_tugas = $this->db->get_where('data_tugas', ['id_jadpel_tugas' => $id_jadpel])->row_array();
				$old_file_tugas = $query_tugas['file_tugas'];

				if ($old_file_tugas && file_exists(FCPATH . 'file/tugas/' . $old_file_tugas)) {
					unlink(FCPATH . 'file/tugas/' . $old_file_tugas);
				}

				/*Delete Data Tugas*/
				$this->bd->delete('data_tugas','id_tugas', $id_tugas);

				/*Delete Data Tugas Selesai*/
				$this->bd->delete('data_tugas_selesai','tugas', $id_tugas);

			} else {
				$id_tugas = null;
			}

			if ($query_3->num_rows() > 0) {
				$result_3 = $query_3->row();
				$id_absen = $result_3->id_absen;

				/*Delete Data Absen*/
				$this->bd->delete('data_absen','id_jadpel_absen', $id_jadpel);

				/*Delete Data Absen Murid*/
				$this->bd->delete('data_absen_murid','absen', $id_absen);

			} else {
				$id_absen = null;
			}

			/*Delete Data Jadpel*/
			$this->bd->delete('data_jadpel','id_jadpel', $id_jadpel);

			$msg = [ 'sukses' => 'Data Jadwal Pelajaran Berhasil Dihapus' ];
			echo json_encode($msg);
		}
	}

}