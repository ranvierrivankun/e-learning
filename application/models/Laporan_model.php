<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
	public function get_table($jadpel,$mapel)
	{
		$this->db->select('*');
		$this->db->from('data_tugas_selesai');
		$this->db->join('data_tugas','id_tugas=tugas');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_tugas');
		$this->db->join('data_siswa','id_siswa=user_tugas_selesai');
		$this->db->join('data_staff','id_staff=pengajar_tugas_selesai');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->where('jadpel_mapel', $mapel);
		$this->db->where_in('status_tugas_selesai', 'nilai');
		$this->db->order_by('id_tugas_selesai', 'desc');

		return $this->db->get()->result();
	}

	public function get_table_absensi($jadpel,$mapel)
	{
		$this->db->select('*');
		$this->db->from('data_absen_murid');
		$this->db->join('data_absen','id_absen=absen');
		$this->db->join('data_jadpel','id_jadpel=id_jadpel_absen');
		$this->db->join('data_siswa','id_siswa=user_absen_murid');
		$this->db->join('data_staff','id_staff=user_absen');
		$this->db->join('data_mapel','id_mapel=jadpel_mapel');
		$this->db->where('jadpel_mapel', $mapel);
		$this->db->order_by('id_absen_murid', 'desc');

		return $this->db->get()->result();
	}
}