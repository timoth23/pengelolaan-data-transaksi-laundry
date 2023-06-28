<?php 
	$id = $this->session->userdata('id_user');
	$this->db->join('biodata', 'biodata.id_user = user.id_user');
	$cek_biodata = $this->db->get_where('user', ['user.id_user' => $id])->row_array();
 ?>
<!DOCTYPE html>
<html lang="en" id="page-top">
  <head>
  	<?php include 'include-css.php'; ?>
	<title><?= $title; ?></title>
  </head>
  <body>
	<?php if ($cek_biodata !== NULL): ?>
		<div class="wrapper wrapper-light-navy elevation-4">
			<!-- Sidebar  -->
			<nav id="sidebar" class="nav nav-pills nav-sidebar flex-column">
			    <div class="sidebar-header">
			    	<img class="img-fluid  " src="<?= base_url('assets/img/img_properties/icon.png'); ?>" alt="logo">
			    </div>

			    <ul class="list-unstyled components ">
			      <p class="bg-warning my-2 text-center text-dark"><strong><b>Halo, </strong></b><b class="text-success"> <?= $dataUser['username']; ?></b></p>
				
			      <li class="ml-2">
				  <text> Data Master </text>

	</li> 
				  <li>
			      	<a href="<?= base_url('main'); ?>"><i class="fas fa-fw fa-tachometer-alt"></i> Dasbor</a>
			      </li>
				 	 <li>
							<a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-user"></i> Admin </a>
						</li>
			      <li>
			        <a href="#manajemenSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle "><i class="fas fa-fw fa-align-justify"></i> Transaksi</a>
			        <ul class="collapse list-unstyled " id="manajemenSubmenu">
						<li>
							<a href="<?= base_url('transaksi/tambahTransaksi'); ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-1x fa-plus"></i></sup> Tambah Transaksi</a>
						</li>
						<li>
							<a href="<?= base_url('transaksi'); ?>"><i class="fas fa-fw fa-handshake"></i> Daftar Transaksi </a>
						</li>
						<li>
							<a href="<?= base_url('paket'); ?>"><i class="fas fa-fw fa-box"></i> Paket </a>
						</li>
			        </ul>
			      </li>
			      <li>
			          <a href="<?= base_url('laporan'); ?>"><i class="fas fa-fw fa-file-signature"></i> Laporan</a>
			      </li>
			      <li>
			        <a data-toggle="modal" data-target="#logoutModal" href=""><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
			      </li>
			    </ul>

			    <ul class="list-unstyled ">
			      <li>
			        <p>Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script> <br>Timothy Priambodo Hartono TI-UPR</p>
			      </li>
			    </ul>
			</nav>

			<!-- Page Content  -->
			<div id="content">
			    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
			      <div class="container-fluid">
			        <button type="button" id="sidebarCollapse" class="btn btn-warning ">
			          <i class="fas fa-align-left "></i>
					  
			        </button>

			        <ul class="nav navbar-nav ml-auto my-2">
			          <li class="nav-item active">
			            <a href="<?= base_url('main/profile'); ?>" class="btn btn-warning"><i class="fas fa-fw fa-user "></i> <storng class=""><?= $dataUser['username']; ?></strong></a>
			          </li>
			        </ul>
			      </div>
			    </nav>
			    
		    	<div class="container-fluid">
	    	
			    	<!-- Modal Logout -->
					<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content ">
					      <div class="modal-header">
					        <h5 class="modal-title" id="logoutModalLabel"><b>Keluar Aplikasi Ester Laundry</b></h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					       	Apakah <?= $dataUser['username']; ?> ingin keluar aplikasi?
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
					        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
					      </div>
					    </div>
					  </div>
					</div>
	<?php endif ?>
