<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Data On Machine</h1>
        <div>
            <a href="<?= base_url() . 'opname'; ?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm font-kecil text-gray-900"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
            <a href="<?= base_url() . 'onmachine/addonmachine'; ?>" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm font-kecil text-gray-900" id="addbhn"><i class="fas fa-file-alt fa-sm"></i> Add Data</a>
        </div>
    </div>
    <hr class="small">
    <div class="font-kecil text-black">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="form-horizontal">
                    <div class="row font-kecil text-black">
                        <label class="col-md-3 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Periode </label>
                        <div class="col-sm-3">
                            <select class="form-control input-sm input-form text-gray-800 text-black" id="posisi" name="posisi" >
                                <option value="" <?php if($this->session->userdata('lokmachine') == '') { echo 'selected'; } ?>>Semua</option>
                                <option value="1" <?php if($this->session->userdata('lokmachine') == '1') { echo 'selected'; } ?>>Indoneptune</option>
                                <option value="2" <?php if($this->session->userdata('lokmachine') == '2') { echo 'selected'; } ?>>Arroza</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control input-sm input-form text-gray-800 text-black" id="bulan" name="bulan" >
                                <option value="01" <?php if($this->session->userdata('blnmachine') == 1) { echo 'selected'; } ?>>Januari</option>
                                <option value="02" <?php if($this->session->userdata('blnmachine') == 2) { echo 'selected'; } ?>>Februari</option>
                                <option value="03" <?php if($this->session->userdata('blnmachine') == 3) { echo 'selected'; } ?>>Maret</option>
                                <option value="04" <?php if($this->session->userdata('blnmachine') == 4) { echo 'selected'; } ?>>April</option>
                                <option value="05" <?php if($this->session->userdata('blnmachine') == 5) { echo 'selected'; } ?>>Mei</option>
                                <option value="06" <?php if($this->session->userdata('blnmachine') == 6) { echo 'selected'; } ?>>Juni</option>
                                <option value="07" <?php if($this->session->userdata('blnmachine') == 7) { echo 'selected'; } ?>>Juli</option>
                                <option value="08" <?php if($this->session->userdata('blnmachine') == 8) { echo 'selected'; } ?>>Agustus</option>
                                <option value="09" <?php if($this->session->userdata('blnmachine') == 9) { echo 'selected'; } ?>>September</option>
                                <option value="10" <?php if($this->session->userdata('blnmachine') == 10) { echo 'selected'; } ?>>Oktober</option>
                                <option value="11" <?php if($this->session->userdata('blnmachine') == 11) { echo 'selected'; } ?>>Nopember</option>
                                <option value="12" <?php if($this->session->userdata('blnmachine') == 12) { echo 'selected'; } ?>>Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="tahun" id="tahun" value="<?= $this->session->userdata('thnmachine') ?>" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12 text-right">
              Verifikasi 1 : <?= $sumonmachine['jmlsesuai']; ?>/<?= $sumonmachine['jmlrek']; ?><br>
              Verifikasi 2 : <?= $sumonmachine['jmlverif']; ?>/<?= $sumonmachine['jmlrek']; ?>
            </div>
            <div class="col-md-12">
                <hr class="small">
                <div class="table-responsive tabler">
                    <table class="table table-bordered table-striped table-hover responsive nowrap datatableasli">
                        <thead class="bg-info">
                            <tr>
                                <th data-priority="1">Mesin</th>
                                <th>SKU</th>
                                <th>Ins No</th>
                                <th>Brt Bunsen Ksg</th>
                                <th>Jml Bunsen<br>di Box</th>
                                <th>Brt Box Bunsen</th>
                                <th>Jml Bunsen<br>di Mesin</th>
                                <th>Brt Bunsen<br>di Mesin</th>
                                <th>Jenis<br>Bobin</th>
                                <th>Brt Bobin<br>Kosong</th>
                                <th>Brt Bobin Isi</th>
                                <th>Jml Bobin<br>di Mesin</th>
                                <th>Lot di Rol (Dari)</th>
                                <th>Lot di Rol (Sampai)</th>
                                <th>Jml Rpm di Mesin</th>
                                <?php if($this->session->userdata('leveluser') == 5 || $this->session->userdata('leveluser') == 3){ ?>
                                <th data-priority="2">Aksi</th>
                                <?php } ?>
                                <?php if($this->session->userdata('leveluser') >= 4){ ?>
                                    <th data-priority="3">Verifikasi 2</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datamesin->result_array() as $sublok) : ?>
                                <tr>
                                    <td><?= $sublok['machnoe']; ?></td>
                                    <td><?= ponodis($sublok['po'],$sublok['item'],$sublok['dis'],$sublok['brg_id']); ?></td>
                                    <td><?= $sublok['insno']; ?></td>
                                    <td class="kanan"><?= $sublok['bunko']; ?></td>
                                    <td class="kanan"><?= $sublok['bunjmlbox']; ?></td>
                                    <td class="kanan"><?= $sublok['bunbrtbox']; ?></td>
                                    <td class="kanan"><?= $sublok['bunjmlmsn']; ?></td>
                                    <td class="kanan"><?= $sublok['bunbrtmsn']; ?></td>
                                    <td><?= $sublok['jnsbob']; ?></td>
                                    <td class="kanan"><?= $sublok['bobko']; ?></td>
                                    <td class="kanan"><?= $sublok['bobisi']; ?></td>
                                    <td class="kanan"><?= $sublok['bobjmlmsn']; ?></td>
                                    <td class="kanan"><?= $sublok['lot_dari']; ?></td>
                                    <td class="kanan"><?= $sublok['lot_sampai']; ?></td>
                                    <td class="kanan"><?= $sublok['rpm']; ?></td>
                                    <?php if($this->session->userdata('leveluser') == 5 || $this->session->userdata('leveluser') == 3){ ?>
                                        <td class="text-center" id="kolomverif<?= $sublok['id']; ?>">
                                        <?php if($sublok['selesai']==0 || $sublok['selesai']==''){ ?>
                                                <a href="#" class="btn-circle btn-sm btn-info tombol-di-grid-bulat text-gray-900 shadow-sm" title="Edit" id="editdataonmachine" rel="<?= $sublok['id'] ?>"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn-circle btn-sm btn-danger tombol-di-grid-bulat text-gray-900 shadow-sm" data-href="<?= base_url() . 'onmachine/hapusdataonmachine/' . $sublok['id']  ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus"><i class="fa fa-times"></i></a>
                                                <a href="#" class="btn-circle btn-sm btn-success tombol-di-grid-bulat text-gray-900 shadow-sm" style="font-size: 14px;" data-href="<?= base_url().'onmachine/selesaionmesin/'.$sublok['id'] ?>" data-news="Data Selesai ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i></a>
                                        <?php }else{ if($sublok['sesuai']!=1 && $sublok['verifikasi']==0 && $sublok['verifikasi2']==0){ ?>
                                                <a id="tombol<?= $sublok['id'] ?>" class="text-danger" style="font-size: 14px;" href="<?= base_url().'onmachine/cekverif/'.$sublok['id'].'/kolomverif'.$sublok['id'] ?>" data-news="Data Sesuai ?" data-target="#modalBox-sm" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-times"></i></a>
                                        <?php }else{ ?>
                                            <div style="line-height: 11px;">
                                                <?php if($sublok['verifikasi']==0){ ?>
                                                    <a id="tombol<?= $sublok['id']; ?>" class="text-success" href="<?= base_url().'onmachine/editcekverif/' . $sublok['id'].'/kolomverif'.$sublok['id'] ?>" data-news="Batalkan Data Sesuai ?" data-target="#modalBox-sm" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i></a><br>
                                                <?php } ?>
                                                <span style="font-size: 8px;">Oleh : <?= $sublok['nama_user']; ?>,</span><br>
                                                <span style="font-size: 8px;"> Tgl : <?= $sublok['verifdate']; ?></span>
                                            </div>
                                        <?php } ?>
                                        <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if($this->session->userdata('leveluser') >= 4){ ?>
                                        <td class="text-center" id="xkolomverif<?= $sublok['id']; ?>">
                                            <?php if($sublok['sesuai']==1 && $sublok['verifikasi']==0){ ?>
                                                    <a id="tombol<?= $sublok['id'] ?>" class="text-danger" style="font-size: 14px;" href="<?= base_url().'onmachine/cekverif2/'.$sublok['id'].'/xkolomverif'.$sublok['id'] ?>" data-news="Data Sesuai ?" data-target="#modalBox-sm" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-times"></i></a>
                                            <?php }else{ if($sublok['sesuai']==1 && $sublok['verifikasi']==1){ ?>
                                                    <div style="line-height: 11px;">
                                                        <a id="tombol<?= $sublok['id']; ?>" class="text-success" href="<?= base_url().'onmachine/editcekverif2/' . $sublok['id'].'/xkolomverif'.$sublok['id'] ?>" data-news="Batalkan Data Sesuai ?" data-target="#modalBox-sm" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i></a><br>
                                                        <span style="font-size: 8px;">Oleh : <?= getnamapersonil($sublok['verif2person']); ?>,</span><br>
                                                        <span style="font-size: 8px;"> Tgl : <?= $sublok['verif2date']; ?></span>
                                                    </div>
                                            <?php } ?>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->