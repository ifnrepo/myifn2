<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Data On Machine <span style="font-size: 10px !important; margin-left:5px; color: grey;">Bulan <?= $this->session->userdata('blnmachine') ?>,Tahun <?= $this->session->userdata('thnmachine') ?> </span></h1>
        <div>
            <a href="<?= base_url() . 'onmachine'; ?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm font-kecil text-gray-900" id="kembali"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
            <a href="<?= base_url() . 'onmachine/carimesin' ?>" id="carimesin" data-remote="false" data-toggle="modal" data-title="Add Data Stok" data-target="#modalBox-lg" title="Add Data Stok" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm font-kecil text-gray-900" id="pilihmesin"><i class="fas fa-file fa-sm"></i> Pilih Mesin</a>
        </div>
    </div>
    <hr class="small">
    <div class="font-kecil text-black">
        <input type="text" id="mode" name="mode" class="hilang" value="<?= $mode; ?>">
        <form method="post" name="formonmachine" id="formonmachine" action="<?= $action; ?>">
        <input type="text" id="xid" name="xid" class="hilang" value="<?= $xid ?>">
            <div class="row">
                <div class="col-md-5">
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Nomor Mesin </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="machnoe" id="machnoe" style="text-transform:uppercase;" placeholder="No Mesin" value="<?= $this->session->userdata('nomesin'); ?>" readonly>
                        </div>
                    </div>
                    <hr class="small">
                    <div class="row font-kecil text-black mb-2">
                        <div class="col-md-12 mb-1">
                            <input type="text" class="form-control input-sm input-form text-gray-800" name="skubarang" id="skubarang" style="text-transform:uppercase;" placeholder="Nomor / Kode SKU">
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <a href="#" class="btn btn-sm shadow-sm flat" id="addpomachine" style="min-width: 50px;"><i class="fas fa-search"></i></a>
                            <a href="#" class="btn btn-sm shadow-sm flat" id="scanmachine" style="min-width: 50px;"><i class="fas fa-camera"></i></a>
                            <a href="<?= base_url() . 'onmachine/caribarang' ?>" id="caribarang" data-remote="false" data-toggle="modal" data-title="Add PO on Machine" data-target="#modalBox-lg" title="Add Data Stok" class="hilang">WW</a>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">SKU </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="sku" id="sku" value="<?= $sku ?>" readonly>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">SPEC </label>
                        <div class="col-md-8">
                            <!-- <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="spek" id="spek" value="" readonly> -->
                            <textarea class="input-sm text-black" id="spek" name="spek" style="width: 100%;" disabled></textarea>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">PO </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="po" id="po" value="<?= $po ?>" readonly>
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="brg_id" id="brg_id" value="<?= $brg_id ?>" readonly>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Item </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="item" id="item" value="<?= $item ?>" readonly>
                        </div>
                    </div>
                    <div class="row font-kecil text-black">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Dis </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="dis" id="dis" value="<?= $dis ?>" readonly>
                        </div>
                    </div>
                    <div class="row font-kecil text-black mb-2">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Ins No </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm input-form text-gray-800 text-black " name="insno" id="insno" value="<?= $insno ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mt-1 mb-2">
                        <div class="col-md-4">Futoito</div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="futoito" name="futoito" <?= $futoito; ?>>
                                <!-- <label class="form-check-label" for="gridCheck1">
                                Example checkbox
                                </label> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active flat" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bunsen</a>
                            <a class="nav-item nav-link flat" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bobbin</a>
                            <!-- <a class="nav-item nav-link flat" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent" style="min-height: 230px !important;">
                        <div class="tab-pane fade show p-1 active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Berat Kosong </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bunko" id="bunko" value="<?= $bunko ?>" onkeypress="return checkNumber(event)" required>
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Jumlah di Box </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bunjmlbox" id="bunjmlbox" value="<?= $bunjmlbox ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Berat Box </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bunbrtbox" id="bunbrtbox" value="<?= $bunbrtbox ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Jumlah di Mesin </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bunjmlmsn" id="bunjmlmsn" value="<?= $bunjmlmsn ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Berat di Mesin </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bunbrtmsn" id="bunbrtmsn" value="<?= $bunbrtmsn ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-1" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Jumlah Sampling </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="jmbobspl" id="jmbobspl" value="<?= $jmbobspl ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Jenis Bobin </label>
                                <div class="col-md-8">
                                    <!-- <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="jnsbob" id="jnsbob" onkeypress="return checkNumber(event)"> -->
                                    <select class="form-control input-sm input-form text-gray-800 text-black " name="jnsbob" id="jnsbob">
                                        <option value="">Pilih Bobbin</option>
                                        <?php foreach ($bobbin->result_array() as $databobbin):?>
                                            <option value="<?= $databobbin['kodebob'] ?>" <?php if($jnsbob == $databobbin['kodebob']) { echo "selected"; } ?>><?= $databobbin['kodebob'].' - '.$databobbin['namabob'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Berat Kosong </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bobko" id="bobko" value="<?= $bobko ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Berat Isi </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bobisi" id="bobisi" value="<?= $bobisi ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                            <div class="row font-kecil text-black mb-2">
                                <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Jumlah di Mesin </label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="bobjmlmsn" id="bobjmlmsn" value="<?= $bobjmlmsn ?>" onkeypress="return checkNumber(event)">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">.....</div> -->
                    </div>
                    <div class="row font-kecil text-black mb-2">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Lot di Mesin (dari)</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="lot_dari" id="lot_dari" value="<?= $lot_dari ?>" onkeypress="return checkNumber(event)">
                        </div>
                    </div>
                    <div class="row font-kecil text-black mb-2">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Lot di Mesin (sampai)</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="lot_sampai" id="lot_sampai" value="<?= $lot_sampai ?>" onkeypress="return checkNumber(event)">
                        </div>
                    </div>
                    <div class="row font-kecil text-black mb-2">
                        <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">RPM Mesin</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control input-sm input-form text-gray-800 text-black " name="rpm" id="rpm" value="<?= $rpm ?>" onkeypress="return checkNumber(event)">
                        </div>
                    </div>
                    <hr class="small">
                    <div class="tombolformstok" style="text-align: center;">
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <a href="#">
                                    <div class="bg-success text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="simpanonmachine">
                                        <i class="fas fa-plus"></i>
                                        Simpan
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-6">
                                <a href="#">
                                    <div class="bg-danger text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="resetonmachine">
                                        <i class="fas fa-redo"></i>
                                        Reset
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->