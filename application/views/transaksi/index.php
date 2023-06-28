<div class="row my-2">
	<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-handshake"></i> <b>Daftar Transaksi</b></h4>
	</div>
	<div class="col-lg my-auto header-kanan">
		<a href="<?= base_url('transaksi/tambahTransaksi'); ?>"  class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> <b>Tambah Transaksi</b></a>
	</div>
</div>

<div class="row my-2">
	<div class="col-lg-6">
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

<div class="row justify-content-center text-center my-2">
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/'); ?>" class="btn btn-secondary">Semua</a> <span class="badge badge-secondary"><?php if (isset($jumlah_status_transaksi_semua['semua'])): ?>
			    		<?= $jumlah_status_transaksi_semua['semua']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'proses'); ?>" class="btn btn-danger">Proses</a> <span class="badge badge-danger"><?php if (isset($jumlah_status_transaksi_proses['proses'])): ?>
			    		<?= $jumlah_status_transaksi_proses['proses']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'dicuci'); ?>" class="btn btn-warning text-white">Dicuci</a> <span class="badge badge-warning text-white"><?php if (isset($jumlah_status_transaksi_dicuci['dicuci'])): ?>
			    		<?= $jumlah_status_transaksi_dicuci['dicuci']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'siap diambil'); ?>" class="btn btn-info">Siap diambil</a> <span class="badge badge-info"><?php if (isset($jumlah_status_transaksi_siap_diambil['siap diambil'])): ?>
			    		<?= $jumlah_status_transaksi_siap_diambil['siap diambil']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'sudah diambil'); ?>" class="btn btn-success">Sudah diambil</a> <span class="badge badge-success"><?php if (isset($jumlah_status_transaksi_sudah_diambil['sudah diambil'])): ?>
			    		<?= $jumlah_status_transaksi_sudah_diambil['sudah diambil']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?></span>
	</div>
</div>

<?php if ($this->uri->segment(3, 0)): ?>
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="table_id">
				<thead>
						<tr>
							<th>No</th>
							<th>Kode Invoice</th>
							<th>Nama Pelanggan</th>
							<th>No Hp Pelanggan</th>
							<th>Layanan Paket</th>
							<th>Tanggal Transaksi</th>
							<th>Batas Waktu Selesai</th>
							<th>Status Transaksi</th>
							<th>Status Bayar</th>
							<th>Tanggal Bayar</th>
							<th>Pembuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($transaksi as $dt): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dt['kode_invoice']; ?></td>
								<td><?= $dt['nama_pelanggan']; ?></td>
								<td><?= $dt['no_hp_pelanggan']; ?></td>
								<td><?= $dt['layanan']; ?></td>
								<td><?= $dt['tanggal_transaksi']; ?></td>
								<td><?= $dt['batas_waktu']; ?></td>
								<td>
								  <?php if ($dt['status_transaksi'] == 'proses'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
								<td>
									<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
										<a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></a>
									<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
									<?php endif ?>
								</td>
								<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
						          	<td>-</td>
					          	<?php else: ?>
						        	<td><?= $dt['tanggal_bayar']; ?></td>
						        <?php endif ?>
								<td><?= $dt['username']; ?></td>
								<td>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<a href="<?= base_url('prints/cetakInvoice/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-info"><i class="fas fa-fw fa-print"></i> Cetak</a>
									<?php endif ?>
									<a href="<?= base_url('detailTransaksi/index/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<?php if ($dt['status_transaksi'] !== 'sudah diambil'): ?>
										<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<?php endif ?>	
									<?php elseif ($dt['status_bayar'] !== 'sudah dibayar'&&$dt['status_transaksi'] !== 'sudah diambil'): ?>
									<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
									<?php endif ?>
									<?php if ($dt['status_bayar'] !== 'sudah dibayar'): ?>
										<?php if ($dt['status_transaksi'] == 'proses'): ?>
										<a href="<?= base_url('transaksi/deleteTransaksi/') . $dt['id_transaksi']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dt['kode_invoice']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
										<?php endif ?>
									<?php endif ?>
								</td>
							</tr>
							<!-- Modal Ubah Transaksi -->
							<div class="text-left modal fade" id="ubahTransaksiModal<?= $dt['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('transaksi/updateTransaksi/') . $dt['id_transaksi']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-edit"></i></sup><b> Ubah Transaksi - <?= $dt['kode_invoice']; ?></b></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      	<div class="modal-body">
									  		<div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="nama_pelanggan<?= $dt['kode_invoice']; ?>">Nama Pelanggan</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input required type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
																<?php endif ?>
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
														<?php endif ?>
														<?= form_error('nama_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
													</div>
												</div>
									   		</div>
											   <div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="no_hp_pelanggan<?= $dt['kode_invoice']; ?>">Nomor Hp Pelanggan harus |diawali(62)|</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
																<?php endif ?>
														<?php else : ?>
															<input style="cursor: not-allowed;" readonly type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
														<?php endif ?>
													</div>
												</div>
									   		</div>
											   <div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="alamat_pelanggan<?= $dt['kode_invoice']; ?>">Alamat Pelanggan</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan"><?php endif ?>
																	<?php else: ?>
																		<input style="cursor: not-allowed;" readonly type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan">
																<?php endif ?>
													</div>
												</div>
									   		</div>
											<div class="row">
												<div class="col-lg">
													<div class="form-group">
													<label for="batas_waktu<?= $dt['kode_invoice']; ?>">Batas Waktu</label>
													<?php 
														$batas_waktu = $dt['batas_waktu'];
														$batas_waktu_timestamp = strtotime($batas_waktu);
													?>
													<input required type="datetime-local" name="batas_waktu" id="batas_waktu<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= date('Y-m-d', $batas_waktu_timestamp) . 'T' . date('H:i', $batas_waktu_timestamp); ?>">
													<?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
													</div>
												</div>
											</div>
									
												<div class="form-group">
													<label for="status_transaksi<?= $dt['kode_invoice']; ?>">Status Transaksi</label>
													<select name="status_transaksi" id="status_transaksi<?= $dt['kode_invoice']; ?>" class="form-control">
														<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="dicuci">Dicuci</option>
															<?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<?php endif ?>
														<?php else: ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="proses">Proses</option>
															<?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
															<option value="siap diambil">Siap diambil</option>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="dicuci">Dicuci</option>
															<option value="proses">Proses</option>
															<?php endif ?>
														<?php endif ?>
													</select>
												</div>
								        		<div class="form-group">
													<label for="status_bayar<?= $dt['kode_invoice']; ?>">Status Bayar</label>
													<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
														<input class="form-control" value="Sudah Bayar" disabled style="cursor: not-allowed;">
														<input type="hidden" name="status_bayar" value="<?= $dt['status_bayar']; ?>">
													<?php else: ?>
														<select name="status_bayar" id="status_bayar<?= $dt['kode_invoice']; ?>" class="form-control">
															<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
																<option value="belum dibayar">Belum dibayar</option>
																<option value="sudah dibayar">Sudah dibayar</option>
															<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
																<option value="sudah dibayar">Sudah dibayar</option>
																<option value="belum dibayar">Belum dibayar</option>
															<?php else: ?>
																<option value="belum dibayar">Belum dibayar</option>
																<option value="sudah dibayar">Sudah dibayar</option>
															<?php endif ?>
														</select>
													<?php endif ?>
												</div>
								       
								      			<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
													<button type="submit" name="btnUbahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
								      			</div>
										</div>
								    </div>
							    </form>
							  </div>
							</div>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php elseif ($this->uri->segment(3, 0) == FALSE): ?>
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Invoice</th>
							<th>Nama Pelanggan</th>
							<th>No Hp Pelanggan</th>
							<th>Layanan Paket</th>
							<th>Tanggal Transaksi</th>
							<th>Batas Waktu Selesai </th>
							<th>Status Transaksi</th>
							<th>Status Bayar</th>
							<th>Tanggal Bayar</th>
							<th>Pembuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($transaksi as $dt): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dt['kode_invoice']; ?></td>
								<td><?= $dt['nama_pelanggan']; ?></td>
								<td><?= $dt['no_hp_pelanggan']; ?></td>
								<td><?= $dt['layanan']; ?></td>
								<td><?= $dt['tanggal_transaksi']; ?></td>
								<td><?= $dt['batas_waktu']; ?></td>
								<td>
								  <?php if ($dt['status_transaksi'] == 'proses'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
								<td>
									<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
										<a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></a>
									<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
									<?php endif ?>
								</td>
								<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
						          	<td>-</td>
					          	<?php else: ?>
						        	<td><?= $dt['tanggal_bayar']; ?></td>
						        <?php endif ?>
								<td><?= $dt['username']; ?></td>
								<td>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<a href="<?= base_url('prints/cetakInvoice/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-info"><i class="fas fa-fw fa-print"></i> Cetak</a>
									<?php endif ?>
									<a href="<?= base_url('detailTransaksi/index/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<?php if ($dt['status_transaksi'] !== 'sudah diambil'): ?>
										<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<?php endif ?>	
									<?php elseif ($dt['status_bayar'] !== 'sudah dibayar'&&$dt['status_transaksi'] !== 'sudah diambil'): ?>
									<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
									<?php endif ?>
									<?php if ($dt['status_bayar'] !== 'sudah dibayar'): ?>
										<?php if ($dt['status_transaksi'] == 'proses'): ?>
										<a href="<?= base_url('transaksi/deleteTransaksi/') . $dt['id_transaksi']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dt['kode_invoice']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
										<?php endif ?>	
									<?php endif ?>
								</td>
							</tr>
							<!-- Modal Ubah Transaksi -->
							<div class="text-left modal fade" id="ubahTransaksiModal<?= $dt['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>" aria-hidden="truze">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('transaksi/updateTransaksi/') . $dt['id_transaksi']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-edit"></i></sup><b> Ubah Transaksi - <?= $dt['kode_invoice']; ?></b></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      	<div class="modal-body">
									  		<div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="nama_pelanggan<?= $dt['kode_invoice']; ?>">Nama Pelanggan</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input required type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
																<?php endif ?>
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="nama_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['nama_pelanggan']; ?>" name="nama_pelanggan">
														<?php endif ?>
														<?= form_error('nama_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
													</div>
												</div>
									   		</div>
											   <div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="no_hp_pelanggan<?= $dt['kode_invoice']; ?>">Nomor Hp Pelanggan harus |diawali(62)|</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
																<?php endif ?>
														<?php else : ?>
															<input style="cursor: not-allowed;" readonly type="text" id="no_hp_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['no_hp_pelanggan']; ?>" name="no_hp_pelanggan">
														<?php endif ?>
													</div>
												</div>
									   		</div>
											   <div class="row">
												<div class="col-lg">
													<div class="form-group">
														<label for="alamat_pelanggan<?= $dt['kode_invoice']; ?>">Alamat Pelanggan</label>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
																<input type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan">
																<?php else: ?>
																	<input style="cursor: not-allowed;" readonly type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan"><?php endif ?>
																	<?php else: ?>
																		<input style="cursor: not-allowed;" readonly type="text" id="alamat_pelanggan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['alamat_pelanggan']; ?>" name="alamat_pelanggan">
																<?php endif ?>
													</div>
												</div>
									   		</div>
											<div class="row">
												<div class="col-lg">
													<div class="form-group">
													<label for="batas_waktu<?= $dt['kode_invoice']; ?>">Batas Waktu</label>
													<?php 
														$batas_waktu = $dt['batas_waktu'];
														$batas_waktu_timestamp = strtotime($batas_waktu);
													?>
													<input required type="datetime-local" name="batas_waktu" id="batas_waktu<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= date('Y-m-d', $batas_waktu_timestamp) . 'T' . date('H:i', $batas_waktu_timestamp); ?>">
													<?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
													</div>
												</div>
											</div>
									
												<div class="form-group">
													<label for="status_transaksi<?= $dt['kode_invoice']; ?>">Status Transaksi</label>
													<select name="status_transaksi" id="status_transaksi<?= $dt['kode_invoice']; ?>" class="form-control">
														<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
															<option value="siap diambil">Siap diambil</option>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="dicuci">Dicuci</option>
															<?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<?php endif ?>
														<?php else: ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
															<option value="dicuci">Dicuci</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="proses">Proses</option>
															<?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
															<option value="siap diambil">Siap diambil</option>
															<option value="proses">Proses</option>
															<option value="dicuci">Dicuci</option>
															<?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
															<option value="sudah diambil">Sudah diambil</option>
															<option value="siap diambil">Siap diambil</option>
															<option value="dicuci">Dicuci</option>
															<option value="proses">Proses</option>
															<?php endif ?>
														<?php endif ?>
													</select>
												</div>
								        		<div class="form-group">
													<label for="status_bayar<?= $dt['kode_invoice']; ?>">Status Bayar</label>
													<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
														<input class="form-control" value="Sudah Bayar" disabled style="cursor: not-allowed;">
														<input type="hidden" name="status_bayar" value="<?= $dt['status_bayar']; ?>">
													<?php else: ?>
														<select name="status_bayar" id="status_bayar<?= $dt['kode_invoice']; ?>" class="form-control">
															<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
																<option value="belum dibayar">Belum dibayar</option>
																<option value="sudah dibayar">Sudah dibayar</option>
															<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
																<option value="sudah dibayar">Sudah dibayar</option>
																<option value="belum dibayar">Belum dibayar</option>
															<?php else: ?>
																<option value="belum dibayar">Belum dibayar</option>
																<option value="sudah dibayar">Sudah dibayar</option>
															<?php endif ?>
														</select>
													<?php endif ?>
												</div>
								       
								      			<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
													<button type="submit" name="btnUbahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
								      			</div>
										</div>
								    </div>
							    </form>
							  </div>
							</div>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endif ?>