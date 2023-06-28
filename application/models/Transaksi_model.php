<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllTransaksi($status_transaksi = '')
	{
		$this->db->select('*');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		// mengganti %20 menjadi spasi
		$status_transaksi = explode("%20", $status_transaksi);
		$status_transaksi = implode(" ", $status_transaksi);
		if ($status_transaksi !== '') {
			$this->db->where('transaksi.status_transaksi', $status_transaksi);
		}
		$this->db->order_by('tanggal_transaksi', 'desc');
		return $this->db->get('transaksi')->result_array();
	}

	public function getJumlahStatusTransaksi($status_transaksi)
	{
		if ($status_transaksi == 'semua') {
			$query = "SELECT *, (SELECT count('transaksi.status_transaksi') FROM transaksi) AS '$status_transaksi' FROM transaksi 
				INNER JOIN user ON transaksi.id_user = user.id_user
				ORDER BY transaksi.tanggal_transaksi DESC
			";
		} else {
			$query = "SELECT *, (SELECT count('transaksi.status_transaksi') FROM transaksi WHERE transaksi.status_transaksi = '$status_transaksi') AS '$status_transaksi' FROM transaksi 
				INNER JOIN user ON transaksi.id_user = user.id_user
				WHERE transaksi.status_transaksi = '$status_transaksi'
				ORDER BY transaksi.tanggal_transaksi DESC
			";
		}
		return $this->db->query($query);
	}


	public function getTransaksiById($id)
	{
		$this->db->select('*');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		return $this->db->get_where('transaksi', ['transaksi.id_transaksi' => $id])->row_array();
	}

	public function getDetailTransaksiById($id)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		return $this->db->get_where('detail_transaksi', ['detail_transaksi.id_transaksi' => $id])->result_array();
	}
	

	public function getTotalHarga($id_transaksi)
	{
		$sql = "SELECT *, (SELECT sum(paket.harga_paket * detail_transaksi.kuantitas+ detail_transaksi.biaya_tambahan) FROM detail_transaksi INNER JOIN paket ON detail_transaksi.id_paket = paket.id_paket INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = $id_transaksi) as total_harga FROM detail_transaksi INNER JOIN paket ON detail_transaksi.id_paket = paket.id_paket INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = $id_transaksi";
		return $this->db->query($sql)->row_array();
	}

	public function kodeInvoice($tgl_transaksi, $id_user, $table, $field, $initial)
	{
		// ambil kolom terakhir pada table
		$query = "SELECT max($field) AS field FROM transaksi";
		$last_id_transaksi = $this->db->query($query)->row_array();
		$data_transaksi = $this->getTransaksiById($last_id_transaksi['field']);
		// ambil tanggal
		$just_date = date('dmY', strtotime($tgl_transaksi));
		// ambil tanggal terakhir pada db
		$last_row_date = substr($data_transaksi['kode_invoice'], 0, 8);
		// jika tanggal tidak sama dengan tanggal sebelumnya, maka atur angka dari 000 kembali
		if ($just_date == $last_row_date) {
			$field = $data_transaksi['kode_invoice'];
		} else {
			// ambil bagian depan kode invoice sbg tanggal
			$field = $just_date . $id_user . 'T' . '0000';
		}
		// ambil id terakhir dari depan
		$substr = substr($field, -4);
		// Conversi menjadi int
		$conv = (int) $substr;
		// tambahkan increase pada kode
		$inc = $conv + 1;
		
		// membuat kode otomatis cth: 009, 010, 011 dan hasil akhir
		$result_code = $just_date . $id_user . $initial . str_pad($inc, 4, "0", STR_PAD_LEFT);
		return $result_code;
	}

	public function createTransaksi()
	{
		$dataUser = $this->mm->getDataUser();
		$tanggal_transaksi = date('Y-m-d H:i:s');
		$id_user = $dataUser['id_user'];
		$table = 'transaksi';
		$field = 'id_transaksi';
		$initial = 'T';
		$kode_invoice = $this->kodeInvoice($tanggal_transaksi, $id_user, $table, $field, $initial);

		$status_bayar = $this->input->post('status_bayar', true);
		
		if ($status_bayar == 'sudah dibayar') {
			$tanggal_bayar = date('Y-m-d H:i:s');
		} else {
			$tanggal_bayar = '0000-00-00 00:00:00';
		}

		$data = [
			'kode_invoice' => $kode_invoice,
			'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
			'no_hp_pelanggan' => $this->input->post('no_hp_pelanggan', true),
			'alamat_pelanggan' => $this->input->post('alamat_pelanggan', true),
			'tanggal_transaksi' => $tanggal_transaksi,
			'batas_waktu' => $this->input->post('batas_waktu', true),
			'tanggal_bayar' => $tanggal_bayar,
			'diskon' => $this->input->post('diskon', true),
			'pajak' => $this->input->post('pajak', true),
			'status_transaksi' => 'proses',
			'layanan' => $this->input->post('layanan', true),
			'id_user' => $id_user
		];

		$this->db->insert($table, $data);
		$this->session->set_flashdata('message-success', 'Transaksi ' . $data['kode_invoice'] . ' berhasil ditambahkan');
		// kirim status bayar jika sudah bayar
		if ($status_bayar == 'sudah dibayar') {
			$this->session->set_userdata(['status_bayar' => 'sudah dibayar']);
		}
		// kirim kode invoice
		$this->session->set_userdata(['kode_invoice' => $kode_invoice]);
		redirect('detailTransaksi/tambahDetailTransaksi/');
	}

	public function updateTransaksi($id)
	{
		// ambil data transaksi dari db
		$data['transaksi'] = $this->getTransaksiById($id);
		$id_transaksi = $data['transaksi']['id_transaksi'];
		$status_bayar = $this->input->post('status_bayar', true);

		if ($status_bayar == 'sudah dibayar') {
			$tanggal_bayar = date('Y-m-d H:i:s');
			if ($data['transaksi']['status_bayar'] == 'sudah dibayar') {
				$tanggal_bayar = $data['transaksi']['tanggal_bayar'];
			}
		} elseif ($status_bayar == 'belum dibayar') {
			$tanggal_bayar = '0000-00-00 00:00:00';
		} else {
			$tanggal_bayar = '0000-00-00 00:00:00';
		}

		$data = [
			'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
			'no_hp_pelanggan' => $this->input->post('no_hp_pelanggan', true),
			'alamat_pelanggan' => $this->input->post('alamat_pelanggan', true),
			'batas_waktu' => $this->input->post('batas_waktu', true),
			'tanggal_bayar' => $tanggal_bayar,
			'status_transaksi' => $this->input->post('status_transaksi', true),
		];
		
		$this->db->where('transaksi.id_transaksi', $id);
		$this->db->update('transaksi', $data);
		$data['transaksi'] = $this->getTransaksiById($id);

		// jika status bayar sebelumnya belum dibayar
		if ($data['transaksi']['status_bayar'] !== 'sudah dibayar') {
			// jika mengubah status dari belum dibayar ke sudah dibayar
			if ($status_bayar == 'sudah dibayar') {
				// kirim status bayar jika sudah bayar baru diubah
				if ($status_bayar == 'sudah dibayar') {
					$this->session->set_userdata(['status_bayar' => 'sudah dibayar']);
				}
				// kirim kode invoice
				$this->session->set_userdata(['id_transaksi' => $id_transaksi]);
			}
		}

		$this->session->set_flashdata('message-success', 'Transaksi ' . $data['transaksi']['kode_invoice'] . ' berhasil diubah');
		redirect('transaksi');
	}

	public function deleteTransaksi($id)
	{
		$data['transaksi'] = $this->getTransaksiById($id);
		$this->db->delete('transaksi', ['id_transaksi' => $id]);
		$this->session->set_flashdata('message-success', 'Transaksi ' . $data['transaksi']['kode_invoice'] . ' berhasil dihapus');
		redirect('transaksi');
	}

	public function ubahStatusTransaksi($id)
	{
		$data['transaksi'] = $this->getTransaksiById($id);
		if(isset($data['transaksi']) && is_array($data['transaksi'])){
			$kode_invoice=   $data['transaksi']['kode_invoice'];
		  }
		if ($data['transaksi']['status_transaksi'] == 'proses') {
			$data = ['status_transaksi' => 'dicuci'];
		} elseif ($data['transaksi']['status_transaksi'] == 'dicuci') {
			$data = ['status_transaksi' => 'siap diambil'];
		} elseif ($data['transaksi']['status_transaksi'] == 'siap diambil') {
			$transaksi = $this->getTransaksiById($id);
			if ($transaksi['status_bayar'] == 'belum dibayar') {
				redirect('transaksi/pembayaranTransaksi/' . $id);
			}
			$data = ['status_transaksi' => 'sudah diambil'];
		}

		$this->session->set_flashdata('message-success', 'Transaksi ' . $kode_invoice. ' berhasil diubah status transaksinya');
		
		$this->db->where('transaksi.id_transaksi', $id);
		$this->db->update('transaksi', $data);
		redirect('transaksi');
	}


	public function pembayaranTransaksi($id)
	{
		$transaksi = $this->getTransaksiById($id);
		$uang_yg_dibayar = $this->input->post('uang_yg_dibayar', true);
		$total_harga = $this->input->post('total_harga', true);
		if ($uang_yg_dibayar < $total_harga) {
			$this->session->set_flashdata('message-failed', 'Pembayaran Transaksi ' . $transaksi['kode_invoice'] . ' gagal! uang yang dibayar kurang dari total harga');
			redirect('transaksi/pembayaranTransaksi/' . $id);
		}
		$kembalian = $uang_yg_dibayar - $total_harga;
		// masukkan pembayaran
		$data = [
			'id_transaksi' => $id,
			'total_harga' => $total_harga,
			'uang_yg_dibayar' => $uang_yg_dibayar,
			'kembalian' => $kembalian
		];
		$this->db->insert('pembayaran', $data);
		
		$tanggal_bayar = date('Y-m-d H:i:s');
		
		// ubah status bayar
		$data_transaksi = [
			'status_bayar' => 'sudah dibayar',
			'tanggal_bayar' => $tanggal_bayar
		];
		$this->db->where('transaksi.id_transaksi', $id);
		$this->db->update('transaksi', $data_transaksi);

		$this->session->set_flashdata('message-success', 'Pembayaran Transaksi ' . $transaksi['kode_invoice'] . ' berhasil');
		// hapus session status bayar
		if (isset($_SESSION['status_bayar'])) {
			$this->session->unset_userdata('status_bayar');
		}

		// kirim session kembalian
		$this->session->set_userdata('uang_yg_dibayar', $uang_yg_dibayar);
		$this->session->set_userdata('kembalian', $kembalian);

		redirect('transaksi/pembayaranTransaksi/' . $id);
	}

	public function getPembayaran($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'pembayaran.id_transaksi = transaksi.id_transaksi');
		return $this->db->get_where('pembayaran', ['pembayaran.id_transaksi' => $id_transaksi])->row_array();
	}
}