<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

	public function getTransaksiLaporan($tanggal_awal, $tanggal_akhir)
	{
		
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi) AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
			ORDER BY transaksi.tanggal_transaksi DESC 
		";
		return $this->db->query($query)->result_array();
	}

	public function getTransaksiLaporanSortTglIndex($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}
	public function getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN pembayaran ON transaksi.id_transaksi = pembayaran.id_transaksi
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND status_bayar != 'belum dibayar'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}
	
	public function getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, $status_transaksi)
	{
		$query = "SELECT *, (SELECT count('transaksi.status_transaksi') FROM transaksi WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS '$status_transaksi' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, $status_bayar)
	{
		$query = "SELECT *, (SELECT count('transaksi.status_bayar') FROM transaksi WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS '$status_bayar' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiWajibSelesaiHariIni()
	{
		$tanggal_awal = date('Y-m-d 00:00:00');
		$tanggal_akhir = date('Y-m-d 23:59:59');

		$query = "SELECT * FROM transaksi 
		WHERE transaksi.batas_waktu 
		BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
		";
		return $this->db->query($query)->result_array();
	}

	
	public function getPenghasilan($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT jmlPenghasilan ('$tanggal_awal', '$tanggal_akhir') as penghasilan ";
		return $this->db->query($query)->row_array();
	}
}