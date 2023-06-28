<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-box"></i><b>Kelola Paket</b></h4>
		</div>
		<div class="col-lg my-auto header-kanan">
			<a href="" data-toggle="modal" data-target="#tambahPaketModal" class="btn btn-primary"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-plus"></i></sup><b>Tambah Paket</b></a>
		
			<!-- Modal Tambah Paket -->
			<div class="text-left modal fade" id="tambahPaketModal" tabindex="-1" role="dialog" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <form action="<?= base_url('paket/createPaket'); ?>" method="post">
			    	<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="tambahPaketModalLabel"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> <b>Tambah Paket</b></h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<label for="nama_paket">Nama Paket</label>
				        	<input required type="text" name="nama_paket" id="nama_paket" class="form-control" value="<?= set_value('nama_paket'); ?>">
						    <?= form_error('nama_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="harga_paket">Harga Paket (.Rp)</label>
				        	<input required type="number" name="harga_paket" id="harga_paket" class="form-control" value="<?= set_value('harga_paket'); ?>">
						    <?= form_error('harga_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
						<div class="form-group">
				        	<label for="satuan">Satuan</label>
				        	<input required type="text" name="satuan" id="satuan" class="form-control" value="<?= set_value('satuan'); ?>">
						    <?= form_error('satuan', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
						<div class="form-group">
				        	<div class="row">
				        		<div class="col-sm">
				        			<label for="layanan">Pilih Layanan Paket</label>
				        		</div>
				        	</div>
				        	<div class="row">
				        		<div class="col-sm-3">
						        	<input type="radio" name="layanan" value="Reguler" id="Reguler"> <label for="Reguler">Reguler</label>
				        		</div>
				        		<div class="col-sm-3">
						        	<input type="radio" name="layanan" value="Ekspress" id="Ekspress"> <label for="Ekspress">Ekspress</label>
				        		</div>
				        	</div>
							<?= form_error('layanan', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
		
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
				        <button type="submit" name="btnTambahPaket" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah</button>
				      </div>
				    </div>
			    </form>
			  </div>
			</div>
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
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Paket</th>
							<th>Harga Paket (Rp.)</th>
							<th>Satuan</th>
							<th>Layanan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($paket as $dp): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dp['nama_paket']; ?></td>
								<td><?= number_format($dp['harga_paket']); ?></td>
								<td><?= $dp['satuan']; ?></td>
								<td><?= $dp['layanan']; ?></td>
								<td>
										<a href="" data-toggle="modal" data-target="#ubahPaketModal<?= $dp['id_paket']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<a href="<?= base_url('paket/deletePaket/') . $dp['id_paket']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dp['nama_paket']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									</td>
							</tr>
							<!-- Modal Ubah Paket -->
							<div class="text-left modal fade" id="ubahPaketModal<?= $dp['id_paket']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPaketModalLabel<?= $dp['id_paket']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('paket/updatePaket/') . $dp['id_paket']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahPaketModalLabel<?= $dp['id_paket']; ?>"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-edit"></i></sup><b> Ubah Paket - <?= $dp['nama_paket']; ?></b></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="nama_paket<?= $dp['id_paket']; ?>">Nama Paket</label>
								        	<input required type="text" name="nama_paket" id="nama_paket<?= $dp['id_paket']; ?>" class="form-control" value="<?= $dp['nama_paket']; ?>">
										    <?= form_error('nama_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="form-group">
								        	<label for="harga_paket<?= $dp['id_paket']; ?>">Harga Paket</label>
								        	<input required type="number" name="harga_paket" id="harga_paket<?= $dp['id_paket']; ?>" class="form-control" value="<?= $dp['harga_paket']; ?>">
										    <?= form_error('harga_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
										<div class="form-group">
								        	<label for="satuan<?= $dp['id_paket']; ?>">Satuan</label>
								        	<input required type="text" name="satuan" id="satuan<?= $dp['id_paket']; ?>" class="form-control" value="<?= $dp['satuan']; ?>">
										    <?= form_error('satuan', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
										<div class="form-group">
			        	<div class="row">
			        		<div class="col-sm">
							<label for="layanan<?= $dp['id_paket']; ?>">Layanan</label>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<?php if ($dp['layanan'] == 'Reguler'): ?>
			        			<div class="col-sm-4">
						        	<input type="radio" checked name="layanan" value="Reguler" id="Reguler"> <label for="Reguler">Reguler</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" name="layanan" value="Ekspress" id="Ekspress"> <label for="Ekspress">Ekspress</label>
				        		</div>
			        		<?php elseif ($dp['layanan'] == 'Ekspress'): ?>
			        			<div class="col-sm-4">
						        	<input type="radio" name="layanan" value="Reguler" id="Reguler"> <label for="Reguler">Reguler</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" checked name="layanan" value="Ekspress" id="Ekspress"> <label for="Ekspress">Ekspress</label>
				        		</div>
				        	<?php else: ?>
								<div class="col-sm-4">
						        	<input type="radio" name="layanan" value="Reguler" id="Reguler"> <label for="Reguler">Pria</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" name="layanan" value="Ekspress" id="Ekspress"> <label for="Ekspress">Ekspress</label>
				        		</div>
			        		<?php endif ?>
			        	</div>
			        </div>
										
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahPaket" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Ubah</button>
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
</div>