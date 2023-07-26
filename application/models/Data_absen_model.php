<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_absen_model extends CI_Model
{

	public function table_data_absen($id_mapel,$id_kelas)
	{
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
		$this->db->from('data_absen');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_absen');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('id_absen', 'ASC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_absen($id_mapel,$id_kelas)
	{
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
		$this->db->from('data_absen');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_absen');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('id_absen', 'ASC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_absen($id_mapel,$id_kelas)
	{
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
		$this->db->from('data_absen');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_absen');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('id_absen', 'ASC');
		return $this->db->get()->num_rows();

	}

}