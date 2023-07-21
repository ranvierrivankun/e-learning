<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_siswa_model extends CI_Model
{

	public function table_data_siswa()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nisn LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			email_siswa LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($awal == -1){
			$batas = "";
		}else{
			$batas = $this->db->limit($awal, $akhir);
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('data_kelas','id_kelas=kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->order_by('id_siswa', 'ASC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_siswa()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nisn LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			email_siswa LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('data_kelas','id_kelas=kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->order_by('id_siswa', 'ASC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_siswa()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nisn LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			email_siswa LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('data_kelas','id_kelas=kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->order_by('id_siswa', 'ASC');
		return $this->db->get()->num_rows();

	}

}