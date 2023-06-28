<!DOCTYPE html>
<html lang="en" id="page-top">
  <head>
  	<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
<!-- Datatables CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/datatables/css/dataTables.bootstrap4.min.css'); ?>">
<!-- Fancybox CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/fancybox/jquery.fancybox.min.css'); ?>">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css'); ?>">
<!-- Sweetalert2 CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/sweetalert2/sweetalert2.min.css'); ?>">
<!-- Select2 CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/select2/select2.min.css'); ?>">
<!-- Sidebar CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/jquery/jquery.mCustomScrollbar.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css'); ?>">

<!-- My CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

<!-- Icon -->
<link rel="icon" href="<?= base_url('assets/img/img_properties/icon.png'); ?>">

	<title><?= $title; ?></title>
  <style>
    .container {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }
  </style>
</head>

  </head>
  <body><div class="container">
	<div class="row">
		<div class="col-lg">
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Gagal!</strong> <?= validation_errors(); ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg">
	    	<div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"><i class="fas fa-fw fa-dollar-sign"></i> Pembayaran Transaksi</h5>
		      </div>
		      <div class="modal-body">
			  <div class="row">
        			<div class="col-lg-4">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="kode_invoice">Kode Invoice</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['kode_invoice']; ?>" disabled type="text">
		        		</div>
        			</div>
					<div class="col-lg-4">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="nama_pelanggan">Nama Pelanggan</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['nama_pelanggan']; ?>" disabled type="text">
		        		</div>
        			</div>
					<div class="col-lg-4">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="no_hp_pelanggan">Nomor Handphone</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['no_hp_pelanggan']; ?>" disabled type="text">
		        		</div>
        			</div>
        		</div>
				<div class="row">
					<div class="col-lg">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="alamat_pelanggan">Alamat Pelanggan</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['alamat_pelanggan']; ?>" disabled type="text">
		        		</div>
        			</div>
				</div>
				
		        <div class="form-group">
		        	<label class="font-weight-bold">Paket <?php if ($transaksi['layanan'] == 'Reguler'): ?>
                      <span  class="badge badge-info"><?= $transaksi['layanan']; ?></span>
                    <?php elseif ($transaksi['layanan'] == 'Ekspress'): ?>
                      <span class="badge badge-warning"> <?= $transaksi['layanan']; ?></span>
                    <?php endif ?> </label>
					<div class="table-responsive">
		        	<table class="table table-bordered table-hover">
		        		<thead>
		        			<tr>
		        				<th>No</th>
		        				<th>Nama Paket</th>
		        				<th>Keterangan</th>
		        				<th>Harga Paket (Rp.)</th>
								<th>Satuan</th>
		        				<th>Berat (Kg.)</th>
		        				<th>Biaya Tambahan (Rp.)</th>
		        				<th>Sub Harga (Rp.)</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php $i = 1; ?>
		        			<?php foreach ($detail_transaksi as $dt): ?>
		        				<tr>
		        					<td><?= $i++; ?></td>
		        					<td><?= $dt['nama_paket']; ?></td>
		        					<td><?= $dt['keterangan']; ?></td>
		        					<td><?= number_format($dt['harga_paket']); ?></td>
									<td><?= $dt['satuan']; ?></td>
		        					<td><?= number_format($dt['kuantitas']); ?></td>
									<td><?= number_format($dt['biaya_tambahan']);?> </td>
		        					<td class="text-right"><?= number_format(($dt['harga_paket'] * $dt['kuantitas'])+ $dt['biaya_tambahan']); ?></td>
		        				</tr>
		        			<?php endforeach ?>
		        			
		        			<tr>
		        				<td colspan="7">
		        					Diskon %
		        				</td>
		        				<td class="text-right">
		        					<?php $diskon = ($total_harga['total_harga'] * number_format($dt['diskon'])) / 100; ?>
		        					<?= number_format($dt['diskon']); ?> (- <?= number_format($diskon); ?>)
		        				</td>
		        			</tr>
		        			<tr>
		        				<td colspan="7">
		        					Pajak %
		        				</td>
		        				<td class="text-right">
		        					<?php $pajak = ($total_harga['total_harga'] - $diskon) * number_format($dt['pajak']) / 100; ?>
		        					<?= number_format($dt['pajak']); ?> (+ <?= number_format($pajak); ?>)
		        				</td>
		        			</tr>
		        			<tr>
		        				<th colspan="7">
									Total Harga Yang Dibulatkan (Rp.)
		        				</th>
		        				<td class="text-right">
		        					<?php 
		        						$total_harga_terakhir =(ceil(($total_harga['total_harga']  - $diskon + $pajak) / 100)) * 100;
		        					 ?>
									<?= number_format($total_harga['total_harga']  - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($total_harga_terakhir); ?>)</span>
		        				</td>
		        			</tr>
		        		</tbody>
		        	</table>
							</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-12">
		        		<div class="form-group">
				        	<?php if (isset($_SESSION['kembalian'])): ?>
					        	<div class="row">
				        			<div class="col-lg-6">
				        				<div class="form-group">
					        				<label for="uang_yg_dibayar">Uang yang dibayar</label>
					        				<input style="cursor: not-allowed;" disabled type="text" id="uang_yg_dibayar" class="form-control" value="<?= number_format($_SESSION['uang_yg_dibayar']); ?>">
					        			</div>
				        			</div>
				        			<div class="col-lg-6">
				        				<div class="form-group">
					        				<label for="kembalian">Kembalian</label>
					        				<input style="cursor: not-allowed;" disabled type="text" id="kembalian" class="form-control" value="<?= number_format($_SESSION['kembalian']); ?>">
					        			</div>
				        			</div>
				        		</div>
				        	<?php else: ?>
								<div class="row justify-content-end">
									<div class="col-lg-6">
										<form id="payment-form" method="post" action="<?= base_url('transaksi/pembayaranTransaksi/') . $this->uri->segment(3, 0); ?>">
											<div class="form-group">
												<input type="hidden" name="total_harga" value="<?= $total_harga_terakhir; ?>">
												<label for="uang_yg_dibayar">Uang yang dibayar</label>
												<input type="number" id="uang_yg_dibayar" class="form-control" name="uang_yg_dibayar" required>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-6 text-right">
														<button name="bayar" id="bayarBtn" type="submit" class="btn btn-success" disabled>
															<i class="fas fa-fw fa-dollar-sign"></i> Bayar
														</button>
													</div>
													<div class="col-lg-6 text-left">
														<a href="<?= base_url('/transaksi/index') ?> "class="btn btn-primary">
															<i class="fas fa-fw fa-undo"></i> Kembali
														</a>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
				        	<?php endif ?>
				        </div>
		        	</div>
		        </div>
		      </div>
			  <?php if (isset($_SESSION['kembalian'])): ?>
				<div class="row">
					<div class="col-lg-9">
					<div class="modal-footer">
			        	<a href="<?= base_url('auth/login/transaksi/index') . $this->uri->segment(3, 0); ?> <?php unset($dt['id_transaksi']);?> <?php unset($_SESSION['uang_yg_dibayar']);?> <?php unset($_SESSION['kembalian']);?> " class="btn btn-primary"><i class="fas fa-fw fa-undo"></i> Kembali Ke Dashbord </a>
			      </div>
					</div>
					<div class="col-lg-3">
					<div class="modal-footer">
			        	<a href="<?= base_url('prints/cetakInvoice/') . $this->uri->segment(3, 0); ?>" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Cetak Invoice</a>
			      </div>
					</div>
				</div>
				
			      
		      <?php endif ?>
		    </div>
		</div>
	</div>
</div>
