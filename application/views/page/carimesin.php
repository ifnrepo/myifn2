<?= $this->session->flashdata('kode'); ?>
<div class="container-fluid px-2 py-2">
    <!-- <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault"></label>
            <div class="col-md-8 kanan">
                <a href="#" class="btn btn-sm btn-danger flat" data-dismiss="modal"><i class="fas fa-times" id="tutup"></i> Tutup</a>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-sm-12 col-12 col-xl-12 font-kecil mt-1">
            <div class="table-responsive tabler">
                <table class="table table-bordered table-striped table-hover responsive nowrap datatablew">
                    <thead class="bg-info">
                        <th>No Mesin</th>
                        <th>Spek</th>
                        <th>Knot</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($mesin as $brg) {
                        ?>
                            <tr class="tabel-bodi">
                                <td><b><?= $brg['mach_no'] ?></b></td>
                                <td><?= $brg['specifik'] ?></td>
                                <td><?= $brg['knot'] ?></td>
                                <td style="text-align:center;">
                                    <a href="#" class="btn btn-xs btn-success tombol-di-grid" id="pilihmesin" title="<?= 'Mesin '.$brg['mach_no'] ?>" rel="<?= $brg['mach_no'] ?>">Pilih</a>
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
    $(document).on('click', '#pilihmesin', function() {
        var x = $(this).attr('rel');
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url + 'onmachine/simpanmesin',
            data: {
                msn: x
            },
            success: function (data) {
                location.reload();
            }
        })
    })
</script>