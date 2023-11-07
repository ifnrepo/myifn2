<div class="container-fluid px-2 py-2">
    <div class="form-horizontal">
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Departemen Opname</label>
            <div class="col-md-8">
                <select class="form-control input-sm input-form text-gray-800" name="dpppe" id="dpppe" disabled>
                    <option value="">--Pilih--</option>
                    <?php
                    foreach ($departemen as $dept) {
                        $aktif = $this->session->userdata('filterstok') == $dept['dept_id'] ? 'selected' : '';
                        echo "<option value='" . $dept['dept_id'] . "' " . $aktif . ">" . $dept['departemen'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" class="hilang" value="<?= $this->session->userdata('filterstok') ?>" name="adddeptopname" id="adddeptopname">
            </div>
        </div>
        <input type="text" class="form-control hilang" value="opname/adddataopname" id="lowong">
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Nama Petugas</label>
            <div class="col-md-8">
                <input type="text" class="hilang" id="person" value="<?= $personil['person_id'] ?>">
                <input type="text" class="form-control input-sm input-form text-gray-800" name="addnamapetugas" id="addnamapetugas" disabled value="<?= $personil['nama_user'] ?>">
            </div>
        </div>
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Tgl Opname</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-sm input-form text-gray-800 tglpilih" name="addtglopname" id="addtglopname" value="<?= date('d-m-Y') ?>">
            </div>
        </div>
        <div id="isiadd3"></div>
        <div class="row font-kecil text-black">
            <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Keterangan / Sublok</label>
            <div class="col-md-8">
                <!-- <input type="text" class="form-control input-sm input-form text-gray-800" name="addketopname" id="addketopname"> -->
                <select class="form-control input-sm input-form text-gray-800" name="addketopname" id="addketopname">
                    <option value="">--Pilih--</option>
                    <?php
                    foreach ($sublok as $blok) {
                        echo "<option value='" . $blok['kode'] . "'>" . $blok['sublok'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <hr class="small">
    <div class="tombol mb-2">
        <a href="#" class="btn btn-sm btn-success" id="simpandata"><i class="fas fa-save"></i> Simpan</a>
        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".tglpilih").datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        })
        $("#simpandata").click(function() {
            var dept = $("#adddeptopname").val();
            var nm = $("#addnamapetugas").val();
            var ke = $("#addketopname").val();
            var tg = $("#addtglopname").val();
            var xi = $("#person").val();
            if (dept != '' && ke != '') {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'opname/adddataopname',
                    data: {
                        dep: dept,
                        nama: nm,
                        ket: ke,
                        tgl: tg,
                        person: xi
                    },
                    success: function(data) {
                        if (data.length == '1') {
                            location.href = base_url + 'opname/stokopname/' + data[0]['id'];
                        } else {
                            pesan('Data tidak berhasil disimpan, cek data dan koneksi', 'info');
                        }
                    }
                })
            } else {
                pesan('isi Departemen Opname dan Keterangan', 'info');
            }
        })
    })
</script>