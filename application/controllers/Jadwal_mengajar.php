<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_mengajar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Jadwal_mengajar_model', 'jadwal_mengajar');
		$this->load->model('Data_materi_model', 'data_materi');
		$this->load->model('Data_tugas_model', 'data_tugas');
		$this->load->model('Data_upload_model', 'data_upload');
		$this->load->model('Data_absen_model', 'data_absen');
		$this->load->model('Data_absensi_model', 'data_absensi');
		cek_login_staff();
	}

	/*View Jadwal Mengajar*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Jadwal Mengajar '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/jadwal_mengajar/index');
		$this->load->view('staff/jadwal_mengajar/modal');
		$this->load->view('template_staff/footer');
	}

	/*Table Jadwal Mengajar*/
	public function table_jadwal_mengajar()
	{
		$hari		= $this->input->post('hari');

		$table 	= $this->jadwal_mengajar->table_jadwal_mengajar($hari);
		$filter = $this->jadwal_mengajar->filter_table_jadwal_mengajar($hari);
		$total 	= $this->jadwal_mengajar->total_table_jadwal_mengajar($hari);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$data_materi = "<a class='mt-2 badge badge-primary' href='Jadwal_mengajar/data_materi/$tb->id_jadpel'>Data Materi
			</a>&nbsp;";

			$data_tugas = "<a class='mt-2 badge badge-success' href='Jadwal_mengajar/data_tugas/$tb->id_jadpel'>Data Tugas
			</a>&nbsp;";

			$data_absen = "<a class='mt-2 badge badge-light' href='Jadwal_mengajar/data_absen/$tb->id_jadpel'>Data Absen
			</a>&nbsp;";

			$td[] = "<center><div class='btn-group'>$data_materi $data_tugas $data_absen</a></center>";
			$td[] = $tb->nama_mapel;
			$td[] = $tb->nama_kelas.' - '.$tb->nama_kejuruan;
			$td[] = $tb->nama_hari.' / '.$tb->waktu_mulai.' - '.$tb->waktu_selesai;

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

	/*View Data Materi*/
	public function data_materi($id_jadpel)
	{
		$id_staff 				= staffdata('id_staff');

		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Data Materi '.$pengaturan->nama_sekolah;

		/*Id_jadpel*/
		$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->where('pengajar', $id_staff)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->get()->row();
		$data['where'] 		= $where;

		if ($where !== null) {
			$this->load->view('template_staff/header', $data);
			$this->load->view('template_staff/navbar');
			$this->load->view('template_staff/sidebar');
			$this->load->view('staff/data_materi/index');
			$this->load->view('staff/data_materi/modal');
			$this->load->view('template_staff/footer');
		} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }
}

/*Table Data Materi*/
public function table_data_materi()
{
	$id_mapel 			= $this->input->post('id_mapel');
	$id_kelas 			= $this->input->post('id_kelas');

	$table 	= $this->data_materi->table_data_materi($id_mapel,$id_kelas);
	$filter = $this->data_materi->filter_table_data_materi($id_mapel,$id_kelas);
	$total 	= $this->data_materi->total_table_data_materi($id_mapel,$id_kelas);

	$data 	= [];

	foreach ($table as $tb) {
		$td = [];

		$edit = "<a class='btn text-dark edit' data-id_materi='$tb->id_materi'>
		<i class='fa-solid fa-pen-to-square'></i></i>
		</a>";

		$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_materi)''>
		<i class='fa-solid fa-delete-left'></i>
		</a>";

		$file_materi = "<a class='mt-2 badge badge-primary' href='".base_url('file/materi/')."$tb->file_materi'>Unduh Materi
		</a>&nbsp;";

		$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
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

/*Modal Tambah Data Materi*/
public function modal_tambah_data_materi()
{
	/*Id_jadpel*/
	$id_jadpel 			= $this->input->post('id_jadpel');
	$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->get()->row();
	$data['where'] 		= $where;

	$this->load->view('staff/data_materi/modal_tambah_data_materi', $data, FALSE);
}

/*Proses Tambah Data Materi*/
public function proses_tambah_data_materi()
{
	$id_jadpel_materi 		= $this->input->post('id_jadpel_materi');
	$judul_materi 			= $this->input->post('judul_materi');
	$des_materi 			= $this->input->post('des_materi');
	$tgl_materi 			= date('Y-m-d H:i');
	$tgl_update_materi 		= date('Y-m-d H:i');
	$user_materi 			= staffdata('id_staff');

	$upload_file 				= $_FILES['file_materi']['name'];
	$config['allowed_types'] 	= 'pdf';
	$config['max_size']     	= '10048';
	$config['upload_path'] 		= './file/materi';
	$config['encrypt_name'] 	= TRUE;

	$this->load->library('upload', $config);

	if ($this->upload->do_upload('file_materi')) {
		$new_image 				= $this->upload->data('file_name');
		$data['file_materi']	= $new_image;

		$data['id_jadpel_materi']	= $id_jadpel_materi;
		$data['judul_materi']		= $judul_materi;
		$data['des_materi']			= $des_materi;
		$data['tgl_materi']			= $tgl_materi;
		$data['tgl_update_materi']	= $tgl_update_materi;
		$data['user_materi']		= $user_materi;

		$save = $this->bd->save('data_materi', $data);
		$output['status'] 	= true;
	} else {
		$output['status'] 		= false;
		$output['keterangan'] 	= "Peringatan! Gagal Tambah Data Materi";
	}

	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*Modal Edit Data Materi*/
public function modal_edit_data_materi()
{
	$id_materi 		= $this->input->post('id_materi');
	$edit 			= $this->db->select('*')->from('data_materi')->where('id_materi', $id_materi)->get()->row();

	$data['edit'] 	= $edit;
	$this->load->view('staff/data_materi/modal_edit_data_materi', $data, FALSE);
}

/*Proses Edit Data Materi*/
public function proses_edit_data_materi()
{
	$id_materi 		= $this->input->post('id_materi');

	$judul_materi 			= $this->input->post('judul_materi');
	$des_materi 			= $this->input->post('des_materi');
	$tgl_update_materi 		= date('Y-m-d H:i');

	$query 					= $this->db->get_where('data_materi', ['id_materi' => $id_materi])->row_array();
	$upload_file 			= $_FILES['file_materi']['name'];

	if ($upload_file) {
		$config['allowed_types'] = 'pdf';
		$config['max_size']     = '10048';
		$config['upload_path'] = './file/materi';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_materi')) {
			$old_file = $query['file_materi'];

			unlink(FCPATH . 'file/materi/' . $old_file);

			$new_file 				= $this->upload->data('file_name');
			$data['file_materi']	= $new_file;
		} else {
			$output['keterangan'] 	= "Gagal ganti File Materi";
			$output['status'] 		= false;
		}
	}

	$data['judul_materi']		= $judul_materi;
	$data['des_materi']			= $des_materi;
	$data['tgl_update_materi']	= $tgl_update_materi;

	$update = $this->bd->update('data_materi', $data, 'id_materi', $id_materi);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*View Data Tugas*/
public function data_tugas($id_jadpel)
{
	$id_staff 				= staffdata('id_staff');

	/*Title*/
	$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
	$data['title']			= 'Data Tugas '.$pengaturan->nama_sekolah;

	/*Id_jadpel*/
	$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->where('pengajar', $id_staff)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->get()->row();
	$data['where'] 		= $where;

	if ($where !== null) {
		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_tugas/index');
		$this->load->view('staff/data_tugas/modal');
		$this->load->view('template_staff/footer');
	} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }
}

/*Table Data Tugas*/
public function table_data_tugas()
{
	$id_mapel 			= $this->input->post('id_mapel');
	$id_kelas 			= $this->input->post('id_kelas');

	$table 	= $this->data_tugas->table_data_tugas($id_mapel,$id_kelas);
	$filter = $this->data_tugas->filter_table_data_tugas($id_mapel,$id_kelas);
	$total 	= $this->data_tugas->total_table_data_tugas($id_mapel,$id_kelas);

	$data 	= [];

	foreach ($table as $tb) {
		$td = [];

		$data_upload = "<a class='btn text-dark' href='".base_url('/')."Jadwal_mengajar/data_upload/$tb->id_tugas'>
		<i class='fa-solid fa-upload'></i>
		</a>&nbsp;";

		$edit = "<a class='btn text-dark edit' data-id_tugas='$tb->id_tugas'>
		<i class='fa-solid fa-pen-to-square'></i>
		</a>";

		$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_tugas)''>
		<i class='fa-solid fa-delete-left'></i>
		</a>";

		$file_tugas = "<a class='mt-2 badge badge-success' href='".base_url('file/tugas/')."$tb->file_tugas'>Unduh Tugas
		</a>&nbsp;";

		$td[] = "<center><div class='btn-group'>$data_upload $edit $delete</a></center>";
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

/*Modal Tambah Data Tugas*/
public function modal_tambah_data_tugas()
{
	/*Id_jadpel*/
	$id_jadpel 			= $this->input->post('id_jadpel');
	$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->get()->row();
	$data['where'] 		= $where;

	$this->load->view('staff/data_tugas/modal_tambah_data_tugas', $data, FALSE);
}

/*Proses Tambah Data Tugas*/
public function proses_tambah_data_tugas()
{
	/*Generate id_tugas*/
	$query = $this->db->select_max('id_tugas')->from('data_tugas')->get()->row_array();
	$urutan = $query['id_tugas'];
	$urutan++;
	$id_tugas = $urutan;

	$id_jadpel_tugas = $this->input->post('id_jadpel_tugas');
	$judul_tugas = $this->input->post('judul_tugas');
	$des_tugas = $this->input->post('des_tugas');
	$tgl_mulai_tugas = $this->input->post('tgl_mulai_tugas');
	$tgl_selesai_tugas = $this->input->post('tgl_selesai_tugas');
	$tgl_update_tugas = date('Y-m-d H:i');
	$tgl_tugas = date('Y-m-d H:i');
	$user_tugas = staffdata('id_staff');

	$upload_file = $_FILES['file_tugas']['name'];
	$config['allowed_types'] = 'pdf';
	$config['max_size'] = '10048';
	$config['upload_path'] = './file/tugas';
	$config['encrypt_name'] = TRUE;

	$this->load->library('upload', $config);

	if ($this->upload->do_upload('file_tugas')) {
		$new_file = $this->upload->data('file_name');

		$data['file_tugas'] = $new_file;
		$data['id_tugas'] = $id_tugas;
		$data['id_jadpel_tugas'] = $id_jadpel_tugas;
		$data['judul_tugas'] = $judul_tugas;
		$data['des_tugas'] = $des_tugas;
		$data['tgl_mulai_tugas'] = $tgl_mulai_tugas;
		$data['tgl_selesai_tugas'] = $tgl_selesai_tugas;
		$data['tgl_update_tugas'] = $tgl_update_tugas;
		$data['tgl_tugas'] = $tgl_tugas;
		$data['user_tugas'] = $user_tugas;

		/*Query Data Mapel*/
		$query = $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel_tugas)->join('data_mapel', 'id_mapel=jadpel_mapel')->join('data_kelas', 'id_kelas=jadpel_kelas')->get()->row();

		if ($query) {
			$id_kelas = $query->id_kelas;

			/*Ambil data siswa berdasarkan kelas*/
			$this->db->where('kelas', $id_kelas);
			$query = $this->db->get('data_siswa');
			$siswa_data = $query->result_array();

			/*Buat data tugas selesai untuk setiap siswa*/
			$tugas_data = array();
			foreach ($siswa_data as $siswa) {
				$tugas_data[] = array(
					'user_tugas_selesai' => $siswa['id_siswa'],
					'tugas' => $id_tugas,
					'status_tugas_selesai' => 'nonaktif'
				);
			}

			/*Insert Data Tugas Selesai*/
			if (!empty($tugas_data)) {
				$this->db->insert_batch('data_tugas_selesai', $tugas_data);
				$this->db->insert('data_tugas', $data);

				$output['status'] = true;
				$output['keterangan'] = 'Tugas berhasil ditambahkan!';
			} else {
				$output['status'] = false;
				$output['keterangan'] = 'Tidak Bisa Buat Tugas, karena tidak ada Siswa/Siswi dikelas ini!';
			}
		} else {
			$output['status'] = false;
			$output['keterangan'] = 'Tidak Bisa Buat Tugas, karena tidak ada data Jadwal Pelajaran dengan ID tersebut!';
		}
	} else {
		$output['status'] = false;
		$output['keterangan'] = 'Upload File Tugas Maksimal 10MB File Type PDF';
	}

	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}


/*Modal Edit Data Tugas*/
public function modal_edit_data_tugas()
{
	$id_tugas 		= $this->input->post('id_tugas');
	$edit 			= $this->db->select('*')->from('data_tugas')->where('id_tugas', $id_tugas)->get()->row();

	$data['edit'] 	= $edit;
	$this->load->view('staff/data_tugas/modal_edit_data_tugas', $data, FALSE);
}

/*Proses Edit Data Tugas*/
public function proses_edit_data_tugas()
{
	$id_tugas 		= $this->input->post('id_tugas');

	$judul_tugas 			= $this->input->post('judul_tugas');
	$des_tugas 				= $this->input->post('des_tugas');
	$tgl_mulai_tugas 		= $this->input->post('tgl_mulai_tugas');
	$tgl_selesai_tugas 		= $this->input->post('tgl_selesai_tugas');
	$tgl_update_tugas 		= date('Y-m-d H:i');

	$query 					= $this->db->get_where('data_tugas', ['id_tugas' => $id_tugas])->row_array();
	$upload_file 			= $_FILES['file_tugas']['name'];

	if ($upload_file) {
		$config['allowed_types'] = 'pdf';
		$config['max_size']     = '10048';
		$config['upload_path'] = './file/tugas';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_tugas')) {
			$old_file = $query['file_tugas'];

			unlink(FCPATH . 'file/tugas/' . $old_file);

			$new_file 				= $this->upload->data('file_name');
			$data['file_tugas']	= $new_file;
		} else {
			$output['keterangan'] 	= "Gagal ganti File Tugas";
			$output['status'] 		= false;
		}
	}

	$data['judul_tugas']		= $judul_tugas;
	$data['des_tugas']			= $des_tugas;
	$data['tgl_mulai_tugas']	= $tgl_mulai_tugas;
	$data['tgl_selesai_tugas']	= $tgl_selesai_tugas;
	$data['tgl_update_tugas']	= $tgl_update_tugas;

	$update = $this->bd->update('data_tugas', $data, 'id_tugas', $id_tugas);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*View Data Upload*/
public function data_upload($id_tugas)
{
	$id_staff 				= staffdata('id_staff');

	/*Title*/
	$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
	$data['title']			= 'Data Upload Tugas '.$pengaturan->nama_sekolah;

	/*Id_jadpel*/
	$where 				= $this->db->select('*')->from('data_tugas')->where('id_tugas', $id_tugas)->join('data_jadpel','id_jadpel=id_jadpel_tugas')->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->where('pengajar', $id_staff)->get()->row();

	$data['where'] 		= $where;

	if ($where !== null) {
		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_upload/index');
		$this->load->view('staff/data_upload/modal');
		$this->load->view('template_staff/footer');
	} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }
}

/*Table Data Upload*/
public function table_data_upload()
{
	$id_tugas 	= $this->input->post('id_tugas');

	$table 		= $this->data_upload->table_data_upload($id_tugas);
	$filter 	= $this->data_upload->filter_table_data_upload($id_tugas);
	$total 		= $this->data_upload->total_table_data_upload($id_tugas);

	$data 	= [];

	foreach ($table as $tb) {
		$td = [];

		$nilai = "<a class='btn text-dark nilai' data-id_tugas_selesai='$tb->id_tugas_selesai'>
		<i class='fa-solid fa-check'></i>
		</a>";

		$edit = "<a class='btn text-dark edit' data-id_tugas_selesai='$tb->id_tugas_selesai'>
		<i class='fa-solid fa-pen-to-square'></i>
		</a>";

		$link_tugas = "<a target='_blank' class='mt-2 badge badge-primary' href='$tb->file_tugas_selesai'>Link Tugas
		</a>&nbsp;";

		$link_tugas_disable = "<a class='mt-2 badge badge-warning' disabled>Belum Upload
		</a>&nbsp;";

		$ifelse="";
		if ($tb->status_tugas_selesai === 'nonaktif') {
			$td[] = "<center><a target='_blank' class='mt-2 badge badge-danger'>Belum Mengerjakan
			</a></center>";
		} else if ($tb->status_tugas_selesai === 'proses') {
			$td[] = "<center><div class='btn-group'>$nilai</a></center>";
		} else {
			$td[] = "<center><div class='btn-group'>$edit</a></center>";
		};

		$td[] = $tb->nama_siswa;

		$ifelse="";
		if ($tb->status_tugas_selesai === 'nonaktif') {
			$td[] = $link_tugas_disable;
		} else if ($tb->status_tugas_selesai === 'proses') {
			$td[] = $link_tugas;
		} else {
			$td[] = $link_tugas;
		};


		$td[] = $tb->tgl_tugas_selesai;

		$ifelse="";
		if ($tb->status_tugas_selesai === 'nonaktif') {
			$td[] = $tb->nilai_tugas;
		} else if ($tb->status_tugas_selesai === 'proses') {
			$td[] = $tb->nilai_tugas;
		} else {
			$td[] = "<a target='_blank' class='mt-2 badge badge-warning'>$tb->nilai_tugas
			</a>";
		};

		$td[] = $tb->catatan_tugas;

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

/*Modal Nilai Tugas*/
public function modal_nilai_tugas()
{
	$id_tugas_selesai 	= $this->input->post('id_tugas_selesai');
	$nilai 				= $this->db->select('*')->from('data_tugas_selesai')->where('id_tugas_selesai', $id_tugas_selesai)->join('data_tugas','id_tugas=tugas')->get()->row();

	$data['nilai'] 	= $nilai;
	$this->load->view('staff/data_upload/modal_nilai_tugas', $data, FALSE);
}

/*Proses Nilai Tugas*/
public function proses_nilai_tugas()
{
	$id_tugas_selesai 		= $this->input->post('id_tugas_selesai');
	$status_tugas_selesai	= 'nilai';
	$nilai_tugas 			= $this->input->post('nilai_tugas');
	$catatan_tugas 			= $this->input->post('catatan_tugas');
	$pengajar_tugas_selesai = staffdata('id_staff');

	$data['status_tugas_selesai']	= $status_tugas_selesai;
	$data['nilai_tugas']			= $nilai_tugas;
	$data['catatan_tugas']			= $catatan_tugas;
	$data['pengajar_tugas_selesai']	= $pengajar_tugas_selesai;

	$update 			= $this->bd->update('data_tugas_selesai', $data, 'id_tugas_selesai', $id_tugas_selesai);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*Modal Edit Nilai Tugas*/
public function modal_edit_nilai_tugas()
{
	$id_tugas_selesai 	= $this->input->post('id_tugas_selesai');
	$nilai 				= $this->db->select('*')->from('data_tugas_selesai')->where('id_tugas_selesai', $id_tugas_selesai)->join('data_tugas','id_tugas=tugas')->get()->row();

	$data['nilai'] 	= $nilai;
	$this->load->view('staff/data_upload/modal_edit_nilai_tugas', $data, FALSE);
}

/*Proses Edit Nilai Tugas*/
public function proses_edit_nilai_tugas()
{
	$id_tugas_selesai 		= $this->input->post('id_tugas_selesai');
	$nilai_tugas 			= $this->input->post('nilai_tugas');
	$catatan_tugas 			= $this->input->post('catatan_tugas');

	$data['nilai_tugas']			= $nilai_tugas;
	$data['catatan_tugas']			= $catatan_tugas;

	$update 			= $this->bd->update('data_tugas_selesai', $data, 'id_tugas_selesai', $id_tugas_selesai);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*View Data Absen*/
public function data_absen($id_jadpel)
{
	$id_staff 				= staffdata('id_staff');

	/*Title*/
	$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
	$data['title']			= 'Data Absen '.$pengaturan->nama_sekolah;

	/*Id_jadpel*/
	$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->where('pengajar', $id_staff)->get()->row();
	$data['where'] 		= $where;

	/*Id Mapel & Id Kelas*/
	$id_mapel = $where->jadpel_mapel;
	$id_kelas = $where->jadpel_kelas;

	$where2				= $this->db->select('*')->from('data_jadpel')->where('jadpel_mapel', $id_mapel)->where('jadpel_kelas', $id_kelas)->get()->row();
	$data['where2'] 		= $where2;

	if ($where !== null) {
		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_absen/index');
		$this->load->view('staff/data_absen/modal');
		$this->load->view('template_staff/footer');
	} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }
}

/*Table Data Absen*/
public function table_data_absen()
{
	$id_mapel 			= $this->input->post('id_mapel');
	$id_kelas 			= $this->input->post('id_kelas');

	$table 	= $this->data_absen->table_data_absen($id_mapel,$id_kelas);
	$filter = $this->data_absen->filter_table_data_absen($id_mapel,$id_kelas);
	$total 	= $this->data_absen->total_table_data_absen($id_mapel,$id_kelas);

	$data 	= [];

	foreach ($table as $tb) {
		$td = [];

		$data_absensi = "<a class='btn text-dark' href='".base_url('/')."Jadwal_mengajar/data_absensi/$tb->id_absen'>
		<i class='fa-solid fa-users'></i>
		</a>&nbsp;";

		$edit = "<a class='btn text-dark edit' data-id_absen='$tb->id_absen'>
		<i class='fa-solid fa-pen-to-square'></i>
		</a>";

		$delete = "<a class='btn text-danger' href='javascript:void(0)' onclick='delete_data($tb->id_absen)''>
		<i class='fa-solid fa-delete-left'></i>
		</a>";

		$td[] = "<center><div class='btn-group'>$data_absensi $delete</a></center>";
		$td[] = 'Pertemuan '.$tb->judul_absen;
		$td[] = $tb->tgl_absen;
		$td[] = $tb->waktu_mulai;
		$td[] = $tb->waktu_selesai;

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

/*Modal Tambah Data Absen*/
public function modal_tambah_data_absen()
{
	/*Id_jadpel*/
	$id_jadpel 			= $this->input->post('id_jadpel');
	$where				= $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel)->get()->row();
	$data['where'] 		= $where;

	$this->load->view('staff/data_absen/modal_tambah_data_absen', $data, FALSE);
}

/*Proses Tambah Data Absen*/
public function proses_tambah_data_absen()
{
	$id_jadpel_absen 		= $this->input->post('id_jadpel_absen');
	$judul_absen 			= $this->input->post('judul_absen');
	$tgl_absen 				= date('Y-m-d');
	$waktu_absen 			= date('H:i');
	$user_absen 			= staffdata('id_staff');

	/*Generate id_absen*/
	$query   	= $this->db->select_max('id_absen')->from('data_absen')->get()->row_array();
	$urutan    	= $query['id_absen'];
	$urutan++;
	$id_absen 	= $urutan;

	$data['id_absen']			= $id_absen;
	$data['id_jadpel_absen']	= $id_jadpel_absen;
	$data['judul_absen']		= $judul_absen;
	$data['tgl_absen']			= $tgl_absen;
	$data['waktu_absen']		= $waktu_absen;
	$data['user_absen']			= $user_absen;

	/*Query Data Mapel*/
	$query = $this->db->select('*')->from('data_jadpel')->where('id_jadpel', $id_jadpel_absen)->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->get()->row();

	if ($query) {
		$id_mapel = $query->id_mapel;
		$id_kelas = $query->id_kelas;

		/*Ambil data siswa berdasarkan kelas*/
		$this->db->where('kelas', $id_kelas);
		$query = $this->db->get('data_siswa');
		$siswa_data = $query->result_array();

		/*Buat data absensi untuk setiap siswa*/
		$absensi_data = array();
		foreach ($siswa_data as $siswa) {
			$absensi_data[] = array(
				'user_absen_murid' => $siswa['id_siswa'],
				'absen' => $id_absen,
				'tgl_absen_murid' => $tgl_absen,
				'mapel_absen_murid' => $id_mapel,
				'status_absen_murid' => 'nonaktif'
			);
		}

		/*Insert Data Absensi Murid*/
		if (!empty($absensi_data)) {
			$this->db->insert_batch('data_absen_murid', $absensi_data);

			/*Insert Data Absen*/
			$save = $this->bd->save('data_absen', $data);

			/*Update absen di Jadpel menjadi aktif*/
			$update_jadpel['absen']	= 'aktif';
			$update = $this->db->set($update_jadpel)->where('jadpel_mapel', $id_mapel)->where('jadpel_kelas', $id_kelas)->update('data_jadpel');

			$output['status'] 	= true;

		} else {
			$output['keterangan'] 	= 'Tidak Bisa buka Absen, karena tidak ada Siswa/Siswi dikelas ini!';
			$output['status'] 	= false;
		}

	}
	$this->output->set_content_type('application/json')->set_output(json_encode($output));

}

/*Modal Edit Data Absen*/
public function modal_edit_data_absen()
{
	$id_absen 	= $this->input->post('id_absen');
	$edit 		= $this->db->select('*')->from('data_absen')->where('id_absen', $id_absen)->join('data_jadpel','id_jadpel=id_jadpel_absen')->get()->row();

	$data['edit'] 	= $edit;
	$this->load->view('staff/data_absen/modal_edit_data_absen', $data, FALSE);
}

/*Proses Edit Data Absen*/
public function proses_edit_data_absen()
{
	$id_absen 		= $this->input->post('id_absen');
	$judul_absen 	= $this->input->post('judul_absen');
	$tgl_absen 		= $this->input->post('tgl_absen');

	$data['id_absen']		= $id_absen;
	$data['judul_absen']	= $judul_absen;
	$data['tgl_absen']		= $tgl_absen;

	$update 			= $this->bd->update('data_absen', $data, 'id_absen', $id_absen);
	$output['status'] 	= true;
	$this->output->set_content_type('application/json')->set_output(json_encode($output));
}

/*Tutup Data Absen*/
public function tutup_data_absen()
{
	if ($this->input->is_ajax_request() == true) {
		/*$id_jadpel 		= $this->input->post('id_jadpel',true);*/
		$id_mapel 		= $this->input->post('id_mapel',true);
		$id_kelas 		= $this->input->post('id_kelas',true);

		/*Update absen di Jadpel menjadi nonaktif*/
		$update_jadpel['absen']	= 'nonaktif';

		$this->db->set($update_jadpel);
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->update('data_jadpel');

		$msg = [ 'sukses' => 'Absen Berhasil ditutup!' ];
		echo json_encode($msg);
	}
}

/*View Data Absensi*/
public function data_absensi($id_absen)
{
	$id_staff 				= staffdata('id_staff');

	/*Title*/
	$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
	$data['title']			= 'Data Absensi '.$pengaturan->nama_sekolah;

	/*Id_jadpel*/
	$where				= $this->db->select('*')->from('data_absen')->where('id_absen', $id_absen)->join('data_jadpel','id_jadpel=id_jadpel_absen')->join('data_mapel','id_mapel=jadpel_mapel')->join('data_kelas','id_kelas=jadpel_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_hari','id_hari=hari')->where('pengajar', $id_staff)->get()->row();
	$data['where'] 		= $where;

	if ($where !== null) {
		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/data_absensi/index');
		$this->load->view('staff/data_absensi/modal');
		$this->load->view('template_staff/footer');
	} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }
}

/*Table Data Absensi*/
public function table_data_absensi()
{
	$id_absen 			= $this->input->post('id_absen');

	$table 	= $this->data_absensi->table_data_absensi($id_absen);
	$filter = $this->data_absensi->filter_table_data_absensi($id_absen);
	$total 	= $this->data_absensi->total_table_data_absensi($id_absen);

	$data 	= [];

	foreach ($table as $tb) {
		$td = [];

		$td[] = $tb->nisn;
		$td[] = $tb->nama_siswa;
		$td[] = $tb->jk_siswa;

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

/*Delete Data Materi*/
public function delete_data_materi()
{
	if ($this->input->is_ajax_request() == true) {
		$id_materi 		= $this->input->post('id',true);

		/*Delete File Materi*/
		$query 			= $this->db->get_where('data_materi', ['id_materi' => $id_materi])->row_array();
		$old_file 		= $query['file_materi'];
		unlink(FCPATH . 'file/materi/' . $old_file);

		$this->bd->delete('data_materi','id_materi', $id_materi);
		$msg = [ 'sukses' => 'Data Materi Berhasil Dihapus' ];
		echo json_encode($msg);
	}
}

/*Delete Data Tugas*/
public function delete_data_tugas()
{
	if ($this->input->is_ajax_request() == true) {
		$id_tugas 		= $this->input->post('id',true);

		/*Delete File Tugas*/
		$query 			= $this->db->get_where('data_tugas', ['id_tugas' => $id_tugas])->row_array();
		$old_file 		= $query['file_tugas'];
		unlink(FCPATH . 'file/tugas/' . $old_file);

		$this->bd->delete('data_tugas','id_tugas', $id_tugas);

		/*Delete Data Upload*/
		$this->bd->delete('data_tugas_selesai','tugas', $id_tugas);

		$msg = [ 'sukses' => 'Data Tugas Berhasil Dihapus' ];
		echo json_encode($msg);
	}
}

/*Delete Data Absen*/
public function delete_data_absen()
{
	if ($this->input->is_ajax_request() == true) {
		$id_absen 		= $this->input->post('id',true);

		/*Update absen di Jadpel menjadi nonaktif*/
		$query 					= $this->db->select('*')->from('data_absen')->where('id_absen', $id_absen)->get()->row();
		$id_jadpel_absen 		= $query->id_jadpel_absen;
		$update_jadpel['absen']	= 'nonaktif';
		$update = $this->bd->update('data_jadpel', $update_jadpel, 'id_jadpel', $id_jadpel_absen);

		$this->bd->delete('data_absen','id_absen', $id_absen);
		$this->bd->delete('data_absen_murid','absen', $id_absen);
		$msg = [ 'sukses' => 'Data Absen Berhasil Dihapus' ];
		echo json_encode($msg);


	}
}

}