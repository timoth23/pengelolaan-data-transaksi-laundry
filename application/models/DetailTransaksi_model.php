<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailTransaksi_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllDetailTransaksi()
	{
		$this->db->select('*');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		return $this->db->get('detail_transaksi')->result_array();
	}


	public function getDetailTransaksi()
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		return $this->db->get('detail_transaksi')->row_array();
	}


	public function getTransaksiProses()
	{
		$this->db->select('*');
		$this->db->order_by('transaksi.tanggal_transaksi', 'desc');
		$this->db->where('transaksi.status_transaksi', 'proses');
		return $this->db->get('transaksi')->result_array();
	}

	public function getTransaksiById($id)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
	}
	
	public function getPaketById($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		$this->db->order_by('paket.id_paket', 'asc');
		return $this->db->get('detail_transaksi')->result_array();
	}

	public function getAllPaketReguler()
	{
		$this->db->select('*');
		$this->db->where('layanan','Reguler');
		return $this->db->get('paket')->result_array();
	}
	public function getAllPaketEkspress()
	{
		$this->db->select('*');
		$this->db->where('layanan','Ekspress');
		return $this->db->get('paket')->result_array();

	}

	public function getDetailTransaksiById($id)
	{
		$this->db->select('*');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		return $this->db->get_where('detail_transaksi', ['detail_transaksi.id_detail_transaksi' => $id])->row_array();
	}

	public function createDetailTransaksi()
	{
	
		$id_transaksi = $this->input->post('id_transaksi', true);
		$id_paket = $this->input->post('id_paket', true);
		$kuantitas = $this->input->post('kuantitas', true);
		$keterangan = $this->input->post('keterangan', true);
		$biaya_tambahan = $this->input->post('biaya_tambahan', true);
		$transaksi = $this->getTransaksiById($id_transaksi);

		$query_tambah_detail_transaksi = "INSERT INTO detail_transaksi (id_transaksi, id_paket, kuantitas, keterangan, biaya_tambahan) VALUES ";

		for ($i = 0; $i < count($id_paket); $i++) {
			if ($kuantitas[$i] != '') {
				$query_tambah_detail_transaksi .= "('{$id_transaksi}', '{$id_paket[$i]}', '{$kuantitas[$i]}', '{$keterangan[$i]}', '{$biaya_tambahan[$i]}')";
				$query_tambah_detail_transaksi .= ",";
			}
		}
	
		$query_tambah_detail_transaksi = rtrim($query_tambah_detail_transaksi, ",");
	
		$this->db->query($query_tambah_detail_transaksi);
		$this->session->set_flashdata('message-success', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil ditambahkan');
		if ($this->session->userdata('status_bayar')) {
			$this->session->unset_userdata('kode_invoice');
			$this->session->set_userdata(['id_transaksi' => $id_transaksi]);
			redirect('transaksi/pembayaranTransaksi');
		} else {
			// meng unset session
			$this->session->unset_userdata('kode_invoice');
			$this->session->unset_userdata('status_bayar');
			redirect('detailTransaksi/index/' . $id_transaksi);
		}
		

	}
	
	public function updateDetailTransaksi($id)
	{
		$id_transaksi = $this->input->post('id_transaksi', true);
		$id_detail_transaksi = $this->input->post('id_detail_transaksi', true);
		$id_paket = $this->input->post('id_paket', true);
		$kuantitas = $this->input->post('kuantitas', true);
		$keterangan = $this->input->post('keterangan', true);
		$biaya_tambahan = $this->input->post('biaya_tambahan', true);
		$transaksi = $this->getTransaksiById($id_transaksi);

		for ($i=0; $i < count($id_paket); $i++) { 
			$idPaket 	= $id_paket[$i];
			$idDetail 	= $id_detail_transaksi[$i];
			$qty 		= $kuantitas[$i];
			$ket 		= $keterangan[$i];
			$bt         = $biaya_tambahan[$i];
			if ($qty > 0) {
				$cek 	= $this->db->get_where('detail_transaksi',["id_detail_transaksi" => $idDetail]);
				if ($cek->num_rows() > 0) {
					$data = [
						'id_paket' => $idPaket,
						'kuantitas' => $qty,
						'keterangan' => $ket,
						'biaya_tambahan' => $bt, 
						'id_transaksi' => $id_transaksi
					];
					$this->db->where('id_detail_transaksi', $idDetail);
					$this->db->update('detail_transaksi', $data);
				}else{
					$data = [
						'id_paket' => $idPaket,
						'kuantitas' => $qty,
						'keterangan' => $ket,
						'biaya_tambahan' => $bt, 
						'id_transaksi' => $id_transaksi
					];
					$this->db->insert('detail_transaksi', $data);
				}
			}else{
				$cek 	= $this->db->get_where('detail_transaksi',["id_detail_transaksi" => $idDetail]);
				if ($cek->num_rows() > 0) {
					$this->db->where('id_detail_transaksi', $idDetail);
					$this->db->delete('detail_transaksi');
				}
			}
		}

		$this->session->set_flashdata('message-success', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil dimanipulasi');
	
		redirect('detailTransaksi/index/' . $id_transaksi);
	}
	public function getKodeInvoiceById($id_transaksi)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
	}

	public function getDetailTransaksiByIdTransaksi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		return $this->db->get('detail_transaksi')->row_array();
	}		

	
}