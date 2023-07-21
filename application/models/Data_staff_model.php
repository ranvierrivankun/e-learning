<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_staff_model extends CI_Model
{

	public function table_data_staff()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nik LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			email_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_staff LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_staff');
		$this->db->join('data_role','id_role=role');
		$this->db->order_by('role', 'ASC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_staff()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nik LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			email_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_staff LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_staff');
		$this->db->join('data_role','id_role=role');
		$this->db->order_by('role', 'ASC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_staff()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nik LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			email_staff LIKE ' . "'%" . $search . "%'" . '
			OR
			notelp_staff LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_staff');
		$this->db->join('data_role','id_role=role');
		$this->db->order_by('role', 'ASC');
		return $this->db->get()->num_rows();

	}

}