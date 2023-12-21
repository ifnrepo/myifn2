$(document).ready(function () {
	// alert('Ada');
});
$("#tambahdatasublok").click(function () {
	var mode = $(this).text();
	if (mode.trim() == "Tambah") {
		$(this).text("Simpan");
		$("#deptsublok").attr("disabled", false);
		$("#formsublok").attr("action", base_url + "Sublok/addsublok");
	} else {
		if (mode.trim() != "Tambah") {
			if ($("#deptsublok").val() == "") {
				pesan("Data Departemen kosong", "info");
			} else {
				if ($("#nmsublok").val() == "") {
					pesan("Isi Data Sublok !", "info");
				} else {
					$.when(kodesama()).then(function (data) {
						if (data.length > 0) {
							pesan("Sublok ada yang sama, cek data !", "info");
						} else {
							$("#formsublok").submit();
						}
					});
				}
			}
		}
	}
});
$("#resetdatasublok").click(function () {
	kosongkan();
});
$("#deptsublok").change(function () {
	if ($(this).attr("disabled", false)) {
		isikode($(this).val());
	}
});
function kodesama() {
	var dept = $("#deptsublok").val();
	var nama = $("#nmsublok").val();
	return $.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "sublok/ceksubloksama",
		data: {
			dta: dept,
			nm: nama,
		},
	});
}
$(document).on("click", "#editdatasublok", function () {
	var dept = $(this).attr("rel");
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "sublok/getdatasublok",
		data: {
			dta: dept,
		},
		success: function (data) {
			if (data.length == 1) {
				// $("#deptsublok").attr('disabled', false);
				$("#deptsublok").val(data[0]["dept_id"]);
				$("#deptt").val(data[0]["dept_id"]);
				$("#idsublok").val(data[0]["id"]);
				$("#nmsublok").val(data[0]["sublok"]);
				$("#kdsublok").val(data[0]["kode"]);
				$("#tambahdatasublok").text("Update");
				$("#formsublok").attr("action", base_url + "Sublok/editsublok");
			} else {
				pesan("Data tidak ada !", "info");
			}
		},
	});
});

function kosongkan() {
	$("#tambahdatasublok").text("Tambah");
	$("#formsublok").attr("action", "");
	$("#deptsublok").val("");
	$("#kdsublok").val("");
	$("#nmsublok").val("");
	$("#idsublok").val("");
	$("#deptsublok").attr("disabled", true);
	$("#deptsublok").focus();
}
function isikode(dept) {
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "sublok/carikode",
		data: {
			dta: dept,
		},
		success: function (data) {
			// alert(data[0]);
			if (data == "") {
				$("#kdsublok").val(dept + "001");
			} else {
				// $("#kdsublok").val(data[0]['kode']);
				var hasil = data[0]["kode"];
				var angka1 = parseInt(hasil.substring(2, 5)) + 1;
				if (angka1 <= 9) {
					$("#kdsublok").val(dept + "00" + angka1);
				} else if (angka1 <= 99) {
					$("#kdsublok").val(dept + "0" + angka1);
				} else {
					$("#kdsublok").val(dept + angka1);
				}
			}
			$("#nmsublok").focus();
		},
	});
}
