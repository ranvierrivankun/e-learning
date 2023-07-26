<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_absen_murid_model extends CI_Model
{

	public function table_data_absen($id_mapel)
	{
		$id_siswa	= userdata('id_siswa');

		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_absen LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_absen LIKE ' . "'%" . $search . "%'" . '  
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
		$this->db->from('data_absen_murid');
		$this->db->join('data_absen','id_absen=absen');
		$this->db->where('user_absen_murid', $id_siswa);
		$this->db->where('mapel_absen_murid', $id_mapel);
		$this->db->order_by('id_absen', 'ASC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_absen($id_mapel)
	{
		$id_siswa	= userdata('id_siswa');

		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_absen LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_absen LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_absen_murid');
		$this->db->join('data_absen','id_absen=absen');
		$this->db->where('user_absen_murid', $id_siswa);
		$this->db->where('mapel_absen_murid', $id_mapel);
		$this->db->order_by('id_absen', 'ASC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_absen($id_mapel)
	{
		$id_siswa	= userdata('id_siswa');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_absen LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_absen LIKE ' . "'%" . $search . "%'" . '    
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_absen_murid');
		$this->db->join('data_absen','id_absen=absen');
		$this->db->where('user_absen_murid', $id_siswa);
		$this->db->where('mapel_absen_murid', $id_mapel);
		$this->db->order_by('id_absen', 'ASC');
		return $this->db->get()->num_rows();

	}

}