<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  .oleo-font {
        font-weight: bold;
        font-family: 'Oleo Script', cursive;
      }
  body {
    min-height: 100vh;
    background-image: url(<?= base_url(); ?>/assets/img/img_properties/background.jpg);
    background-size: cover;
    background-repeat: no-repeat;
  }

  .container {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
</style>

<div class="container">
	<div class="row justify-content-center my-2">
		<div class="col-lg-5 mx-5 border border-success rounded bg-info text-white p-5 " data-aos="flip-right" data-aos-duration="1000">
			<h1 class="text-center oleo-font" ><b>Ester Laundry</b></h1></br>
			<h2><center><font size="5">Sign in</font></center></h2></br>
			<form method="post">
			  <div class="form-group">
			    <label for="username"><i class="fas fa-fw fa-user"></i> <b>Nama Pengguna</b></label>
			    <input required type="text" autocomplete="off" id="username" class="form-control rounded-pill" name="username">
			  </div>
			  <div class="form-group">
			    <label for="password"><i class="fas fa-fw fa-lock"></i> <b>Kata Sandi</b></label>
			    <input required type="password" id="password" class="form-control rounded-pill" name="password">
			  </div>
			  <div class="form-group text-right">
			    <button type="submit" name="login" class="btn btn-warning rounded-pill"><i class="fas fa-fw fa-sign-in-alt"></i> Login</button>
			  </div>
			</form>
			
		</div>
	</div>
</div>

	<!-- Sweet Alert 2 -->
	<div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
	<div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
	<div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>

	<!-- ./Sweet Alert 2 -->