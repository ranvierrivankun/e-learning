<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_tugas_model extends CI_Model
{

	public function table_data_tugas()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_tugas LIKE ' . "'%" . $search . "%'" . '
			OR
			des_tugas LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_tugas LIKE ' . "'%" . $search . "%'" . '  
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
		$this->db->from('data_tugas');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_tugas');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->order_by('tgl_tugas', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_tugas()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_tugas LIKE ' . "'%" . $search . "%'" . '
			OR
			des_tugas LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_tugas LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_tugas');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_tugas');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->order_by('tgl_tugas', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_tugas()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_tugas LIKE ' . "'%" . $search . "%'" . '
			OR
			des_tugas LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_tugas LIKE ' . "'%" . $search . "%'" . '    
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_tugas');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_tugas');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->order_by('tgl_tugas', 'DESC');
		return $this->db->get()->num_rows();

	}

}