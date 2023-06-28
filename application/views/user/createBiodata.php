<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2><i class="fas fa-fw fa-user"></i><b>Isi Biodata - <?= $userBiodata['username']; ?></b></h2>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-lg">
			<form action="<?= base_url('user/createBiodata/') . $userBiodata['id_user']; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_user" value="<?= $userBiodata['id_user']; ?>">
		      	<div class="row">
		      		<div class="col-lg">
		      			<div class="text-center">
							<a href="<?= base_url('assets/img/img_profiles/default.png'); ?>" id="check_enlarge_photo" class="enlarge">
								<img style="width: 75%" src="<?= base_url('assets/img/img_profiles/default.png'); ?>" id="check_photo" class="img-thumbnail rounded img_fluid" alt="Photo">
							</a>
						</div>
						<div><small>Click image to zoom</small></div>
						<div class="custom-file my-3 mb-5">
							<input type="file" class="custom-file-input" id="photo" name="foto">
							<label for="photo" class="custom-file-label">Pilih Foto</label>
						</div>
		      		</div>
		      		<div class="col-lg">
		      			<div class="form-group">
				        	<label for="nama_lengkap">Nama Lengkap</label>
				        	<input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= set_value('nama_lengkap'); ?>">
						    <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="telepon">Telepon</label>
				        	<input type="number" name="telepon" id="telepon" class="form-control"  placeholder="(Opsional)" value="<?= set_value('telepon'); ?>">
				        </div>
				        <div class="form-group">
				        	<label for="email">Email</label>
				        	<input type="email" name="email" id="email" class="form-control"  value="<?= set_value('email'); ?>" placeholder="(Opsional)">
				        </div>
				        <div class="form-group">
				        	<label for="alamat">Alamat</label>
				        	<textarea required  name="alamat" id="alamat" class="form-control"><?= set_value('alamat'); ?></textarea>
						    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
		      		</div>
		      	</div>			        
		        <button type="submit" name="btnTambahBiodata" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
		    </form>
		</div>
	</div>
</div>
