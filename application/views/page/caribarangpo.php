<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Cari Barang<span style="font-size: 10px !important; margin-left:5px; color: grey;">Data Stok</span></h1>
        <a href="#" class="btn btn-sm btn-success text-gray-900 shadow-sm font-kecil  <?php if(isset($datacari)){if($datacari->num_rows() <= 0){ echo "hilang"; }}else{ echo "hilang"; } ?>" data-href="<?= base_url().'caribarang/exportexcel';  ?>" data-news="Export data ke Excel ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus"><i class="fa fa-file-excel"></i>  Export Excel</a>
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
                
            </div>
        </div>
    </div>
    <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-2" style="text-align: left;margin-top:5px;" for="inputDefault">P/O</label>
            <div class="col-md-6">
                <input type="text" class="form-control input-sm input-form text-gray-900" name="po" id="po" placeholder="Nomor PO" value="<?= $this->session->userdata('caripo'); ?>">
            </div>
        </div>
    </div>
    <div class="form-horizontal mt-2">
        <div class="row font-kecil text-black">
            <label class="col-md-2" style="text-align: left;margin-top:5px;" for="inputDefault"></label>
            <div class="col-md-6 ketrekopname">
                <a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm font-kecil text-black" id="caribarang"><i class="fa fa-search"></i> Proses</a>
                <a href="#" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm font-kecil text-black" id="resetbarang"><i class="fa fa-times"></i> Kosongkan</a>
            </div>
        </div>
    </div>
    <hr class="small mb-3">
    <div class="font-kecil text-black">
        <div class="row">
            <?php if(isset($datacari)){ ?>
                <?php if($datacari->num_rows() > 0){ ?>
                    <div class="col-sm-12 col-xl-12 col-12">
                        <div class="table-responsive tabler">
                            <table class="table table-bordered table-striped table-hover responsive nowrap datatableasli">
                                <thead class="bg-info">
                                    <th>SKU</th>
                                    <th>Specific</th>
                                    <th>Qty</th>
                                    <th>Sat</th>
                                    <th>Kgs</th>
                                    <th>Dep</th>
                                    <th>SBL</th>
                                    <th>Sublok</th>
                                    <th>Ket</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($datacari->result_array() as $brgstok) { ?>
                                        <tr>
                                            <td><?= ponodis($brgstok['po'],$brgstok['item'],$brgstok['dis'],$brgstok['kode_brg']); ?></td>
                                            <td><?= $brgstok['spek']; ?></td>
                                            <td class="kanan"><?= angka($brgstok['pcs'],0); ?></td>
                                            <td><?= $brgstok['kodesatuan']; ?></td>
                                            <td class="kanan"><?= angka($brgstok['kgs'],2); ?></td>
                                            <td><?= $brgstok['departemen']; ?></td>
                                            <td><?= $brgstok['ketx']; ?></td>
                                            <td><?= $brgstok['sublok']; ?></td>
                                            <td><?= $brgstok['kety']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="col-sm-12 col-xl-12 col-12">
                        <div style="text-align:center;min-height:250px;display:flex;justify-content:center;align-items:center;">
                            Tidak ada data yang sesuai !
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="col-sm-12 col-xl-12 col-12">
                    <div style="text-align:center;min-height:250px;display:flex;justify-content:center;align-items:center;">
                        Lakukan pencarian data !
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->