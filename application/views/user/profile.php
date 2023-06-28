<?php if (isset($userProfile['username'])): ?>
<div class="container">

	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2 class="text-break"><b>
				Profile - <?= $userProfile['username']; ?>
		    		</b></h2>
		</div>
	</div>
	<div class="row justify-content-center my-2">
		<div class="col-10">
			<div class="card bg-info p-4 rounded text-white mb-3">
			  <div class="row no-gutters">
			    <div class="col-lg-2 mt-4">
			    	<a href="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="enlarge">
				      <img width="150" src="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="card-img" alt="<?= $userProfile['foto']; ?>">
			    	</a>
			    </div>
			    <div class="col-lg-9">
			      <div class="card-body my-auto">
				  <h6 class="font-weight-bold mt-2 pt-2 mb-1 pb-0">Username : <?= $userProfile['username']; ?></h6>
				  <hr class="my-3">
		      		<div class="row">
		      			<div class="col-md-4">Nama Lengkap</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= ucwords(strtolower($userProfile['nama_lengkap'])); ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">No. Telepon</div>
		      			<div class="col-xs-1"> : </div>
						  <?php if ($userProfile['telepon'] == ""): ?>
		      				<div class="col-1">-</div>
		      			<?php else: ?>
							<div class="col text-break"><?= $userProfile['telepon']; ?></div>
			      		<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Email</div>
		      			<div class="col-xs-1"> : </div>
		      			<?php if ($userProfile['email'] == ""): ?>
		      				<div class="col-1">-</div>
		      			<?php else: ?>
			      			<div class="col text-break"><?= $userProfile['email']; ?></div>
			      		<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Alamat</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $userProfile['alamat']; ?></div>
		       		</div>
			      </div>
			    </div>
			  </div>
			</div>
			
		</div>
	</div>

</div>

<?php else: ?>
	<div class="row justify-content-center mt-3">
		Data Kosong, Silahkan Login akun admin dengan nama pengguna <?= $dataAdmin['username']; ?> dan isi biodata admin
		tersebut.
	<small class="text-danger"><b>PERHATIAN,</b> Jika Lupa Password, Anda menghapus Akun admin <?= $dataAdmin['username']; ?>
			dan membuat Akun baru</small>
</div>

<?php endif ?>