<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_builder extends CI_Model {

	public function get($table, $data = null, $where = null)
	{
		if ($data != null) {
			return $this->db->get_where($table, $data)->row_array();
		} else {
			return $this->db->get_where($table, $where)->result_array();
		}
	}

	public function where($table, $field, $id)
	{
		$proses = $this->db->select('*')->from($table)->where($field, $id)->get();
		return $proses;
	}

	public function all($table, $order, $sort)
	{
		$proses = $this->db->select('*')->from($table)->order_by($order, $sort)->get();
		return $proses;
	}

	public function save($table, $object)
	{
		$this->db->insert($table, $object);
	}

	public function delete($table, $field, $id)
	{
		$this->db->where($field, $id);
		return $this->db->delete($table);
	}

	public function edit($table, $field, $id)
	{
		$proses = $this->db->select('*')->from($table)->where($field, $id)->get();
		return $proses;
	}

	public function update($table, $object, $field, $id)
	{
		$this->db->where($field, $id);
		$this->db->update($table, $object);
	}

	public function detail($table, $field, $id)
	{
		$proses = $this->db->select('*')->from($table)->where($field, $id)->get();
		return $proses;
	}

	public function total($table, $id)
	{
		$proses = $this->db->select($id)->from($table)->get();
		return $proses->num_rows();
	}

}