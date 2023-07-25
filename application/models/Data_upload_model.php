<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_upload_model extends CI_Model
{

	public function table_data_upload($id_tugas)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_tugas_selesai LIKE ' . "'%" . $search . "%'" . '  
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
		$this->db->from('data_tugas_selesai');
		$this->db->join('data_tugas','id_tugas=tugas');
		$this->db->join('data_siswa','id_siswa=user_tugas_selesai');
		$this->db->where('tugas', $id_tugas);
		$this->db->order_by('tgl_tugas_selesai', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_upload($id_tugas)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_tugas_selesai LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_tugas_selesai');
		$this->db->join('data_tugas','id_tugas=tugas');
		$this->db->join('data_siswa','id_siswa=user_tugas_selesai');
		$this->db->where('tugas', $id_tugas);
		$this->db->order_by('tgl_tugas_selesai', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_upload($id_tugas)
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_siswa LIKE ' . "'%" . $search . "%'" . '
			OR
			tgl_tugas_selesai LIKE ' . "'%" . $search . "%'" . '    
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_tugas_selesai');
		$this->db->join('data_tugas','id_tugas=tugas');
		$this->db->join('data_siswa','id_siswa=user_tugas_selesai');
		$this->db->where('tugas', $id_tugas);
		$this->db->order_by('tgl_tugas_selesai', 'DESC');
		return $this->db->get()->num_rows();

	}

}