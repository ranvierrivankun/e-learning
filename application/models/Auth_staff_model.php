<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_staff_model extends CI_Model
{
	/*cek nik*/
	public function cek_nik($nik)
	{
		$query = $this->db->get_where('data_staff', ['nik' => $nik]);
		return $query->num_rows();
	}

	/*get password staff*/
	public function get_password($nik)
	{
		$data = $this->db->get_where('data_staff', ['nik' => $nik])->row_array();
		return $data['password'];
	}

	/*get userdata*/
	public function userdata($nik)
	{
		return $this->db->get_where('data_staff', ['nik' => $nik])->row_array();
	}
}