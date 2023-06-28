<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllPaket()
	{
		$this->db->select('*');
		return $this->db->get('paket')->result_array();
	}


	public function getPaketById($id)
	{
		$this->db->select('*');
		return $this->db->get_where('paket', ['paket.id_paket' => $id])->row_array();
	}

	public function createPaket()
	{
		$data = [
			'nama_paket' => $this->input->post('nama_paket', true),
			'harga_paket' => $this->input->post('harga_paket', true),
			'satuan' => $this->input->post('satuan', true),
			'layanan' => $this->input->post('layanan', true),
		];

		$this->db->insert('paket', $data);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['nama_paket'] . ' berhasil ditambahkan');
		redirect('paket');
	}

	public function updatePaket($id)
	{
		$data = [
			'nama_paket' => $this->input->post('nama_paket', true),
			'harga_paket' => $this->input->post('harga_paket', true),
			'satuan' => $this->input->post('satuan', true),
			'layanan' => $this->input->post('layanan', true),
		];
		
		$this->db->where('paket.id_paket', $id);
		$this->db->update('paket', $data);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['nama_paket'] . ' berhasil diubah');
		redirect('paket');
	}

	public function deletePaket($id)
	{
		$data['paket'] = $this->getPaketById($id);
		$this->db->delete('paket', ['id_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['paket']['nama_paket'] . ' berhasil dihapus');
		redirect('paket');
	}

}