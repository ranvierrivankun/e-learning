<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_mapel_model extends CI_Model
{

	public function table_data_mapel()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_mapel LIKE ' . "'%" . $search . "%'" . ' 
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
		$this->db->from('data_mapel');
		$this->db->order_by('id_mapel', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_mapel()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_mapel LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_mapel');
		$this->db->order_by('id_mapel', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_mapel()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_mapel LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_mapel');
		$this->db->order_by('id_mapel', 'DESC');
		return $this->db->get()->num_rows();

	}

}