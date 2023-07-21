<?php

function cek_login_siswa()
{
	$ci = get_instance();
	if (!$ci->session->has_userdata('login_session')) {
		set_pesan('Silahkan Login', false);
		redirect('auth');
	}
}

function cek_login_staff()
{
	$ci = get_instance();
	if (!$ci->session->has_userdata('staff_login_session')) {
		set_pesan('Silahkan Login', false);
		redirect('auth_staff');
	}
}

function admin()
{
	if (staffdata('role') == "1") {
		return;
	} else {
		redirect('dashboard_staff');
	}
}

function admin_staff()
{
	if (staffdata('role') == "1") {
		return;
	} else 	if (staffdata('role') == "2") {
		return;
	} else {
		redirect('dashboard_staff');
	}
}

function userdata($field)
{
	$ci = get_instance();
	$ci->load->model('M_builder', 'bd');
	$id_siswa = $ci->session->userdata('login_session')['user'];
	return $ci->bd->get('data_siswa', ['id_siswa' => $id_siswa])[$field];
}

function staffdata($field)
{
	$ci = get_instance();
	$ci->load->model('M_builder', 'bd');
	$id_staff = $ci->session->userdata('staff_login_session')['user'];
	return $ci->bd->get('data_staff', ['id_staff' => $id_staff])[$field];
}

function set_pesan($pesan, $tipe = true)
{
	$ci = get_instance();
	if ($tipe) {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-success'><strong>SUCCESS!&nbsp;</strong> {$pesan} <button type='button' class='close float-end pl-3' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	} else {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!&nbsp;</strong> {$pesan} <button type='button' class='close float-end pl-3' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	}
}