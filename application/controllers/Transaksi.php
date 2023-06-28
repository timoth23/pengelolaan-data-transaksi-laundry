<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model', 'tm');
		$this->load->model('DetailTransaksi_model', 'dtm');
		$this->load->model('Main_model', 'mm');
		$this->load->model('Paket_model', 'pm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		// Jika akun super administrator yang login
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getAllTransaksi();
			}
		
		$data['title'] = ucwords('daftar transaksi - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('transaksi/index', $data);
		$this->load->view('templates/footer', $data);
	}

	
	public function updateTransaksi($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();

			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getAllTransaksi();
			}

		$data['title'] = ucwords('daftar transaksi - ') . $data['dataUser']['username'];
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required');
		
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->tm->updateTransaksi($id);
		}
	}

	public function tambahTransaksi()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['transaksi'] = $this->tm->getAllTransaksi();
		$data['title'] = ucwords('tambah transaksi - ') . $data['dataUser']['username'];

		$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
		$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
		$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
		$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
		$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
		$status_transaksi = $this->uri->segment(3, 0);
		if ($status_transaksi) {
			$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
		} else {
			$data['transaksi'] = $this->tm->getAllTransaksi();
		}


		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required');
		$this->form_validation->set_rules('layanan', 'Layanan', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/tambah_transaksi', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->tm->createTransaksi();
		}
	}

	public function pembayaranTransaksi($id_transaksi = 0)
	{
		
		if (isset($_SESSION['id_transaksi'])) {
			$id_transaksi = $this->session->userdata('id_transaksi');
		}
		$data['dataUser'] = $this->mm->getDataUser();
		$data['transaksi'] = $this->tm->getTransaksiById($id_transaksi);
		$data['detail_transaksi'] = $this->tm->getDetailTransaksiById($id_transaksi);
		$data['paket'] = $this->dtm->getPaketById($id_transaksi);
		$data['total_harga'] = $this->tm->getTotalHarga($id_transaksi);
		$data['title'] = ucwords('pembayaran transaksi - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('uang_yg_dibayar', 'Uang yang dibayar', 'required|numeric');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('transaksi/pembayaran_transaksi', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->tm->pembayaranTransaksi($id_transaksi);
		}
	}
	
	public function deleteTransaksi($id)
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		$this->session->unset_userdata('kode_invoice');
		if ($this->session->userdata('status_transaksi')) {
			$this->session->unset_userdata('status_transaksi');
		}
		$this->tm->deleteTransaksi($id);
	}

	public function ubahStatusTransaksi($id)
	{
		$this->mm->check_status_login();
		
		$this->tm->ubahStatusTransaksi($id);
	}


}