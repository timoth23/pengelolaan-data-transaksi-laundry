<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h4><i class="fas fa-fw fa-file-signature"></i><b> Laporan</b></h4>
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
	<!-- Form Cari Tanggal dan jumlah pelanggan -->
	<div class="row my-2">
		<div class="col-lg-8">
			<div class="p-4 m-1 rounded text-dark bg-warning">
				<h5><b>Filter Tanggal Transaksi</h5>
				<?php if (isset($_POST['cari_tanggal'])): ?>
					<?php 
						$tanggal_awal_heading = date('d-m-Y', strtotime($tanggal_awal));
						$tanggal_akhir_heading = date('d-m-Y', strtotime($tanggal_akhir));
					 ?>
					<h6 class="text-dark">Dari Tanggal <?= $tanggal_awal_heading; ?> Sampai Tanggal <?= $tanggal_akhir_heading; ?> </h6>
				<?php else: ?>
					<h6>Dari Tanggal <?= date('01-m-Y'); ?> Sampai Tanggal <?= date('d-m-Y'); ?></h6>
				<?php endif ?>
				<form action="<?= base_url('laporan'); ?>" method="post">
					<div class="row">
						<div class="col-lg my-1" >
							<div class="form-group text-dark">
								<label for="tanggal_awal" >Tanggal Awal</label>
								<?php if (isset($_POST['cari_tanggal'])): ?>
									<input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal" value="<?= $tanggal_awal; ?>">
								<?php else: ?>
									<input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal" value="<?= date('Y-m-01'); ?>">
								<?php endif ?>
							</div>
						</div>
						<div class="col-lg my-1">
							<div class="form-group text-dark" >
								<label for="tanggal_akhir">Tanggal Akhir</label>
								<?php if (isset($_POST['cari_tanggal'])): ?>
									<input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="<?= $tanggal_akhir; ?>">
								<?php else: ?>
									<input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="<?= date('Y-m-d'); ?>">
								<?php endif ?>
							</div>
						</div>
								</div>
								</b>
					<div class="row">
						<div class="col-lg my-1">
							<button type="submit" name="cari_tanggal" class="btn btn-success"><i class="fas fa-fw fa-filter"></i> Filter</button>
						</div>
						<div class="col-lg my-1">
							<a href="<?= base_url('laporan'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-undo"></i> Reset</a>
						</div>
					</div>
				</form>
			</div>
			<div class="p-4 m-1 rounded text-success bg-warning">
			<?php if (isset($_POST['cari_tanggal'])): ?>
				<h3>Penghasilan <b>(Rp.) <?= $penghasilan['penghasilan']; ?></b></h3>
			<?php else: ?>
				<h3>Penghasilan <b>(Rp.) 0</b></h3>
			<?php endif ?>
			</div>
			<?php if (isset($_POST['cari_tanggal'])): ?>
			<div class="p-4 m-1">
				<a target="_blank" href="<?= base_url('prints/laporan/' . $tanggal_awal . '/' . $tanggal_akhir); ?>" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Cetak</a>
			</div>
			<?php endif ?>
		</div>
		<?php if (isset($_POST['cari_tanggal'])): ?>
			<div class="col-lg-4">
				<div class="p-4 m-1 jumlah-laporan rounded bg-secondary text-white">
					<div class="card text-dark">
					  <div class="card-header">
					    <b>Jumlah</b>
					  </div>
					  <ul class="list-group list-group-flush">
					    <li class="list-group-item"><i class="fas fa-fw fa-handshake"></i> Transaksi : 
					    	<strong>
					    		<?php if ($jumlah_transaksi == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_transaksi['jumlah_transaksi']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-sync"></i> Proses : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_proses == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_proses['proses']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-tshirt"></i> Dicuci : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_dicuci == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_dicuci['dicuci']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-people-carry"></i> Siap Diambil : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_siap_diambil == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_siap_diambil['siap diambil']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-check-circle"></i> Sudah Diambil : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_sudah_diambil == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_sudah_diambil['sudah diambil']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
						<li class="list-group-item"><i class="fas fa-fw fa-dollar-sign"></i><sup><i class="fas fa-1x fa-times"></i></sup> Belum Dibayar : <strong>
					    	<?php if ($jumlah_status_bayar_belum_dibayar == null): ?>
					    		0
					    	<?php else: ?>
					    		<?= $jumlah_status_bayar_belum_dibayar['belum dibayar']; ?>
					    	<?php endif ?>
					    </strong></li>
					    <li class="list-group-item"><i class="fas fa-fw fa-dollar-sign"></i> Sudah Dibayar : <strong>
					    	<?php if ($jumlah_status_bayar_sudah_dibayar == null): ?>
					    		0
					    	<?php else: ?>
					    		<?= $jumlah_status_bayar_sudah_dibayar['sudah dibayar']; ?>
					    	<?php endif ?>
					    </strong></li>
					  </ul>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
	<!-- ./Form Cari Tanggal dan jumlah pelanggan -->
	
	<?php if (isset($_POST['cari_tanggal'])): ?>
		<div class="row">
			<div class="col-lg">
			<?php if (isset($_POST['cari_tanggal'])): ?>
				<h4><i class="fas fa-fw fa-handshake"></i> Daftar Laporan Transaksi dari <?= $tanggal_awal_heading; ?> s/d <?= $tanggal_akhir_heading; ?></h4>
			<?php else: ?>
				<h4><i class="fas fa-fw fa-handshake"></i> Daftar Laporan Transaksi </h4>
			<?php endif ?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered text-center">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Invoice</th>
								<th>Nama Pelanggan</th>
								<th>No Hp Pelanggan</th>
								<th>Layanan Paket</th>
								<th>Tanggal Transaksi</th>
								<th>Batas Waktu Selesai</th>
								<th>Tanggal Bayar</th>
								<th>Status Transaksi</th>
								<th>Status Bayar</th>
								<th>Jumlah</th>
								<th>Pembuat</th>
								
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($transaksiLaporan as $dt): ?>
								<tr>
									<td><?= $i++; ?></td>
									<td>
										<?= $dt['kode_invoice']; ?>
									</td>
									<td><?= $dt['nama_pelanggan']; ?></td>
									<td><?= $dt['no_hp_pelanggan']; ?></td>
									<td><?= $dt['layanan']; ?></td>
									<td><?= $dt['tanggal_transaksi']; ?></td>
									<td><?= $dt['batas_waktu']; ?></td>
									<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
							          	<td>-</td>
						          	<?php else: ?>
							        	<td><?= $dt['tanggal_bayar']; ?></td>
							        <?php endif ?>
									<td>
							  <?php if ($dt['status_transaksi'] == 'proses'): ?>
							    <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
							    <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
							    <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
							    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php else: ?>
							    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php endif ?>
							</td>
							<td>
								<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
									<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
								<?php endif ?>
							</td>
						
							<td>Rp.<?= $dt['total_harga'] ?></td>		
							<td><?= $dt['username']; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>