<?= $this->session->flashdata('kode'); ?>
<div class="container-fluid px-2 py-2">
    <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Nomor / Kode SKU</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-sm input-form text-gray-800" name="ketopt" id="ketopt" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-12 col-xl-12 font-kecil mt-1">
            <div class="table-responsive tabler">
                <table class="table table-bordered table-striped table-hover responsive nowrap datatablew">
                    <thead class="bg-info">
                        <th>Spec Barang</th>
                        <th>SKU</th>
                        <th>Nomor IB / Insno / Bale</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($barang as $brg) {
                            $dat = trim($brg['po']) != '' ? $brg['po'] . $brg['item'] . $brg['dis'] : $brg['kode_brg'];
                            $bale = trim($brg['nobale']) != '' ? ' Bale No.'.$brg['nobale'] : '';
                        ?>
                            <tr class="tabel-bodi">
                                <td><?= $brg['spek'] ?></td>
                                <td><?= $brg['sku'] ?></td>
                                <td><?= $brg['nobontr'].$brg['insno'].$bale ?></td>
                                <td style="text-align:center;">
                                    <a href="#" class="btn btn-xs btn-success tombol-di-grid" id="pilihbarang" title="<?= $brg['tb'] ?>" rel="<?= $dat ?>" rel2="<?= $brg['tb'] ?>" rel3="<?= $brg['nobontr'] ?>" rel4="<?= $brg['insno'] ?>"
                                     rel5="<?= $brg['nobale'] ?>" rel6="<?= $brg['stok'] ?>" rel7="<?= $brg['stokpc'] ?>" rel8="<?= $brg['id_satuan'] ?>" rel9="<?= $brg['id_dept'] ?>">Pilih</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr class="small">
    <div class="tombol mb-2">
        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times" id="tutup"></i> Batal</a>
    </div>
</div>
<script>
    $(document).on('click', '#pilihbarang', function() {
        var x = $(this).attr('rel');
        var y = $(this).attr('rel2');
        $("#dok").val($(this).attr('rel3'));
        $("#insno").val($(this).attr('rel4'));
        if($(this).attr('rel9') == 'GF'){
            $("#nobale").val($(this).attr('rel5'));
            $("#skubale").val($(this).attr('rel5'));
            $("#jmlpcs").val($(this).attr('rel7'));
            $("#satuan").val($(this).attr('rel8'));
            $("#jmlkgs").val(parseFloat($(this).attr('rel6'))*parseFloat($(this).attr('rel7')));
        }
        isidata(x, y);
        $("#tutup").click();
    })
</script>