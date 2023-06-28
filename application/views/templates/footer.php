        </div>
        <!-- ./Container-fluid -->
      </div>
        <!-- ./Content -->
    </div>
    <!-- ./wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    
	<!-- Sweet Alert 2 -->
	<div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
  <?php unset($_SESSION['message']); ?>
	<div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
  <?php unset($_SESSION['message-success']); ?>
	<div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
  <?php unset($_SESSION['message-failed']); ?>
	<!-- ./Sweet Alert 2 -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"> </script>
    <script src="<?= base_url('assets/vendor/jquery/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/chartjs/Chart.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fancybox/jquery.fancybox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fontawesome/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/select2/select2.min.js'); ?>"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript">
    AOS.init({
easing: 'ease-in-out-sine'
    });
</script>

    <!-- Config JavaScript -->
	<script src="<?= base_url('assets/js/config-datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/js/config-fancybox.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-sweetalert2.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-sidebar.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-select2.js'); ?>"></script>

  </body>
</html>
<script type="text/javascript">
$(document).ready(function() {
  function fn_toggleExpDateOut(date, addDays, addHours) {
    var dateto = moment(date);
    if (addDays) {
      dateto.add(addDays, 'days');
    }
    if (addHours) {
      dateto.add(addHours, 'hours');
    }
    $('#batas_waktu').val(dateto.format('YYYY-MM-DDTHH:mm'));
  }
  
  function refreshBatasWaktu() {
    var currentDate = moment().format('YYYY-MM-DDTHH:mm');
    $('#batas_waktu').val(currentDate);
  }

  refreshBatasWaktu();

  $("input[name='layanan']").click(function() {
    var selectedLayanan = $(this).val();
    var fromDate = $('#batas_waktu').val();
    
    if (selectedLayanan === "Reguler") {
      if (fromDate) {
        fn_toggleExpDateOut(fromDate, 3, null);
      }
    } else if (selectedLayanan === "Ekspress") {
      if (fromDate) {
        fn_toggleExpDateOut(fromDate, 1, 6);
      }
    }
  });

  // Refresh batas waktu ketika acara berpindah-pindah
  $("input[name='layanan']").on("change", function() {
    refreshBatasWaktu();
    var selectedLayanan = $("input[name='layanan']:checked").val();
    var fromDate = $('#batas_waktu').val();
    
    if (selectedLayanan === "Reguler") {
      if (fromDate) {
        fn_toggleExpDateOut(fromDate, 3, null);
      }
    } else if (selectedLayanan === "Ekspress") {
      if (fromDate) {
        fn_toggleExpDateOut(fromDate, 1, null);
      }
    }
  });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var kuantitasInputs = document.querySelectorAll('input[name="kuantitas[]"]');
        var submitBtn = document.getElementById('submitBtn');

        function checkKuantitasInputs() {
            var anyKuantitasFilled = false;
            for (var i = 0; i < kuantitasInputs.length; i++) {
                if (kuantitasInputs[i].value !== '') {
                    if (parseInt(kuantitasInputs[i].value) !== 0) {
                        anyKuantitasFilled = true;
                        break;
                    }
                }
            }

            submitBtn.disabled = !anyKuantitasFilled;
        }

        for (var i = 0; i < kuantitasInputs.length; i++) {
            kuantitasInputs[i].addEventListener('input', checkKuantitasInputs);
        }

        checkKuantitasInputs();
    });
</script>


<script>
    const uangDibayarInput = document.getElementById('uang_yg_dibayar');
    const bayarBtn = document.getElementById('bayarBtn');
    uangDibayarInput.addEventListener('input', function() {
        bayarBtn.disabled = !this.value;
    });
</script>
<script>
    const namapelanggan = document.getElementById('nama_pelanggan');
    const tambahBtn = document.getElementById('tambahBtn');
    namapelanggan.addEventListener('input', function() {
      tambahBtn.disabled = !this.value;
    });
</script>
