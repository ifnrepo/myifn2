$(document).ready(function () {
	var g = $(window).width();
});
$("#simpanprofile").click(function () {
	var ind = $("#noinduk").val();
	var nam = $("#nama").val();
	var bag = $("#bagian").val();
	var jab = $("#jabatan").val();
	var lev = $("#levelid").val();
	var log = $("#login").val();
	var pas = $("#password").val();
	var klm = $("#jenkel").val();
	var tif = $("#aktif").val();

	if (nam == "") {
		pesan("Nama harus di isi", "info");
		return false;
	}
	if (lev == "0") {
		pesan("Pilih Level", "info");
		return false;
	}
	if (log == "") {
		pesan("Nama Login harus di isi", "info");
		return false;
	}
	if (pas == "") {
		pesan("Password harus di isi", "info");
		return false;
	}
	var isi = "";
	for (let x = 1; x < 22; x++) {
		if ($("#cek" + x).prop("checked")) {
			isi = isi.trim() + $("#cek" + x).attr("rel") + ",";
		}
	}
	var idx = $("#idprofil").val();
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "user/simpanuser",
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
			tif: tif,
		},
		success: function (data) {
			// alert(data);
			if (data.length == "1") {
				pesan("Data berhasil disimpan !", "success");
				setTimeout(() => {
					window.location.reload();
				}, 2000);
			} else {
				pesan("Data tidak ada, cek data dan pastikan koneksi baik", "info");
			}
		},
	});
});
$("#updateprofile").click(function () {
	var ind = $("#noinduk").val();
	var nam = $("#nama").val();
	var bag = $("#bagian").val();
	var jab = $("#jabatan").val();
	var lev = $("#levelid").val();
	var log = $("#login").val();
	var pas = $("#password").val();
	var klm = $("#jenkel").val();
	var tif = $("#aktif").val();
	if (nam == "") {
		pesan("Nama harus di isi", "info");
		return false;
	}
	if (lev == "0") {
		pesan("Pilih Level", "info");
		return false;
	}
	if (log == "") {
		pesan("Nama Login harus di isi", "info");
		return false;
	}
	if (pas == "") {
		pesan("Password harus di isi", "info");
		return false;
	}
	var isi = "";
	for (let x = 1; x < 22; x++) {
		if ($("#cek" + x).prop("checked")) {
			isi = isi.trim() + $("#cek" + x).attr("rel") + ",";
		}
	}
	var idx = $("#idprofil").val();
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "user/updateprofil",
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
			tif: tif,
		},
		success: function (data) {
			// alert(data);
			if (data.length == "1") {
				pesan("Data berhasil disimpan", "success");
				$("#kembaliprofil").click();
			} else {
				pesan("Data tidak ada, cek data dan pastikan koneksi baik", "info");
			}
		},
	});
});
$("#cekpass").click(function () {
	var isi = $(this).html();
	if (isi == '<i class="fas fa-eye"></i>') {
		$(this).html('<i class="fas fa-eye-slash"></i>');
		$("#password").attr("type", "text");
	} else {
		$(this).html('<i class="fas fa-eye"></i>');
		$("#password").attr("type", "password");
	}
});
