<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	public function check_status_login()
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}
		// jika sedang menginputkan transaksi, paksa ke halaman tambah transaski
		if ($this->session->userdata('kode_invoice')) {
			redirect('transaksi/tambahTransaksi');
		}elseif ($this->session->userdata('status_bayar')) {
			redirect('transaksi/pembayaranTransaksi');
		}
	}

	public function id_user()
	{
		return $this->session->userdata('id_user');
	}


	public function getDataUser()
	{
		$id_user = $this->session->userdata('id_user');
		$this->db->select('*');
		$this->db->join('biodata', 'user.id_user = biodata.id_user');
		return $this->db->get_where('user', ['user.id_user' => $id_user])->row_array();
	}

	public function updateBiodata()
	{
	
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
		];
		$dataUser = $this->mm->getDataUser();
		$id_user = $this->input->post('id_user', true);
		$this->db->where('biodata.id_user', $id_user);
		$this->db->update('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata Pengguna ' . $dataUser['username'] . ' berhasil diubah');
		redirect('main/profile');
	}


	public function changePassword()
	{
		$dataUser = $this->mm->getDataUser();
		$password_old = $this->input->post('password_old', true);
		$password_new = $this->input->post('password_new', true);
		if (password_verify($password_old, $dataUser['password'])) {
			$password_hash = password_hash($password_new, PASSWORD_DEFAULT);
			$data = ['password' => $password_hash];
			
			$this->db->where('user.id_user', $this->mm->id_user());
			$this->db->update('user', $data);
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Password');
			redirect('main/profile');
		} else {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' gagal mengubah Password! Password tidak sesuai dengan password lama');
			redirect('main/profile');
			return false;
		}
	}


	public function createBiodata()
	{
		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap', true),
			'telepon' => $this->input->post('telepon', true),
			'email' => $this->input->post('email', true),
			'alamat' => $this->input->post('alamat', true),
			'foto' => $this->input->post('foto', true),
			'id_user' => $this->id_user()
		];
		$this->db->insert('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata berhasil ditambahkan');
		redirect('main/biodata');
	}

}