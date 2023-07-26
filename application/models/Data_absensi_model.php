<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_absensi_model extends CI_Model
{

	public function table_data_absensi($id_absen)
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
		$this->db->join('data_absen_murid','user_absen_murid=id_siswa');
		$this->db->where('absen', $id_absen);
		$this->db->group_by('id_siswa'); 
		$this->db->order_by('id_siswa', 'ASC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_absensi($id_absen)
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
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('data_absen_murid','user_absen_murid=id_siswa');
		$this->db->where('absen', $id_absen);
		$this->db->group_by('id_siswa'); 
		$this->db->order_by('id_siswa', 'ASC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_absensi($id_absen)
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nisn LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_siswa LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('data_absen_murid','user_absen_murid=id_siswa');
		$this->db->where('absen', $id_absen);
		$this->db->group_by('id_siswa'); 
		$this->db->order_by('id_siswa', 'ASC');
		return $this->db->get()->num_rows();

	}

}