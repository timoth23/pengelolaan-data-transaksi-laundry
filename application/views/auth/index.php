<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
  <div class="container">
    <a style="font-size: 30px" class="page-scroll oleo-font navbar-brand" href="#home"  data-aos="flip-right" data-aos-duration="1000" >Ester Laundry</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav text-center">
        <a class="text-light nav-item nav-link page-scroll"  data-aos="zoom-in"  data-aos-duration="1000" href="#tentang"><b>Tentang Kami</b></a>
      </div>
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link px-3 py-2 btn btn-warning rounded-pill text-white"  data-aos="zoom-in"  data-aos-duration="1000"  href="<?= base_url('auth/cekStatusPesanan'); ?>"><i class="fas fa-fw fa-check"></i><b> Cek Status Pesanan</b></a>
      </div>
    </div>
  </div>
</nav>
<section class="pt-5">
  <div class="jumbotron jumbotron-fluid bg-white">
    <div class="container text-dark text-center">
      <img style="box-shadow: 5px 5px 5px rgba(0,0,0,0.3)"  data-aos="flip-left"
     data-aos-easing="ease-in-cubic"
     data-aos-duration="2000" src="<?= base_url(); ?>assets/img/img_properties/icon.png" alt="logo" class="img-fluid rounded mb-2" width="200">
      <h1 class="text-shadow display-4 oleo-font font-weight-bold"  data-aos="fade-right" data-aos-duration="2000">Ester Laundry</h1>

      <h4 class="text-shadow my-3"  data-aos="fade-up" data-aos-duration="1500">Mencuci dengan <span class="font-weight-bold">Cepat</span> dan menjaga pakaian tetap <span class="font-weight-bold">Berkualitas.</span></h4>
      <h5 class="text-shadow my-2"  data-aos="fade-up" data-aos-duration="1200">Namanya juga hidup pasti banyak <span class="font-weight-bold"  data-aos="fade-up" data-aos-duration="1000">Cobaan</span>, kalo banyak <span class="font-weight-bold">Cucian</span> bawa aja ke <span class="font-weight-bold oleo-font"  data-aos="fade-up" data-aos-duration="1200">Ester Laundry.</span></h5>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#17a2b8" fill-opacity="1" d="M0,160L40,160C80,160,160,160,240,154.7C320,149,400,139,480,117.3C560,96,640,64,720,85.3C800,107,880,181,960,197.3C1040,213,1120,171,1200,133.3C1280,96,1360,64,1400,48L1440,32L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
</section>
<section id="tentang" class="tentang bg-info mt-n5 p-5">
  <div class="container">
    <div class="row" data-aos="fade-up" data-aos-duration="1000">
      <div class="col-lg my-4 mb-5 text-white text-center">
        <h2><b>Tentang Kami</b></h2>
      </div>
    </div>
    <div class="row mb-3 " data-aos="fade-up" data-aos-duration="1000">
    	<div class="col-lg mb-2 text-white text-center">
    		<p class="text-white mb-5"><span class="oleo-font">Ester Laundry</span> adalah aplikasi laundry untuk membantu pelanggan dalam <strong>meringankan</strong> pekerjaan rumah. Selain itu, aplikasi ini dapat melihat <strong>timeline</strong> proses laundry menggunakan fitur <strong>cek status pesanan</strong>. Sehingga, anda tidak perlu datang ke tempat laundry bila pakaian yang dilaundry belum selesai / belum dapat diambil.</p>
			<div class="table-responsive text-dark p-3 rounded bg-white" data-aos="zoom-in"  data-aos-duration="1000">
			<h3 class="mb-3"><b>Berikut layanan yang tersedia untuk pelanggan kami<b></h3>
				<table class="table table-hover table-bordered" style="font-size: .9rem">
					<thead class= "bg-warning text-white"> Layanan Paket Reguler
						<tr>
							<th><b>No</th>
							<th>Nama Paket</th>
							<th>Harga(.Rp)</th>
							<th>Satuan</b></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($paketreguler as $pr): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $pr['nama_paket']; ?></td>
								<td><?= $pr['harga_paket']; ?></td>
								<td><?= $pr['satuan']; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
        <table class="table table-hover table-bordered" style="font-size: .9rem">
					<thead class= "bg-warning text-white"> Layanan Paket Ekspress
						<tr>
							<th><b>No</th>
							<th>Nama Paket</th>
							<th>Harga(.Rp)</th>
							<th>Satuan</b></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($paketekspress as $pe): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $pe['nama_paket']; ?></td>
								<td><?= $pe['harga_paket']; ?></td>
								<td><?= $pe['satuan']; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
    	</div>
    </div>
    <div class="row pb-3">
    	
    </div>
  </div>
</section>

<section id="testimoni" class="testimoni bg-info mt-n5 p-5">
	<div class="container">
		<div class="row" data-aos="fade-up" data-aos-duration="1000">
			<div class="col-lg my-4 mb-5 text-white text-center">
				<h2><b>Kenapa Memilih Kami ?</b></h2>
			</div>
		</div>
		<div class="row justify-content-center text-center" data-aos="fade-up" data-aos-duration="1000">
        
        <div class="col-lg mb-4">
          <div class="card">
              <img
                src="<?= base_url(); ?>assets/img/img_properties/efisien.jpg" 
			          width="10"
                class="card-img-top"
                alt="..."
              />
          <div class="card-body bg-warning">
                <p class="card-text">
                 Lebih hemat waktu dan hemat tenaga
                </p>
          </div>
          </div>
        </div>
        <div class="col-lg mb-4">
          <div class="card">
              <img
			          src="<?= base_url(); ?>assets/img/img_properties/terbersih.jpg" 
                width="10"
                class="card-img-top"
                alt="..."
              />
          <div class="card-body bg-warning">
                <p class="card-text">
                 Pakain bersih dan wangi 
                </p>
            </div>
          </div>
        </div>
        <div class="col-lg mb-4">
          <div class="card">
              <img
			          src="<?= base_url(); ?>assets/img/img_properties/setrikauap.jpg" 
                width="10"
                class="card-img-top"
                alt="..."
              />
          <div class="card-body bg-warning">
                <p class="card-text">
               Menggunakan setrika uap
                </p>
            </div>
          </div>
        </div>
        <div class="col-lg mb-4">
          <div class="card ">
            <img
			          src="<?= base_url(); ?>assets/img/img_properties/harga.png" 
                width="10"
                class="card-img-top"
                alt="..."
            >
          <div class="card-body bg-warning">
                <p class="card-text">
                Lebih murah dari tempat lain</p>
          </div>
          </div>
        </div>
      </div>
	</div>
</section>

<footer class="bg-light text-dark p-4">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-6 my-3">
		    	<h3 class="oleo-font" data-aos="fade-up" data-aos-duration="1000">Ester Laundry</h3>
		    	<div class="row">
		    		<div class="col-lg" data-aos="fade-up" data-aos-duration="1000">
						<span>Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script> <a expr:href='data:blog.homepageUrl'><data:blog.title/></a>. All rights reserved.</span>
		    		</div>
		    	</div>
			</div>
			<div class="col-lg-6 my-3 " data-aos="fade-up" data-aos-duration="1000">
        <h4 class ="font-italic">Kontak Kami</h4>
        <div class="row text-left my-2">
          <div class="col-lg-4"><i class="fab fa-fw fa-whatsapp"></i> WhatsApp</div>
          <div class="col-lg-5"><a class="text-dark" target="_blank" href="https://web.whatsapp.com/send?phone=+6281256132113">+62 81256132113</a></div>
        </div>
        <div class="row text-left my-2">
          <div class="col-lg-4">
            <i class="fas fa-fw fa-map-marker-alt"></i> Alamat 
          </div>
          <div class="col-lg-8 " >Jl. G. Obos VIII, Gg. Bakung 2 No.7, Kel. Menteng, Kec. Jekan Raya,  Kota Palangkaraya, Prov. Kalimantan Tengah </div>
        </div>
      </div>
		</div>
		<div class="row">
			<div class="col-lg">
				<iframe class="rounded" data-aos="fade-up" data-aos-duration="1000" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d419.05991479309444!2d113.89329780469392!3d-2.231656966309505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMsKwMTMnNTQuMyJTIDExM8KwNTMnMzYuOCJF!5e0!3m2!1sid!2sid!4v1683026682332!5m2!1sid!2sid" height="300" frameborder="0" style="border:0; margin-top: 15px;width: 100%" allowfullscreen=""></iframe>
			</div>
		</div>
	</div>
</footer>

