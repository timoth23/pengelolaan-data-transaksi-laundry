<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Paket_model', 'pm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['paket'] = $this->pm->getAllPaket();
		$data['title'] = ucwords('Kelola Paket - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('paket/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createPaket()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['paket'] = $this->pm->getAllPaket();
		$data['title'] = ucwords('Tambah Paket - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_paket', 'Nama paket', 'required|trim');
		$this->form_validation->set_rules('harga_paket', 'Harga paket', 'required|trim|numeric');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim');
		$this->form_validation->set_rules('layanan', 'Satuan', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->pm->createPaket();
		}
	}

	public function updatePaket($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['paket'] = $this->pm->getAllPaket();
		$data['title'] = ucwords('Ubah Paket - ') . $data['paket']['nama_paket'];

		$this->form_validation->set_rules('nama_paket', 'Nama paket', 'required|trim');
		$this->form_validation->set_rules('harga_paket', 'Harga paket', 'required|trim|numeric');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim');
		$this->form_validation->set_rules('layanan', 'Layanan', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->pm->updatePaket($id);
		}
	}

	public function deletePaket($id)
	{
		$this->mm->check_status_login();
		
		$this->pm->deletePaket($id);
	}
	public function getHargaPaket(){
		$id_paket = $this->input->post('id_paket', true);
		$data= $this->pm->getPaketById($id_paket);
		echo json_encode($data);
	}
}