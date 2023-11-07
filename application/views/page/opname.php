<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Stok Taking<span style="font-size: 10px !important; margin-left:5px; color: grey;">Data Stok</span></h1>
        <div>
            <?php $hilang = $this->session->userdata('leveluser') < 2 ? 'hilang' : ''; ?>
            <a href="<?= base_url() . 'sublok'; ?>" id="addsublok" class="d-sm-inline-block btn btn-sm btn-success shadow-sm font-kecil text-gray-900 <?= $hilang ?> "><i class="fas fa-file-alt fa-sm"></i> Add Sublok</a>
            <?php if ($this->session->userdata('filterstok') != '') : ?>
                <a href="<?= base_url() . 'opname/addopname'; ?>" data-remote="false" data-toggle="modal" data-title="Add Data Stok" data-target="#modalBox-lg" title="Add Data Stok" id="addstok" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm font-kecil text-gray-900 <?= $hilang; ?>"><i class="fas fa-file-alt fa-sm"></i> Add Data Stok</a>
                <a href="<?= base_url() . 'onmachine'; ?>" id="addonmachine" class="d-sm-inline-block btn btn-sm btn-info shadow-sm font-kecil <?php $arron = array('NT','AR'); if(!in_array($this->session->userdata('filterstok'),$arron)){ echo "hilang"; } ?>" ><i class="fas fa-file-alt fa-sm"></i> On Machine</a>
            <?php endif; ?>
        </div>
    </div>
    <hr class="small">
    <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-2" style="text-align: left;margin-top:5px;" for="inputDefault">Departemen Opname</label>
            <div class="col-md-6">
                <select class="form-control input-sm input-form text-gray-800" name="deptopname" id="deptopname">
                    <option value="">Semua</option>
                    <?php
                    foreach ($departemen as $dept) {
                        $aktif = $this->session->userdata('filterstok') == $dept['dept_id'] ? 'selected' : '';
                        echo "<option value='" . $dept['dept_id'] . "' " . $aktif . ">" . $dept['departemen'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mt-1 ketrekopname">
                Jumlah Rekord : <?= $jumlahrec; ?><br>
                <span style="font-size: 10px;">On Progress : <?= $jumlahonprogress ?>; Selesai : <?= $jumlahselesai ?>; Verifikasi: <?= $jumlahverif ?>;</span>
            </div>
        </div>
    </div>
    <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-2" style="text-align: left;margin-top:5px;" for="inputDefault">Cari Sublok</label>
            <div class="col-md-6">
                <input type="text" class="form-control input-sm input-form text-gray-900" name="namasublok" id="namasublok" placeholder="Pencarian kode Sublok" value="<?= $this->session->userdata('filtersublok'); ?>">
            </div>
            <div class="ketrekopname">
                <a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm font-kecil text-black" id="carisublok"><i class="fa fa-search"></i> Cari</a>
                <a href="#" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm font-kecil text-black" id="kosongkansublok"><i class="fa fa-times"></i> Kosongkan</a>
            </div>
        </div>
    </div>
    <hr class="small mb-3">
    <div class="font-kecil text-black">
        <div class="row">
            <?php $arraybg = ['bg-warning', 'bg-danger', 'bg-success', 'bg-info'];
            if ($dataopname->num_rows() > 0) {
                foreach ($dataopname->result_array() as $dataopn) {
                    $selesai = $dataopn['selesai'] == 0 ? "Edit" : "Selesai";
                    $badge = $dataopn['selesai'] == 0 ? "badge badge-warning" : "badge badge-success";
                    $badgeverif = $dataopn['verifikasi'] == 1 ? "badge badge-info" : "hilang";
                    $sele = $dataopn['selesai'] == 0 ? "btn-outline-info" : "btn-outline-success";
                    $caption = $dataopn['selesai'] == 0 ? "edit data" : "lihat data";
                    $hilang = $dataopn['selesai'] == 1 ? "hilang" : "";
                    $verifhilang = $dataopn['selesai'] == 1 && $dataopn['verifikasi'] == 1  ? "" : "hilang";
                    $mb = $dataopn['selesai'] == 1 && $this->session->userdata('fullakses') == 'Y' ? "" : "mb-4"; ?>
                    <div class="col-md-6 mb-1">
                        <div class="card-stok d-flex justify-content-between" style="background-color: white; padding: 5px;">
                            <div class="kiri p-2 align-items-center" style="text-align: center;">
                                <div>
                                    <div class="card-stok-dept"><?= $dataopn['dept_id'] ?></div>
                                    <span><?= $dataopn['ket'] ?></span>
                                </div>
                            </div>
                            <div class="tengah w-100 p-1">
                                <span class="<?= $badge ?> text-black mb-1" style="font-weight: normal"><?= $selesai ?></span>
                                <span class="<?= $badgeverif ?> text-black mb-1" style="font-weight: normal">Verifikasi</span><br>
                                <span><?= angka($dataopn['jmlkgs'],2) ?> Kgs</span><br>
                                <span><?= angka($dataopn['jmlpcs'],0) ?> Pcs</span><br>
                                <hr class="small">
                                <span><?= angka($dataopn['jmlitem'],0) ?> Item</span>
                                <div class="info d-flex justify-content-between mt-0 p-0">
                                    <div style="line-height: 10px;">
                                        <span>Last edit : <?= tglindo($dataopn['upd']) ?></span><br>
                                        <span class="<?= $verifhilang; ?>">Verifikasi Oleh : <?= $dataopn['nama_user'].' tgl '.$dataopn['verifdate'] ?></span>
                                    </div>
                                    <span style="font-size:11px;"><?= $dataopn['sublok'] ?></span>
                                </div>
                            </div>
                            <div class="kanan d-flex align-items-center">
                                <div class=" kanan-info w-100" style="text-align: center !important; margin-left: 2px;vertical-align:middle;">
                                    <a href="<?= base_url() . 'opname/stokopname/' . $dataopn['id'] ?>" class="btn btn-sm <?= $sele ?> btn-block font-kecil">
                                    <?= $caption ?>
                                    </a>
                                    <?php if ($this->session->userdata('leveluser') > 3) : ?>
                                        <a href="#" data-href="<?= base_url() . 'opname/hapusstokopname/' . $dataopn['id'] ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus" class="btn btn-sm btn-outline-danger btn-block font-kecil mt-1 <?= $hilang  ?>">
                                        Hapus
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="small"> -->
                    </div>
                <?php  }
            } else { ?>
                <div class="col-sm-12 col-xl-12 col-12">
                    <div style="text-align:center;min-height:250px;display:flex;justify-content:center;align-items:center;">
                        Data tidak ada, Tambah data Stok Opname terlebih dahulu.
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->