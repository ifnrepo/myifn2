<?= $this->session->flashdata('kode'); ?>
<div class="container-fluid px-2 py-2">
    <input type="text" class="hilang" id="kode" value="<?= $id; ?>">
    <input type="text" class="hilang" id="kolom" value="<?= $kolom; ?>">
    <div class="font-kecil text-black">  
        Data Sesuai ? 
    </div>
    <hr class="small">
    <div class="tombol mb-2">
        <a href="#" class="btn btn-sm btn-success" id="okeverif"><i class="fas fa-check"></i> Ya</a>
        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal" id="keluarx"><i class="fas fa-times"></i> Tidak</a>
    </div>
</div>
<script>
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
                // alert(data);
                $("#"+kolom).html(data).show();
                $("#keluarx").click();
            },
        });
    })
</script>