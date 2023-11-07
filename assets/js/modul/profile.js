$(document).ready(function () {
    var g = $(window).width();
})
$("#updateprofile").click(function () {
    var ind = $("#noinduk").val();
    var nam = $("#nama").val();
    var bag = $("#bagian").val();
    var jab = $("#jabatan").val();
    var lev = $("#levelid").val();
    var log = $("#login").val();
    var pas = $("#password").val();
    var klm = $("#jenkel").val();
    var isi = '';
    for (let x = 1; x < 22; x++) {
        if ($("#cek" + x).prop('checked')) {
            isi = isi.trim() + $("#cek" + x).attr('rel') + ',';
        }
    }
    var idx = $("#idprofil").val();
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url + 'profile/updateprofil',
        data: {
            induk: ind,
            nama: nam,
            bagi: bag,
            jaba: jab,
            leve: lev,
            logi: log,
            pass: pas,
            dept: isi,
            aidi: idx,
            kel: klm,
        },
        success: function (data) {
            // alert(data);
            if (data.length == '1') {
                pesan('Data berhasil disimpan', 'success');
                $("#resetprofil").click();
            } else {
                pesan('Data tidak ada, cek data dan pastikan koneksi baik', 'info');
            }
        }
    })
})
$("#cekpass").click(function () {
    var isi = $(this).html();
    if (isi == '<i class="fas fa-eye"></i>') {
        $(this).html('<i class="fas fa-eye-slash"></i>');
        $("#password").attr('type', 'text');
    } else {
        $(this).html('<i class="fas fa-eye"></i>');
        $("#password").attr('type', 'password');
    }
})