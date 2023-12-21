<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Data Stok Taking<span style="font-size: 10px !important; margin-left:5px; color: grey;"></span></h1>
        <a href="<?= base_url() . 'opname'; ?>" title="Kembali" class="d-sm-inline-block btn btn-sm btn-success shadow-sm font-kecil text-gray-900"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
    </div>
    <?= $this->session->flashdata('cekdata'); ?>
    <div class="infoopname text-black py-2 px-2 shadow-sm">
        <?php
        $tombolselesai = $this->session->userdata('leveluser') >= 2 && $namastok['selesai'] == '0' && $namastok['verifikasi'] == '0' ? '' : 'hilang'; 
        $tombolverif = $this->session->userdata('leveluser') >= 3 && $namastok['selesai'] == '1' && $namastok['verifikasi'] == '0' ? '' : 'hilang'; 
        $tomboledit = ($this->session->userdata('leveluser') == 2 || $this->session->userdata('leveluser') > 3)  && $namastok['selesai'] == '1' && $namastok['verifikasi'] == '0' ? '' : 'hilang'; 
        $tomboleditverif = $this->session->userdata('leveluser') > 3 && $namastok['selesai'] == '1' && $namastok['verifikasi'] == '1' ? '' : 'hilang'; 

        $hilang = $namastok['selesai'] == '1' ? 'hilang' : '';
        $takhilang = $namastok['selesai'] == '1' && $this->session->userdata('leveluser') >= 3 ? '' : 'hilang';

        $cekverif = $this->session->userdata('leveluser') >= 3 && $namastok['selesai'] == '1' && $namastok['verifikasi'] == '0' ? '' : 'hilang'; 
        $fieldverif = $this->session->userdata('leveluser') >= 3 && $namastok['selesai'] == '1' ? '' : 'hilang'; 
    
        $kolom = $namastok['selesai'] == '1' ? 'col-sm-12' : 'col-sm-7';
        ?>
        <div class="row">
            <div class="col-md-6">
                <div>Departemen : <b><?= $namastok['departemen'] . ' (' . $this->session->userdata('depopn') . ')' ?></b></div>
                <div>Keterangan : <?= $namastok['sublok'] ?></div>
                <div class="row" style="font-size: 14px;">
                    <div class="col-md-3 text-danger">
                        Kgs : <?= rupiah($namastok['jmlkgs'], 2) ?>
                    </div>
                    <div class="col-md-3 text-success">
                        Pcs : <?= rupiah($namastok['jmlpcs'], 0) ?>
                    </div>
                    <div class="col-md-3">
                        Item : <?= rupiah($namastok['jmlitem'], 0) ?>
                    </div>
                    <div class="col-md-3 <?= $tombolverif ?>">
                        Verifikasi : <?= rupiah($barangverif['c'], 0) ?>
                    </div>
                </div>
            </div>
            <?= $this->session->flashdata('cekquery'); ?>
            <?= $this->session->flashdata('jmarray'); ?>
            <div class="col-md-6 py-2" style="text-align:right;">
                <a href="#" class="btn btn-sm btn-danger shadow-sm font-kecil text-gray-900 <?= $tombolselesai ?> " data-href="<?= base_url() . 'opname/selesaiopname/' . $namastok['id'] ?>" data-news="Data ini telah selesai ?, anda tidak akan bisa edit kembali data ini." data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i> Selesai</a>
                <a href="#" class="btn btn-sm btn-success shadow-sm font-kecil text-gray-900 <?= $tomboledit ?>" data-href="<?= base_url() . 'opname/editopname/' . $namastok['id'] ?>" data-news="Edit data ini ?," data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-edit"></i> Edit</a>
                <a href="#" class="btn btn-sm btn-info shadow-sm font-kecil text-gray-900 <?= $tombolverif ?> " data-href="<?= base_url() . 'opname/verifopname/' . $namastok['id'] ?>" data-news="Verifikasi data ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i> Verifikasi</a>
                <a href="#" class="btn btn-sm btn-warning shadow-sm font-kecil text-gray-900 <?= $tomboleditverif ?> " data-href="<?= base_url() . 'opname/editverifopname/' . $namastok['id'] ?>" data-news="Edit data ini (Verifikasi) ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-edit"></i> Edit Verifikasi</a>
            </div>
        </div>
        <input type="text" id="idopn" class="hilang" value="<?= $namastok['id'] ?>">
        <input type="text" id="iddept" class="hilang" value="<?= $namastok['dept_id'] ?>">
    </div>
    <div class="row font-kecil text-black mt-1 mb-2 ">
        <div class="col-sm-5 col-12 formstok <?= $hilang ?>">
            <div class="isiopname py-2 px-2">
                <div class="form-horizontal">
                    <div class="row font-kecil text-black mb-2">
                        <div class="col-md-12 mb-1">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="skubarang" id="skubarang" style="text-transform:uppercase;" placeholder="Nomor / Kode SKU">
                            <input type="text" class="form-control input-sm input-form text-gray-800 mt-1 <?php $arrbol = array('GF','DL'); if(!in_array($this->session->userdata('depopn'),$arrbol)) { echo "hilang"; } ?>" name="skubale" id="skubale" style="text-transform:uppercase;" placeholder="Nomor Bale">
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <a href="#" class="btn btn-sm shadow-sm flat" id="addstoktaking" style="min-width: 50px;"><i class="fas fa-search"></i></a>
                            <a href="#" class="btn btn-sm shadow-sm flat" id="scanbarang" style="min-width: 50px;"><i class="fas fa-camera"></i></a>
                            <a href="<?= base_url() . 'opname/caribarang' ?>" id="caribarang" data-remote="false" data-toggle="modal" data-title="Add Data Stok" data-target="#modalBox-lg" title="Add Data Stok" class="hilang">WW</a>
                        </div>
                        <!-- data-remote="false" data-toggle="modal" data-title="Add Data Stok" data-target="#modalBox-lg" title="Add Data Stok" -->
                    </div>
                    <hr class="small">
                    <div class="row font-kecil text-black hilang">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Halaman </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="hlm" id="hlm">
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">SKU </label>
                        <div class="col-md-8">
                            <input type="text" id="idtb" class="hilang">
                            <input type="text" id="po" class="hilang">
                            <input type="text" id="item" class="hilang">
                            <input type="text" id="dis" class="hilang">
                            <input type="text" id="brgid" class="hilang">
                            <input type="text" id="jntb" class="hilang">
                            <input type="text" id="kgsg" class="hilang">
                            <input type="text" id="pcsg" class="hilang">
                            <input type="text" id="kodeupd" class="hilang">
                            <input type="text" id="xid" class="hilang">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="sku" id="sku" disabled>
                        </div>
                    </div>
                    <!-- <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Po # item (dis) </label>
                        <div class="col-md-8 col-6 col-sm-6">
                            
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="ponodis" id="ponodis">
                        </div>
                    </div> -->
                    <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Ins No</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="insno" id="insno">
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Spesifikasi Barang </label>
                        <div class="col-md-8">
                            <!-- <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="spek" id="spek" disabled> -->
                            <textarea class="input-sm text-black" id="spek" name="spek" style="width: 100%;" disabled></textarea>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Color </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="color" id="color" disabled>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Jumlah (Pcs/Bobbin)</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control input-sm input-form text-gray-800 text-kanan" name="jmlpcs" id="jmlpcs" onkeypress="return checkNumber(event)">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-form text-gray-900" name="satuan" id="satuan">
                                <option value="">--Pilih Satuan--</option>
                                <?php foreach ($satuan as $sat) { ?>
                                    <option value="<?= $sat['id'] ?>"><?= $sat['kode'] ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Satuan</label>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-form text-gray-900" name="satuan" id="satuan">
                                <option value="">--Pilih Satuan--</option>
                            </select>
                        </div>
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" id="namasatuan" for="inputDefault">--</label>
                    </div> -->
                    <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Kgs</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control input-sm input-form text-gray-900 text-kanan" name="jmlkgs" id="jmlkgs">
                        </div>
                    </div>
                    <div class="row font-kecil text-black <?php $arrbol = array('GF','DL'); if(!in_array($this->session->userdata('depopn'),$arrbol)){ echo 'hilang';} ?>">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Nomor Bale</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="nobale" id="nobale">
                        </div>
                    </div>
                    <div class="row font-kecil text-black <?php if($this->session->userdata('depopn')!='GM'){ echo 'hilang';} ?>">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Nomor IB</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="dok" id="dok">
                        </div>
                    </div>
                    <?php 
                        $arr = array('NT','RR','SP','AR');
                        $arr2 = array('NT','GP');
                        $cekhilang = in_array($this->session->userdata('depopn'),$arr) ? '' : 'hilang';
                        $cekhilang2 = in_array($this->session->userdata('depopn'),$arr2) ? '' : 'hilang';
                    ?>
                    <div class="form-group row mt-2 mb-3 <?= $cekhilang ?>">
                        <div class="col-md-4">Breakdown</div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="br" name="br">
                                <!-- <label class="form-check-label" for="gridCheck1">
                                Example checkbox
                                </label> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2 mb-3 <?= $cekhilang2 ?>">
                        <div class="col-md-4">Eks Netting</div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="exnet" name="exnet">
                                <!-- <label class="form-check-label" for="gridCheck1">
                                Example checkbox
                                </label> -->
                            </div>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Keterangan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="ket" id="ket">
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">No Urut Input</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control input-sm input-form text-gray-800" name="norut" id="norut" value="<?= $norut; ?>" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="tombolformstok" style="text-align: center;">
                <div class="row">
                    <div class="col-sm-6 col-6">
                        <a href="#">
                            <div class="bg-success text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="tambahdata">
                                <i class="fas fa-plus"></i>
                                Simpan
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-6">
                        <a href="#">
                            <div class="bg-danger text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="resetdata">
                                <i class="fas fa-redo"></i>
                                Reset
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="<?= $kolom ?> col-12 font-kecil mt-1">
            <div class="table-responsive tabler">
                <table class="table table-bordered table-striped table-hover responsive nowrap datatableasli">
                    <thead class="bg-info">
                        <th>Nama Barang</th>
                        <th>No</th>
                        <th>Qty</th>
                        <th>Sat</th>
                        <th>Kgs</th>
                        <th>Ket</th>
                        <th>Input</th>
                        <th class="<?= $hilang ?>">Aksi</th>
                        <th class="<?= $fieldverif ?>">Cek</th>
                    </thead>
                    <tbody>
                        <?php foreach ($barangstok->result_array() as $brgstok) { 
                            $intr = '';
                            $kete = '';
                            $kete .= $brgstok['ket'] == '' ? '' : $brgstok['ket'];
                            $kete .= $brgstok['dok'] == '' ? '' : ' IB '.$brgstok['dok'];
                            $kete .= $brgstok['nobale'] == '' ? '' : ' Bale '.$brgstok['nobale'];
                            $intr .= $brgstok['insno'] == '' ? '' : ' Insno : '.$brgstok['insno'];
                            $breakd = $brgstok['br'] == '0' ? '' : 'text-merah';
                        ?>
                            <tr class="tabel-bodi">
                                <td style="vertical-align: middle !important;" class="headerdatabawah <?= $breakd ?>">
                                    <div class="headerdata"><?= ponodis($brgstok['po'], $brgstok['item'], $brgstok['dis'], $brgstok['kode_brg']).$intr ?></div>
                                    <?= $brgstok['spek'] ?>
                                </td>
                                <td><?= $brgstok['norut']; ?></td>
                                <td class="kanan" style="font-size: 16px;"><?= angka($brgstok['jumlah'], 2) ?></td>
                                <td><?= $brgstok['kode'] ?></td>
                                <td class="kanan" style="font-size: 16px;"><?= angka($brgstok['kgs'], 2) ?></td>
                                <td><?php echo $kete; ?></td>
                                <td><?php echo getnamapersonil($brgstok['personid']); ?></td>
                                <td style="text-align: center;" class="<?= $hilang ?>">
                                    <a href="#" class="btn-circle btn-sm btn-info tombol-di-grid-bulat text-gray-900 shadow-sm" title="Edit" id="editdataopname" rel="<?= $brgstok['xid'] ?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn-circle btn-sm btn-danger tombol-di-grid-bulat text-gray-900 shadow-sm" data-href="<?= base_url() . 'opname/hapusdataopname/' . $brgstok['xid'] . '/' . $brgstok['id_stokopname'] ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus"><i class="fa fa-times"></i></a>
                                </td>
                                <td class="py-2 <?= $fieldverif ?>" style="text-align:center;">
                                    <?php if($brgstok['sesuai'] != '1'){ ?>
                                        <a href="#" id="tombol<?= $brgstok['xid'] ?>" class="text-danger <?= $cekverif; ?>" style="font-size: 14px;" data-href="<?= base_url() . 'opname/cekverif/' . $brgstok['xid'].'/'. $brgstok['id_stokopname'] ?>" data-news="Data Sesuai ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-times"></i></a>
                                    <?php }else{ ?>
                                        <div style="line-height: 11px;">
                                            <a href="#" id="tombol<?= $brgstok['xid'] ?>" class="text-success <?= $cekverif; ?>" data-href="<?= base_url() . 'opname/editcekverif/' . $brgstok['xid'].'/'. $brgstok['id_stokopname'] ?>" data-news="Batalkan Data Sesuai ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Konfirmasi"><i class="fa fa-check"></i></a><br>
                                            <span style="font-size: 8px;">Oleh : <?= $brgstok['nama_user']; ?>,</span><br>
                                            <span style="font-size: 8px;"> Tgl : <?= $brgstok['verifdate']; ?></span>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->