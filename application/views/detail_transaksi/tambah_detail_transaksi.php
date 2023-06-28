<?php 
	$transaksi = $this->db->get_where('transaksi', ['kode_invoice' => $this->session->userdata('kode_invoice')])->row_array();
	$id_transaksi = $transaksi['id_transaksi'];
?>
<div class="container">
	<div class="row">
		<div class="col-lg">
			<form action="<?= base_url('detailTransaksi/createDetailTransaksi'); ?>" method="post">

				<!-- mengambil status transaksi dari session -->
				<?php if ($this->session->userdata('status_bayar')): ?>
					<input type="hidden" name="status_bayar" value="<?= $this->session->userdata('status_bayar'); ?>">
				<?php endif ?>
				<!-- mengambil kode invoice dari session -->
				<input type="hidden" name="kode_invoice" value="<?= $this->session->userdata('kode_invoice'); ?>">
				<!-- mengambil id transaksi dari hasil fetch kode invoice -->
				<input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahDetailTransaksiModalLabel"><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Detail Transaksi</h5>
			      </div>
			      <div class="modal-body">
			        <div class="row">
			        	<div class="col-lg-5">
			        		<div class="form-group">
					        	<label>Kode Invoice Transaksi</label>
					        	<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $this->session->userdata('kode_invoice'); ?>">
					        </div>
			        	</div>
			        	<div class="col-lg-4">
			        		<div class="form-group">
					        	<label>Nama Pelanggan</label>
					        	<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $transaksi['nama_pelanggan']; ?>">
					        </div>
			        	</div>
						<div class="col-lg-3">
			        		<div class="form-group">
					        	<label>Nomor Hp Pelanggan</label>
					        	<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $transaksi['no_hp_pelanggan']; ?>">
					        </div>
			        	</div>
			        </div>
					<div class="row">
						<div class="col-lg">
							<label value="<?= $transaksi['layanan']; ?>"><h5><b>PAKET <?= strtoupper($transaksi['layanan']); ?> </b></h5></label> 
							<small class="my-1 text-info"><br>Kosongkan bila paket tidak dipilih</br></small>
						</div>	
					</div>	
					<?php if ($transaksi['layanan'] == 'Reguler'): ?>
	<div class="form-group">
		<?php foreach ($paketreguler as $key => $pr): ?>
			<hr class="my-4">
			<div class="input-group mb-2 mt-2">
				<input type="hidden" name="id_paket[]" value="<?= $pr['id_paket']; ?>">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<span class="input-group-text" id="basic-addon1">| <?= $pr['nama_paket']; ?> | Rp. <?= number_format($pr['harga_paket']); ?> /<?= $pr['satuan']; ?></span>
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-2">
					<div class="form-group">
						<label for="kuantitas">Kuantitas :</label>
						<input type="number" min="0" class="form-control" name="kuantitas[]" aria-describedby="basic-addon1" placeholder=""></input>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="biaya_tambahan">Biaya Tambahan (Rp.)</label>
						<input type="number" name="biaya_tambahan[]" id="biaya_tambahan" value="0" min="0" class="form-control" placeholder="-"><?= isset($biaya_tambahan[$key]) ? $biaya_tambahan[$key] : ''; ?></input>
						<?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="form-group">
						<label for="keterangan">Keterangan :</label>
						<textarea name="keterangan[]" id="keterangan" class="form-control"  placeholder="Masukan Keterangan"><?= isset($keterangan[$key]) ? $keterangan[$key] : ''; ?></textarea>
						<?= form_error('keterangan', '<small class="form-text text-danger">', '</small>'); ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php else: ?>	
	<div class="form-group">
		<?php foreach ($paketekspress as $key => $pe): ?>
			<hr class="my-4">
			<div class="input-group mb-2 mt-2">
				<input type="hidden" name="id_paket[]" value="<?= $pe['id_paket']; ?>">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<span class="input-group-text" id="basic-addon1">| <?= $pe['nama_paket']; ?> | Rp. <?= number_format($pe['harga_paket']); ?> /<?= $pe['satuan']; ?></span>
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-2">
					<div class="form-group">
						<label for="kuantitas">Kuantitas :</label>
						<input type="number" min="0" class="form-control" name="kuantitas[]" aria-describedby="basic-addon1" placeholder="" ></input>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="biaya_tambahan">Biaya Tambahan (Rp.)</label>
						<input type="number" name="biaya_tambahan[]" id="biaya_tambahan" value="0" min="0" class="form-control"><?= isset($biaya_tambahan[$key]) ? $biaya_tambahan[$key] : ''; ?></input>
						<?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="form-group">
						<label for="keterangan">Keterangan :</label>
						<textarea name="keterangan[]" id="keterangan" class="form-control"  placeholder="Masukan Keterangan"><?= isset($keterangan[$key]) ? $keterangan[$key] : ''; ?></textarea>
						<?= form_error('keterangan', '<small class="form-text text-danger">', '</small>'); ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>

				</div>
				<div class="modal-footer">
					<a href="<?= base_url('transaksi/deleteTransaksi/') . $id_transaksi; ?>" class="btn btn-danger btn-delete-dettrans" data-text="Apakah anda yakin ingin membatalkan Transaksi? Kode Invoice <?= $transaksi['kode_invoice']; ?>"><i class="fas fa-fw fa-times"></i> Batalkan Transaksi</a>
					<button type="submit" name="btnTambahDetailTransaksi" class="btn btn-primary" id="submitBtn" disabled><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>
</div>
</div>
