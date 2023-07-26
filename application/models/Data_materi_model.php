<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_materi_model extends CI_Model
{

	public function table_data_materi($id_mapel,$id_kelas)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_materi LIKE ' . "'%" . $search . "%'" . '
			OR
			des_materi LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_materi LIKE ' . "'%" . $search . "%'" . '  
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
		$this->db->from('data_materi');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_materi');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('tgl_materi', 'DESC');
		$batas;
		return $this->db->get()->result();
		
	}

	public function filter_table_data_materi($id_mapel,$id_kelas)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_materi LIKE ' . "'%" . $search . "%'" . '
			OR
			des_materi LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_materi LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_materi');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_materi');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('tgl_materi', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_materi($id_mapel,$id_kelas)
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_materi LIKE ' . "'%" . $search . "%'" . '
			OR
			des_materi LIKE ' . "'%" . $search . "%'" . '  
			OR
			tgl_materi LIKE ' . "'%" . $search . "%'" . '  
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_materi');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_materi');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->join('data_kelas','id_kelas=jadpel_kelas');
		$this->db->join('data_kejuruan','id_kejuruan=kejuruan');
		$this->db->join('data_hari','id_hari=hari');
		$this->db->join('data_staff','id_staff=pengajar');
		$this->db->where('jadpel_mapel', $id_mapel);
		$this->db->where('jadpel_kelas', $id_kelas);
		$this->db->order_by('tgl_materi', 'DESC');
		return $this->db->get()->num_rows();

	}

}