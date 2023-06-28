<div class="container">
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
			<form action="<?= base_url('transaksi/tambahTransaksi'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="tambahTransaksiModalLabel"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-plus"></i></sup><b> Tambah Transaksi </b></h4>
			      </div>
			      <div class="modal-body">
				  <div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label for="nama_pelanggan">Nama Pelanggan</label>
								<input  type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control">
					    <?= form_error('nama_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
			        			<label for="no_hp_pelanggan">Nomor Hp Pelanggan |Awali(62)|</label>
			        			<input type="number" name="no_hp_pelanggan" id="no_hp_pelanggan" class="form-control"  placeholder="contoh: 62878787232" >
					    <?= form_error('no_hp_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
			       			</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
			        			<label for="alamat_pelanggan">Alamat Pelanggan</label>
			        			<input type="" name="alamat_pelanggan" id="alamat_pelanggan" class="form-control" >
					    		<?= form_error('alamat_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
			        		</div>
						</div>
					</div>
					<div class="row">
					<div class="col-lg-6">
					<div class="form-group">
				        	<div class="row">
				        		<div class="col-sm">
				        			<label for="layanan">Pilih Layanan Paket</label>
				        		</div>
				        	</div>
				        	<div class="row">
				        		<div class="col-sm-3">
						        	<input required type="radio" name="layanan" value="Reguler" id="Reguler"> <label for="Reguler">Reguler</label>
				        		</div>
				        		<div class="col-sm-3">
						        	<input required type="radio" name="layanan" value="Ekspress" id="Ekspress"> <label for="Ekspress">Ekspress</label>
				        		</div>
				        	</div>
							<small class="text-danger"><b>PERHATIAN,</b> Layanan paket yang sudah di kirim tidak dapat di ganti!</small>
					</div>
			        	</div>
					 <div class="col-lg">
			        <div class="form-group">
			        	<label for="batas_waktu">Batas Waktu Selesai</label>
			        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu" class="form-control" value="<?= date('Y-m-d' ). 'T' . date('H:i'); ?>" step="1">
					    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
					</div>
				</div>
					<div class="row">
					<div class="col-lg-6">
			        		<div class="form-group">
					        	<label for="pajak">Pajak(%)</label>
					        	<input type="number" name="pajak" id="pajak" class="form-control" value="0" placeholder="jika 10% maka 10">
							    <?= form_error('pajak', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
							</div>
							<div class="col-lg-6">
			        		<div class="form-group">
					        	<label for="diskon">Diskon(%)</label>
					        	<input type="number" name="diskon" id="diskon" class="form-control" value="<?= set_value('diskon'); ?>" placeholder="jika 10% maka 10">
							    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
							</div>
					<div class="form-group">
			        	<label hidden for="status_bayar">Status Bayar</label>
			        	<select hidden name="status_bayar" id="status_bayar" class="form-control">
			        		<option value="belum dibayar">Belum dibayar</option>
			        	</select>
			        </div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" id="tambahBtn" name="btnTambahTransaksi" class="btn btn-primary"disabled><i class="fas fa-fw fa-plus"></i> Tambah</button>
			      </div>
			    </div>
		    </form>
		</div>
	</div>
</div>
