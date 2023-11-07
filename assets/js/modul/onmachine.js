$(document).ready(function () {
    // $("#posisi").change(function () {
    //     $("#tahun").change();
    // })
})
$("#tahun").change(function () {
    var th = $(this).val();
    var bl = $("#bulan").val();
    var loka = $("#posisi").val();
    $.ajax({
        type: "POST",
        url: base_url + 'onmachine/filterbulan',
        data: {
            thn: th,
            bln: bl,
            lok: loka,
        },
        success: function (data) {
            location.reload();
        }
    })
})
$("#bulan").change(function () {
    $("#tahun").change();
})
$("#posisi").change(function () {
    $("#tahun").change();
})
$("#xmachno").change(function () {
    // alert($(this).val());
    $("#machno").val($(this).val());
})
$("#simpanonmachine").click(function () {
    var mode = $("#mode").val();
    if (mode == 'tambah') {
        var machno = $("#machnoe").val();
        var po = $("#sku").val();
        var insno = $("#insno").val();
        if (machno == '' || po == '') {
            pesan('Isi data dengan Lengkap', 'error');
        } else {
            if (isisemua()) {
                document.formonmachine.submit();
                pesan('Data berhasil disimpan', 'success');
                $("#kembali").click();
            } else {
                pesan('Isi data dengan Lengkap', 'error');
            }
        }
    } else {
        var machno = $("#machno").val();
        var po = $("#po").val();
        var insno = $("#insno").val();
        if (machno == '' || po == '' || insno == '') {
            pesan('Isi data dengan Lengkap', 'error');
        } else {
            if (isisemua()) {
                document.formonmachine.submit();
                pesan('Data berhasil disimpan', 'success');
                $("#kembali").click();
            } else {
                pesan('Isi data dengan Lengkap', 'error');
            }
        }
    }
})
$("#skubarang").keyup(function (e) {
    var tex = $(this).val();
    if (tex != '' && e.keyCode == 13) {
        if (tex.length >= 4) {
            caribarang(tex);
        } else {
            pesan('Minimal 4 Digit untuk pencarian', 'info');
        }
    }
})
$("#addpomachine").click(function () {
    var tex = $("#skubarang").val();
    if (tex.length >= 4) {
        caribarang(tex);
    } else {
        pesan('Minimal 4 Digit untuk pencarian', 'info');
    }
})
$("#resetonmachine").click(function () {
    kosongkan();
})
$("#jnsbob").change(function () {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url + 'onmachine/cariberatbobbin',
        data: {
            id: $(this).val(),
        },
        success: function (data) {
            if ($("#jmbobspl").val() == '' || $("#jmbobspl").val() == 0) {
                $("#bobko").val('0');
            } else {
                $("#bobko").val(rupiah(data[0].berat * parseFloat($("#jmbobspl").val())), '.', ',', 2);
            }
        }
    })
})
$(document).on('click', "#editdataonmachine", function () {
    var rel = $(this).attr('rel');
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url + 'onmachine/caridataonmachine',
        data: {
            id: rel,
        },
        success: function (data) {
            window.location.href = base_url + 'onmachine/addonmachine/' + data[0].id;
            // $("#xid").val(rel);
        }
    })
})
function kosongkan() {
    $("#machnoe").val('');
    $("#skubarang").val('');
    $("#po").val('');
    $("#item").val('');
    $("#dis").val('');
    $("#insno").val('');
    $("#bunko").val('');
    $("#bunbrtbox").val('');
    $("#bunjmlbox").val('');
    $("#bunjmlmsn").val('');
    $("#bunbrtmsn").val('');
    $("#jnsbob").val('');
    $("#bobko").val('');
    $("#bobisi").val('');
    $("#bobjmlmsn").val('');
    $("#lot_dari").val('');
    $("#lot_sampai").val('');
    $("#brg_id").val('');
    $("#spek").val('');
    $("#sku").val('');
    $("#rpm").val('');
}
function isisemua() {
    var access = true;

    // if ($("#item").val() == '') {
    //     access = false;
    // }
    // if ($("#dis").val() == '') {
    //     access = false;
    // }
    if ($("#bunko").val() == '') {
        access = false;
    }
    if ($("#bunbrtbox").val() == '') {
        access = false;
    }
    if ($("#bunjmlbox").val() == '') {
        access = false;
    }
    if ($("#bunjmlmsn").val() == '') {
        access = false;
    }
    if ($("#bunbrtmsn").val() == '') {
        access = false;
    }
    if ($("#jnsbob").val() == '') {
        access = false;
    }
    if ($("#bobko").val() == '') {
        access = false;
    }
    if ($("#bobisi").val() == '') {
        access = false;
    }
    if ($("#bobjmlmsn").val() == '') {
        access = false;
    }
    if ($("#rpm").val() == '') {
        access = false;
    }
    return access;
}
function caribarang(dex) {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url + 'onmachine/caridatabarang',
        data: {
            sku: dex
        },
        success: function (data) {
            if (data.length == '1') {
                if (data[0]['tb'] == 'tb_ref') {
                    var edata = data[0]['kode_brg'];
                } else {
                    var edata = data[0]['po'] + data[0]['item'] + data[0]['dis'];
                }
                // alert(edata);
                $("#insno").val(data[0].insno);
                isidata(edata, data[0]['tb']);
            } else {
                if (data.length == '0') {
                    pesan('Data tidak ada, cek data dan pastikan koneksi baik', 'info');
                } else {
                    if (adaspasi(dex)) {
                        var arrjd = dex.split(" ");
                        var jd = '';
                        for (let i = 0; i < arrjd.length; i++) {
                            jd += arrjd[i] + '/';
                        }
                        var jx = jd.trim();
                    } else {
                        var jx = dex;
                        // alert(jx);
                    }
                    // alert(jx);
                    $("#caribarang").attr('href', base_url + 'onmachine/caribarang/' + jx);
                    $("#caribarang").click();
                }
            }
        }
    })
}
function isidata(idx, tbx) {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url + 'onmachine/caribarangnya',
        data: {
            id: idx,
            tbl: tbx
        },
        success: function (data) {
            var xx = data[0].po == '' ? data[0].kode : data[0]['po'] + ' # ' + data[0].item + ' dis ' + data[0].dis;
            $("#po").val(data[0]['po']);
            $("#item").val(data[0]['item']);
            $("#dis").val(data[0]['dis']);
            $("#spek").val(data[0]['spek']);
            $("#brg_id").val(data[0]['kode']);
            $("#sku").val(xx);
            // $("#insno").val(data[0]['insno']);
        }
    })
}