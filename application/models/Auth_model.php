<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	/*cek nisn*/
	public function cek_nisn($nisn)
	{
		$query = $this->db->get_where('data_siswa', ['nisn' => $nisn]);
		return $query->num_rows();
	}

	/*get password siswa*/
	public function get_password($nisn)
	{
		$data = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row_array();
		return $data['password'];
	}

	/*get userdata*/
	public function userdata($nisn)
	{
		return $this->db->get_where('data_siswa', ['nisn' => $nisn])->row_array();
	}
}