<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'um');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['title'] = 'Kelola Admin - Ester Laundry ';
		$data['user'] = $this->um->getAllUser();
		$data['dataUser'] = $this->mm->getDataUser();
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createUser()
	{
		$this->mm->check_status_login();

		$data['dataUser'] = $this->mm->getDataUser();
		$data['user'] = $this->um->getAllUser();
		$data['title'] = 'Daftar Admin ' . $data['dataUser']['username'];
		$this->form_validation->set_rules('username', 'Nama Admin', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Nama Admin sudah terdaftar!'
		]);
		$this->form_validation->set_rules('password', 'Kata Sandi', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Verifikasi Kata Sandi', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->um->createUser();
		}
	}

	public function deleteUser($id)
	{
		$this->mm->check_status_login();
		$this->um->deleteUser($id);
	}

	public function createBiodata($username)
	{
		$this->mm->check_status_login();
		$getUserByUsername = $this->um->getUserByUsername($username);
		$getUserByUsernameNoJoin = $this->um->getUserByUsernameNoJoin($username);

		if ($getUserByUsername) {
			$this->session->set_flashdata('message-failed', 'Admin' . $getUserByUsername['username'] . ' sudah memiliki biodata');
			redirect('user');
		}
		$id_user = $getUserByUsernameNoJoin['id_user'];
		$data['dataUser'] = $this->mm->getDataUser();
		$data['userBiodata'] = $this->um->getUserById($id_user);
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$data['title'] = 'Isi Biodata - ' . $username;

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('user/createBiodata', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->um->createBiodata();
		}
	}

	public function profile($id)
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['dataAdmin'] = $this->um->getUserById($id);
		$data['userProfile'] = $this->um->getUserByIdAllData($id);
		if(isset($data['userProfile']) && is_array($data['userProfile'])){
		$data['title'] = ucwords('Profile - ') . $data['userProfile']['username'];
		} else {
		$data['title'] = ucwords('Data Profile Kosong ') ;
		}		
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer', $data);
		
	}
	public function showEncryptedPasswords()
{
    $encryptedPasswords = $this->Your_model->getEncryptedPasswords();
    foreach ($encryptedPasswords as $password) {
        echo "Encrypted Password: " . $password->password . "<br>";
    }
}

}