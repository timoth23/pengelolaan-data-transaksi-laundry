<style>
  body {
    font-family: monospace, sans-serif;
  }
  ul {
    list-style: none;
    padding: 0;
    overflow-x: hidden;
  }
  .outer {
    width: 100%;  
  }
  .inner {
    padding-left: 20px;
  }
  li:not(.nested):before {
    float: left;
    width: 0;
    white-space: nowrap;
    content:"..........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................";
  }
  li span:first-child {
    padding-right: 0.33em;
    background: #FAFAFA;
  }
  span + span {
    float: right;
    padding-left: 0.33em;
    background: #FAFAFA;
  }
  @media print {
    .hilang-diprint {
      display: none;
    }
  }
</style>

<div class="container border border-dark my-2 p-4 px-5 mt-4">
  <div class="row justify-content-center">
    <div class="col-2 text-left">
      <img width="100%" class="rounded" src="<?= base_url(); ?>assets/img/img_properties/icon.png" alt="logo">
    </div>
    <div class="col text-left my-auto">
      <table border="0">
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Nama Toko</h6></th>
          <td class="px-2"> : </td>
          <td>Ester Laundry</td>
        </tr>
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Alamat</h6></th>
          <td class="px-2"> : </td>
          <td>Jl. G. Obos VIII, GG. Bakung 2 No.7, Kel. Menteng, Kec. Jekan Raya, Kota Palangkaraya, Prov. Kalimantan Tengah</td>
        </tr>
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Telepon</h6></th>
          <td class="px-2"> : </td>
          <td>+6281256132113</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="mt-4" style="border: 1px black dashed"></div>
  <div class="row justify-content-center mt-3 mb-2">
    <div class="col text-center">
      <h4>KODE INVOICE. <?= $transaksi['kode_invoice']; ?></h4>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row my-4">
    <div class="col-6">
      <table border="0">
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Nama Pelanggan</td>
          <td class="px-2"> : </td>
          <td><?= $transaksi['nama_pelanggan']; ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">No. Telepon</td>
          <td class="px-2"> : </td>
          <td><?= $transaksi['no_hp_pelanggan']; ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important;" class="font-weight-bold">Alamat</td>
          <td class="px-2"> : </td>
          <td style=" max-width: 260px !important"><?= $transaksi['alamat_pelanggan']; ?></td>
        </tr>
      </table>
    </div>
    <div class="col">
      <table border="0">
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Cetak Invoice</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s'); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Transaksi</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['tanggal_transaksi'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Batas Waktu Selesai</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['batas_waktu'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Bayar</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['tanggal_bayar'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Status Transaksi</td>
          <td class="px-2"> : </td>
          <td>
            <?php if ($transaksi['status_transaksi'] == 'proses'): ?>
              <span class="text-white btn-print btn btn-sm btn-danger"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'dicuci'): ?>
              <span class="text-white btn-print btn btn-sm btn-warning"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'siap diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-primary"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'sudah diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-success"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php else: ?>
              <span class="text-white btn-print btn btn-sm btn-info"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php endif ?>
          </td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Status Pembayaran</td>
          <td class="px-2"> : </td>
          <td>  <?php if ($transaksi['status_bayar'] == 'belum dibayar'): ?>
              <span class="text-white btn-print btn btn-sm btn-danger"><?= ucwords(strtolower($transaksi['status_bayar'])); ?></span></td>
               <?php endif ?>
        </tr>
        <tr>
              <td class="font-weight-bold">Layanan Paket</td>
                <td class="px-2"> : </td>
                  <td>
                    <?php if ($transaksi['layanan'] == 'Reguler'): ?>
                      <span  class="badge badge-info "><?= $transaksi['layanan']; ?></span>
                    <?php elseif ($transaksi['layanan'] == 'Ekspress'): ?>
                      <span class="badge badge-warning "> <?= $transaksi['layanan']; ?></span>
                    <?php endif ?>
                  </td>
                  </tr>
      </table>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row justify-content-center mt-2 mb-1">
    <div class="col text-center">
      <h4>Detail Transaksi</h4>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row">
    <div class="col-lg">
 
    <div class="table-responsive">
      <table class="table table-striped table-bordered border border-dark mt-3 mb-1">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama Paket</th>
            <th>Keterangan</th>
            <th>Harga Paket (Rp.)</th>
            <th>Satuan</th>
            <th>Kuantitas</th>
		        				<th>Biaya Tambahan (Rp.)</th>
		        				<th>Sub Harga (Rp.)</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($detail_transaksi as $dt): ?>
            <tr class="text-center">
              <td><?= $i++; ?></td>
              <td><?= $dt['nama_paket']; ?></td>
              <td><?= $dt['keterangan']; ?></td>
              <td><?= number_format($dt['harga_paket']); ?></td>
              <td><?= $dt['satuan']; ?></td>
              <td><?= number_format($dt['kuantitas']); ?></td>
									<td><?= number_format($dt['biaya_tambahan']);?> </td>
		        					<td class="text-right"><?= number_format(($dt['harga_paket'] * $dt['kuantitas'])+ $dt['biaya_tambahan']); ?></td>
            </tr>
          <?php endforeach ?>
          <tr>
            <td colspan="7">
              Diskon %
            </td>
            <td class="text-right">
            <?php $diskon = ($total_harga['total_harga']) * number_format($dt['diskon']) / 100; ?>
              <?= number_format($dt['diskon']); ?> (- <?= number_format($diskon); ?>)
            </td>
          </tr>
          <tr>
            <td colspan="7">
              Pajak %
            </td>
            <td class="text-right">
            <?php $pajak = ($total_harga['total_harga']  - $diskon) * number_format($dt['pajak']) / 100; ?>
              <?= number_format($dt['pajak']); ?> (+ <?= number_format($pajak); ?>)
            </td>
          </tr>
          <tr>
            <td colspan="7">
              Total Harga dibulatkan (Rp.)
              <td class="text-right">
                      <?php 
                        $total_harga_terakhir = (ceil(($total_harga['total_harga']  - $diskon + $pajak) / 100)) * 100;
                       ?>
                      <?= number_format($total_harga['total_harga'] - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($total_harga_terakhir); ?>)</span>
                    </td>
          </tr>
       
        </tbody>
      </table>
          </div>
    </div>
  </div>
  
  <div class="mx-n5 my-2 text-center" style="border: 1px black solid"> SIMPAN FAKTUR, DAN TUNJUKAN KEMBALI KETIKA MENGAMBIL LAUNDRY ANDA</div>
</div>
