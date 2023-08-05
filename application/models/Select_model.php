<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Select_model extends CI_Model
{

	public function kejuruan($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_kejuruan');
		$this->db->where("nama_kejuruan like '%".$searchTerm."%' ");
		$this->db->order_by('id_kejuruan', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kejuruan'], "text"=>$q['nama_kejuruan']);
		}
		return $data;
	}

	public function role($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_role');
		$this->db->where("nama_role like '%".$searchTerm."%' ");
		$this->db->order_by('id_role', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_role'], "text"=>$q['nama_role']);
		}
		return $data;
	}

	public function kelas($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_kelas');
		$this->db->join('data_kejuruan', 'id_kejuruan=kejuruan');
		$this->db->where("nama_kejuruan like '%".$searchTerm."%' ");
		$this->db->or_where("nama_kelas like '%".$searchTerm."%' ");
		$this->db->order_by('id_kelas', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kelas'], "text"=>$q['nama_kelas'].' - '.$q['nama_kejuruan']);
		}
		return $data;
	}

	public function mapel($searchTerm)
	{

		$this->db->select('*');
		$this->db->from('data_mapel');
		$this->db->where("nama_mapel like '%".$searchTerm."%' ");
		$this->db->order_by('nama_mapel', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_mapel'], "text"=>$q['nama_mapel']);
		}
		return $data;
	}

	public function hari($searchTerm)
	{

		$this->db->select('*');
		$this->db->from('data_hari');
		$this->db->where("nama_hari like '%".$searchTerm."%' ");
		$this->db->order_by('id_hari', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_hari'], "text"=>$q['nama_hari']);
		}
		return $data;
	}

	public function guru($searchTerm)
	{

		$this->db->select('*');
		$this->db->from('data_staff');
		$this->db->join('data_role', 'id_role=role');
		$this->db->where("nama_staff or nama_role like '%".$searchTerm."%' ");
		$this->db->where('status_staff', 'aktif');
		$this->db->where_in('role', array('2','3'));
		$this->db->order_by('id_staff', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_staff'], "text"=>$q['nama_staff'].' - '.$q['nama_role']);
		}
		return $data;
	}

	public function mapel_laporan($searchTerm, $id_kelas)
	{
		if(staffdata('role') == '3') {
			$id_staff = staffdata('id_staff');
			$guru = $this->db->where('pengajar', $id_staff);
		}

		$this->db->select('*');
		$this->db->from('data_mapel');
		$this->db->join('data_jadpel', 'jadpel_mapel=id_mapel');
		$this->db->where("nama_mapel like '%".$searchTerm."%' ");
		$guru;
		$this->db->where_in('jadpel_kelas', $id_kelas);
		$this->db->order_by('nama_mapel', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_mapel'], "text"=>$q['nama_mapel']);
		}
		return $data;
	}

}