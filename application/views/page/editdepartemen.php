<?= $this->session->flashdata('kode'); ?>
<div class="container-fluid px-2 py-2">
    <div class="row font-kecil text-black">
        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Kode</label>
        <div class="col-md-8">
            <input type="text" class="form-control input-sm input-form text-gray-800" name="kode" id="kode" value="<?= $data['dept_id'] ?>" disabled>
        </div>
    </div>
    <div class="row font-kecil text-black">
        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Departemen</label>
        <div class="col-md-8">
            <input type="text" class="form-control input-sm input-form text-gray-800" name="nama" id="nama" value="<?= $data['departemen'] ?>" disabled>
        </div>
    </div>
    <div class="row font-kecil text-black">
        <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Persentase Verifikasi <SOurce:sizes></SOurce:sizes></label>
        <div class="col-md-8">
            <input type="text" class="form-control input-sm input-form text-gray-800 kanan" name="persen" id="persen" value="<?= $data['persen_so'] ?>">
        </div>
    </div>
    <hr class="small">
    <div class="tombol mb-2">
        <a href="#" class="btn btn-sm btn-success" id="simpandata"><i class="fas fa-save"></i> Simpan</a>
        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal" id="keluar"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
<script>
    $("#simpandata").click(function(){
        if($("#persen").val()!=''){
            if(isNaN($("#persen").val())){
                alert('Harus isi persentase Verifikasi dengan angka');
                return false;
            }
        }else{
            $("#persen").val('0.00');
        }
        var nilai = parseFloat($("#persen").val());
        if(nilai > 100){
            alert('Maksimal 100 Persen !');
            return false;
        }
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url + 'departemen/updatepersen',
            data: {
                xid: $("#kode").val(),
                nil: nilai
            },
            success: function (data) {
                // alert(kolom);
                // $("#x"+kolom).removeClass('bg-danger');
                $("#keluar").click();
                // setTimeout(() => {
                    window.location.reload();
                // }, 500);
            },
        });
    });
    $("#okeverif").click(function(){
        var kolom = $("#kolom").val();
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url + 'opname/simpanverif',
            data: {
                xid: $("#kode").val(),
            },
            success: function (data) {
                // alert(kolom);
                // $("#x"+kolom).removeClass('bg-danger');
                $("#"+kolom).html(data).show();
                $("#keluarx").click();
            },
        });
    })
    function checkNumber(event) {
        var aCode = event.which ? event.which : event.keyCode;
        if (aCode != 46 && aCode > 31 && (aCode < 48 || aCode > 57)) return false;
        return true;
    }
</script>