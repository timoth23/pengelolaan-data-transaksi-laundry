<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllUser()
	{
		$this->db->select('*');
		return $this->db->get('user')->result_array();
	}

	public function getUserByUsername($username)
	{
		$this->db->select('*');
		$this->db->join('biodata', 'biodata.id_user = user.id_user');
		return $this->db->get_where('user', ['user.username' => $username])->row_array();
	}

	public function getUserByUsernameNoJoin($username)
	{
		return $this->db->get_where('user', ['user.username' => $username])->row_array();
	}

	public function getUserById($id)
	{
    $this->db->select('id_user, username, password'); // Include the 'password' column
    return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

	public function getUserByIdAllData($id)
	{
		$this->db->select('*');
		$this->db->join('biodata', 'biodata.id_user = user.id_user');
		return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

	public function createUser()
	{
		$data = [
			'username' => $this->input->post('username', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
		];
		$this->db->insert('user', $data);
		$this->session->set_flashdata('message-success', 'Data Admin ' . $data['username'] . ' berhasil ditambahkan');
		redirect('user/createBiodata/' . $data['username']);
	}

	public function createBiodata()
	{
		$this->db->set('foto', 'default.png');

		$foto = $_FILES['foto']['name'];
		if ($foto) {
			$config['upload_path'] = './assets/img/img_profiles/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('foto')) {
				$new_foto = $this->upload->data('file_name');
				$this->db->set('foto', $new_foto);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap', true),
			'telepon' => $this->input->post('telepon', true),
			'email' => $this->input->post('email', true),
			'alamat' => $this->input->post('alamat', true),
			'id_user' => $this->input->post('id_user', true)
		];

		$this->db->insert('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata Admin ' . $data['nama_lengkap'] . ' berhasil ditambahkan');
		redirect('user');
	}


	public function deleteUser($id)
	{
		$user = $this->getUserById($id);
		$this->db->delete('user', ['id_user' => $id]);
		$this->session->set_flashdata('message-success', 'Data Admin ' . $user['username'] . ' berhasil dihapus');
		redirect('user');
	}


}
