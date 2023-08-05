<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Select_model', 'select');
	}

	/*View Select*/
	public function index()
	{
		echo "RANVIER";
	}

	/*Select Kejuruan*/
	public function kejuruan()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->kejuruan($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Role*/
	public function role()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->role($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Kelas*/
	public function kelas()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->kelas($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Mapel*/
	public function mapel()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->mapel($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Hari*/
	public function hari()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->hari($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Guru*/
	public function guru()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->select->guru($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*Select Mapel Laporan*/
	public function mapel_laporan()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$id_kelas 		= $this->input->post('id_kelas');
		$id_jadpel 		= $this->input->post('id_jadpel');
		$response 		= $this->select->mapel_laporan($searchTerm, $id_kelas, $id_jadpel);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

}
