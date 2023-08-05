<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Laporan_model', 'laporan');
		$this->load->model('Pengaturan_kelas_model', 'pengaturan_kelas');
		cek_login_staff();
	}

	/*Index*/
	public function index()
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Laporan E-Learning '.$pengaturan->nama_sekolah;

		$this->load->view('template_staff/header', $data);
		$this->load->view('template_staff/navbar');
		$this->load->view('template_staff/sidebar');
		$this->load->view('staff/laporan/index');
		$this->load->view('template_staff/footer');
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

			$data_tugas = "<a class='mt-2 badge badge-success' href='Laporan/tugas/$tb->id_kelas'>Laporan Tugas
			</a>&nbsp;";

			$data_absen = "<a class='mt-2 badge badge-light' href='Laporan/absensi/$tb->id_kelas'>Laporan Absensi
			</a>&nbsp;";

			$td[] = "<center><div class='btn-group'>$data_tugas $data_absen</a></center>";
			$td[] = $tb->nama_kelas .' '. $tb->nama_kejuruan;

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

	/*View Laporan Tugas*/
	public function tugas($id_kelas)
	{
		/*Title*/
		$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
		$data['title']			= 'Laporan Tugas Murid '.$pengaturan->nama_sekolah;

		/*id_kelas*/
		$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
		$where				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_jadpel','jadpel_kelas=id_kelas', 'left')->get()->row();
		$data['head'] 		= $head;
		$data['where'] 		= $where;

		if(staffdata('role') == '3') {
			$id_staff 			= staffdata('id_staff');
			$kondisi			= $this->db->select('*')->from('data_jadpel')->where('pengajar', $id_staff)->where('jadpel_kelas', $id_kelas)->get()->row();

			if ($kondisi !== null) {
				$this->load->view('template_staff/header', $data);
				$this->load->view('template_staff/navbar');
				$this->load->view('template_staff/sidebar');
				$this->load->view('staff/laporan/tugas');
				$this->load->view('template_staff/footer');
			} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }

} else {
	$this->load->view('template_staff/header', $data);
	$this->load->view('template_staff/navbar');
	$this->load->view('template_staff/sidebar');
	$this->load->view('staff/laporan/tugas');
	$this->load->view('template_staff/footer');
}
}

/*Table Laporan Tugas*/
public function table_laporan_tugas()
{
	$waktu 			= $this->input->post('waktu');
	$mapel 			= $this->input->post('mapel');
	$jadpel 		= $this->input->post('jadpel');
	$id_kelas 		= $this->input->post('id_kelas');
	$data['waktu'] 	= $waktu;

	$get_table = $this->laporan->get_table($jadpel,$mapel);
	$data['data'] 	= $get_table;

	$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
	$data['head'] 		= $head;

	$this->load->view('staff/laporan/table_laporan_tugas', $data, FALSE);
}

/*Table Tugas Excel*/
public function table_tugas_excel() 
{
	$waktu      = $this->input->post('waktu');
	$mapel      = $this->input->post('mapel');
	$jadpel     = $this->input->post('jadpel');
	$id_kelas 	= $this->input->post('id_kelas');
	$datetime   = date('Y-m-d');
	$data['waktu'] = $waktu;

    // Assuming $this->laporan->get_table($jadpel,$mapel) retrieves the data to export
	$get_table = $this->laporan->get_table($jadpel, $mapel);
	$data['data'] = $get_table;

	$filename = "Laporan Tugas {$datetime}";
	$data['filename'] = $filename;

	$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
	$data['head'] 		= $head;

    // Set the appropriate headers for Excel export
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
	header('Cache-Control: max-age=0');

    // Load the view to generate the Excel file
	$this->load->view('staff/laporan/table_laporan_tugas', $data, FALSE);
}

/*View Laporan Absensi*/
public function absensi($id_kelas)
{
	/*Title*/
	$pengaturan				= $this->db->select('*')->from('pengaturan')->get()->row();
	$data['title']			= 'Laporan Absensi Murid '.$pengaturan->nama_sekolah;

	/*id_kelas*/
	$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
	$where				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->join('data_jadpel','jadpel_kelas=id_kelas', 'left')->get()->row();
	$data['head'] 		= $head;
	$data['where'] 		= $where;

	if(staffdata('role') == '3') {
		$id_staff 			= staffdata('id_staff');
		$kondisi			= $this->db->select('*')->from('data_jadpel')->where('pengajar', $id_staff)->where('jadpel_kelas', $id_kelas)->get()->row();

		if ($kondisi !== null) {
			$this->load->view('template_staff/header', $data);
			$this->load->view('template_staff/navbar');
			$this->load->view('template_staff/sidebar');
			$this->load->view('staff/laporan/absensi');
			$this->load->view('template_staff/footer');
		} else {
        redirect('dashboard_staff'); // Mengalihkan ke halaman dashboard_staff jika id_staff tidak sesuai dengan pengajar
    }

} else {
	$this->load->view('template_staff/header', $data);
	$this->load->view('template_staff/navbar');
	$this->load->view('template_staff/sidebar');
	$this->load->view('staff/laporan/absensi');
	$this->load->view('template_staff/footer');
}	
}

/*Table Laporan Absensi*/
public function table_laporan_absensi()
{
	$waktu 			= $this->input->post('waktu');
	$mapel 			= $this->input->post('mapel');
	$jadpel 		= $this->input->post('jadpel');
	$id_kelas 		= $this->input->post('id_kelas');
	$data['waktu'] 	= $waktu;

	$get_table = $this->laporan->get_table_absensi($jadpel,$mapel);
	$data['data'] 	= $get_table;

	$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
	$data['head'] 		= $head;

	$this->load->view('staff/laporan/table_laporan_absensi', $data, FALSE);
}

/*Table Absensi Excel*/
public function table_absensi_excel()
{
	$waktu      = $this->input->post('waktu');
	$mapel      = $this->input->post('mapel');
	$jadpel     = $this->input->post('jadpel');
	$id_kelas 	= $this->input->post('id_kelas');
	$datetime   = date('Y-m-d');
	$data['waktu'] = $waktu;

    // Assuming $this->laporan->get_table($jadpel,$mapel) retrieves the data to export
	$get_table = $this->laporan->get_table_absensi($jadpel,$mapel);
	$data['data'] 	= $get_table;

	$filename = "Laporan Absensi {$datetime}";
	$data['filename'] = $filename;

	$head				= $this->db->select('*')->from('data_kelas')->where('id_kelas', $id_kelas)->join('data_kejuruan','id_kejuruan=kejuruan')->get()->row();
	$data['head'] 		= $head;

    // Set the appropriate headers for Excel export
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
	header('Cache-Control: max-age=0');

    // Load the view to generate the Excel file
	$this->load->view('staff/laporan/table_laporan_absensi', $data, FALSE);
}


}