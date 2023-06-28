<div class="row my-2">
	<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-user"></i><b>Kelola Admin</b></h4>
	</div>
	<div class="col-lg my-auto header-kanan">
			<a href="" data-toggle="modal" data-target="#tambahUserModal" class="btn btn-primary"><i class="fas fa-fw fa-user-plus"></i> <b>Tambah Admin</b></a>
		<!-- Modal Tambah User -->
		<div class="text-left modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form action="<?= base_url('user/createUser'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahUserModalLabel"><i class="fas fa-fw fa-user-plus"></i><b> Tambah Admin</b></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="username">Nama Pengguna</label>
			        	<input required type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
						<small  class="my-1 text-danger">*Nama Pengguna tidak dapat diganti, jika sudah dibuat!</small>
					    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="password">Kata Sandi</label>
			        	<input required type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
					    <small  class="my-1 text-danger">*Gunakan angka atau karakter, agar kata sandi lebih kuat!</small>
						<?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="password_verify">Verifikasi Kata Sandi</label>
			        	<input required type="password" name="password_verify" id="password_verify" class="form-control" value="<?= set_value('password_verify'); ?>">
					    <?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			       
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
			        <button type="submit" name="btnTambahUser" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
						<th>Nama Pengguna (Username)</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($user as $du): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $du['username']; ?></td>
							<td class="text-center">
								<!-- Jika adalah akun administrator tersebut tidak dapat saling memanilpulasi -->
									<?php if ($du['id_user'] !== $dataUser['id_user'] ): ?>
										<a href="<?= base_url('user/profile/') . $du['id_user']; ?>" class="badge badge-info"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
										<a href="<?= base_url('user/deleteUser/') . $du['id_user']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $du['username']; ?> dan transaksi yang pernah dibuatnya"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									<?php endif ?>
							</td>
						</tr>

					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

