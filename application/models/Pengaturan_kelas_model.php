<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_kelas_model extends CI_Model
{

	public function table_data_kejuruan()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
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
		$this->db->from('data_kejuruan');
		$this->db->order_by('id_kejuruan', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_kejuruan()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kejuruan');
		$this->db->order_by('id_kejuruan', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_kejuruan()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kejuruan');
		$this->db->order_by('id_kejuruan', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function table_data_kelas()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_kelas LIKE ' . "'%" . $search . "%'" . ' 
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
		$this->db->from('data_kelas');
		$this->db->join('data_kejuruan', 'id_kejuruan=kejuruan');
		$this->db->order_by('kejuruan', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_kelas()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_kelas LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kelas');
		$this->db->join('data_kejuruan', 'id_kejuruan=kejuruan');
		$this->db->order_by('kejuruan', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_kelas()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kejuruan LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_kelas LIKE ' . "'%" . $search . "%'" . ' 
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kelas');
		$this->db->join('data_kejuruan', 'id_kejuruan=kejuruan');
		$this->db->order_by('kejuruan', 'DESC');
		return $this->db->get()->num_rows();

	}
	
}