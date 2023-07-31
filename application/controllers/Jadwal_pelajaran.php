<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_pelajaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Jadwal_pelajaran_model', 'jadwal_pelajaran');
		$this->load->model('Data_materi_murid_model', 'data_materi');
		$this->load->model('Data_tugas_murid_model', 'data_tugas');
		$this->load->model('Data_absen_murid_model', 'data_absen_murid');
		cek_login_siswa();
	}

	/*View Jadwal Pelajaran*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Jadwal Pelajaran '.$pengaturan->nama_sekolah;

		$this->load->view('template_siswa/header', $data);
		$this->load->view('template_siswa/navbar');
		$this->load->view('template_siswa/sidebar');
		$this->load->view('siswa/jadwal_pelajaran/index');
		$this->load->view('siswa/jadwal_pelajaran/modal');
		$this->load->view('template_siswa/footer');
	}

	/*Table Jadwal Pelajaran*/
	public function table_jadwal_pelajaran()
	{
		$hari		= $this->input->post('hari');

		$table 	= $this->jadwal_pelajaran->table_jadwal_pelajaran($hari);
		$filter = $this->jadwal_pelajaran->filter_table_jadwal_pelajaran($hari);
		$total 	= $this->jadwal_pelajaran->total_table_jadwal_pelajaran($hari);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$data_materi = "<a class='mt-2 badge badge-primary' href='Jadwal_pelajaran/materi/$tb->id_jadpel'>Materi
			</a>&nbsp;";

			$data_tugas = "<a class='mt-2 badge badge-success' href='Jadwal_pelajaran/tugas/$tb->id_jadpel'>Tugas
			</a>&nbsp;";

			$data_absen = "<a class='mt-2 badge badge-light' href='Jadwal_pelajaran/absen/$tb->id_jadpel'>Absen
			</a>&nbsp;";

			$td[] = "<center><div class='btn-group'>$data_materi $data_tugas $data_absen</a></center>";
			$td[] = $tb->nama_mapel;
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

	/*View Materi*/
	public function materi($id_jadpel)
	{

		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Materi '.$pengaturan->nama_sekolah;

		/*Id_jadpel*/
		$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->get()->row();
		$data['where'] 		= $where;

		/*Require*/
		$kelas = $where->jadpel_kelas;
		$siswa = userdata('kelas');

		if ($siswa == $kelas) {
			$this->load->view('template_siswa/header', $data);
			$this->load->view('template_siswa/navbar');
			$this->load->view('template_siswa/sidebar');
			$this->load->view('siswa/materi/index');
			$this->load->view('siswa/materi/modal');
			$this->load->view('template_siswa/footer');
		} else {
			redirect('dashboard');
		}
		
	}

	/*Table Materi*/
	public function table_data_materi()
	{
		$id_mapel 			= $this->input->post('id_mapel');
		
		$table 	= $this->data_materi->table_data_materi($id_mapel);
		$filter = $this->data_materi->filter_table_data_materi($id_mapel);
		$total 	= $this->data_materi->total_table_data_materi($id_mapel);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$file_materi = "<a class='mt-2 badge badge-primary' href='".base_url('file/materi/')."$tb->file_materi'>Unduh Materi
			</a>&nbsp;";

			$td[] = $tb->judul_materi;
			$td[] = $tb->des_materi;
			$td[] = $file_materi;
			$td[] = $tb->tgl_update_materi;

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

	/*View Tugas*/
	public function tugas($id_jadpel)
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Tugas '.$pengaturan->nama_sekolah;

		/*Id_jadpel*/
		$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->get()->row();
		$data['where'] 		= $where;

		/*Require*/
		$kelas = $where->jadpel_kelas;
		$siswa = userdata('kelas');

		if ($siswa == $kelas) {
			$this->load->view('template_siswa/header', $data);
			$this->load->view('template_siswa/navbar');
			$this->load->view('template_siswa/sidebar');
			$this->load->view('siswa/tugas/index');
			$this->load->view('siswa/tugas/modal');
			$this->load->view('template_siswa/footer');
		} else {
			redirect('dashboard');
		}
	}

	/*Table Tugas*/
	public function table_data_tugas()
	{
		$id_mapel 			= $this->input->post('id_mapel');
		
		$table 	= $this->data_tugas->table_data_tugas($id_mapel);
		$filter = $this->data_tugas->filter_table_data_tugas($id_mapel);
		$total 	= $this->data_tugas->total_table_data_tugas($id_mapel);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$upload = "<a class='btn text-dark edit' data-id_tugas='$tb->id_tugas'>
			<i class='fa-solid fa-upload'></i>
			</a>";

			$file_tugas = "<a class='mt-2 badge badge-success' href='".base_url('file/tugas/')."$tb->file_tugas'>Unduh Tugas
			</a>&nbsp;";

			$td[] = "<center><div class='btn-group'>$upload</a></center>";
			$td[] = $tb->judul_tugas;
			$td[] = $tb->des_tugas;
			$td[] = $file_tugas;
			$td[] = $tb->tgl_mulai_tugas;
			$td[] = $tb->tgl_selesai_tugas;
			$td[] = $tb->tgl_tugas;

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

	/*Modal Upload Tugas*/
	public function modal_upload_tugas()
	{
		$id_siswa			= userdata('id_siswa');
		$id_tugas 			= $this->input->post('id_tugas');
		$upload 			= $this->db->select('*')->from('data_tugas')->where('id_tugas', $id_tugas)->get()->row();

		$proses 			= $this->db->select('*')->From('data_tugas_selesai')->where('tugas', $id_tugas)->where('user_tugas_selesai',$id_siswa)->get()->num_rows();
		$upload2	= $this->db->select('*')->from('data_tugas_selesai')->where('tugas', $id_tugas)->where('user_tugas_selesai',$id_siswa)->get()->row();

		$data['upload'] 	= $upload;
		$data['proses'] 	= $proses;
		$data['upload2'] 	= $upload2;
		$this->load->view('siswa/tugas/modal_upload_tugas', $data, FALSE);
	}

	/*Proses Upload Tugas*/
	public function proses_upload_tugas()
	{
		$tugas 					= $this->input->post('tugas');
		$user_tugas_selesai 	= userdata('id_siswa');
		$file_tugas_selesai		= $this->input->post('file_tugas_selesai');
		$status_tugas_selesai	= 'proses';
		$tgl_tugas_selesai 		= date('Y-m-d H:i');


		$data['tugas']						= $tugas;
		$data['user_tugas_selesai']			= $user_tugas_selesai;
		$data['file_tugas_selesai']			= $file_tugas_selesai;
		$data['status_tugas_selesai']		= $status_tugas_selesai;
		$data['tgl_tugas_selesai']			= $tgl_tugas_selesai;

		$this->bd->save('data_tugas_selesai', $data);
		$output['status'] 	= true;
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*Proses Update Upload Tugas*/
	public function proses_update_upload_tugas()
	{
		$id_tugas_selesai 				= $this->input->post('id_tugas_selesai');
		$file_tugas_selesai				= $this->input->post('file_tugas_selesai');
		$status_tugas_selesai			= 'proses';
		$tgl_tugas_selesai 				= date('Y-m-d H:i');

		$query = $this->db->select('*')->from('data_tugas_selesai')->where('id_tugas_selesai', $id_tugas_selesai)->get()->row();

		/*Cek Status Tugas Selesai*/
		if($query->status_tugas_selesai == 'nonaktif') {
			$data['file_tugas_selesai']		= $file_tugas_selesai;
			$data['status_tugas_selesai']	= $status_tugas_selesai;
			$data['tgl_tugas_selesai']		= $tgl_tugas_selesai;

		} else if($query->status_tugas_selesai == 'nilai') {
			$data['file_tugas_selesai']		= $file_tugas_selesai;

			
		} else {
			$data['file_tugas_selesai']		= $file_tugas_selesai;
		}

		$update 			= $this->bd->update('data_tugas_selesai', $data, 'id_tugas_selesai', $id_tugas_selesai);
		$output['status'] 	= true;
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*View Absen*/
	public function absen($id_jadpel)
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Absen '.$pengaturan->nama_sekolah;

		/*Id_jadpel*/
		$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->get()->row();
		$data['where'] 		= $where;

		/*Require*/
		$kelas = $where->jadpel_kelas;
		$siswa = userdata('kelas');

		if ($siswa == $kelas) {
			$this->load->view('template_siswa/header', $data);
			$this->load->view('template_siswa/navbar');
			$this->load->view('template_siswa/sidebar');
			$this->load->view('siswa/absen/index');
			$this->load->view('siswa/absen/modal');
			$this->load->view('template_siswa/footer');
		} else {
			redirect('dashboard');
		}
	}

	/*Table Data Absen*/
	public function table_data_absen()
	{
		$id_mapel = $this->input->post('id_mapel');

		$table 	= $this->data_absen_murid->table_data_absen($id_mapel);
		$filter = $this->data_absen_murid->filter_table_data_absen($id_mapel);
		$total 	= $this->data_absen_murid->total_table_data_absen($id_mapel);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$absen = "<a class='btn text-danger' href='javascript:void(0)' onclick='absen($tb->id_absen)''>
			<i class='fa-solid fa-check'></i>
			</a>";

			$td[] = 'Pertemuan '.$tb->judul_absen;
			$td[] = $tb->tgl_absen_murid;

			$ifelse="";
			if ($tb->status_absen_murid == 'nonaktif' ) {
				$td[] = "<a class='mt-2 badge badge-danger'>Belum Absen</a>&nbsp;";
			} else {
				$td[] = "<a class='mt-2 badge badge-primary'>Sudah Absen</a>&nbsp;";
			};

			$td[] = $tb->waktu_absen_murid;

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

	/*Proses Absen*/
	public function proses_absen()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_absen 		= $this->input->post('id_absen',true);
			$id_siswa		= userdata('id_siswa');

			/*Update data_absen_murid*/
			$data['waktu_absen_murid']	= date('H:i');
			$data['status_absen_murid']	= 'aktif';

			$this->db->set($data);
			$this->db->where('absen', $id_absen);
			$this->db->where('user_absen_murid', $id_siswa);
			$this->db->update('data_absen_murid');

			$msg = [ 'sukses' => 'Absen Berhasil!' ];
			echo json_encode($msg);
		}
	}

}