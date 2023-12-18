$(document).ready(function () {
	// alert('OKEOKE');
	$("#skubarang").val("").focus();
	$("#kodeupd").val("opname/isidata");
	var g = $(window).width();
});
// $('#jmlpcs').on('change click keyup input paste', (function (event) {
//     $(this).val(function (index, value) {
//         return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//     });
// }));
// $('#jmlkgs').on('change click keyup input paste', (function (event) {
//     $(this).val(function (index, value) {
//         return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//     });
// }));

$("#skubarang").keyup(function (e) {
	var tex = $(this).val();
	if (tex != "" && e.keyCode == 13) {
		if (tex.length >= 4) {
			caribarang(tex);
		} else {
			pesan("Minimal 4 Digit untuk pencarian", "info");
		}
	}
});

$("#skubale").keyup(function (e) {
	var tex = $(this).val();
	if (tex != "" && e.keyCode == 13) {
		caribale(tex);
	}
});

$("#addstoktaking").click(function () {
	// $("#skubarang").keyup(function(13));
	var tex = $("#skubarang").val();
	if ($("#skubale").val() != "") {
		caribale($("#skubale").val());
	} else {
		if (tex.length >= 4) {
			caribarang(tex);
		} else {
			pesan("Minimal 4 Digit untuk pencarian", "info");
		}
	}
});

$("#resetdata").click(function () {
	kosongkan();
	$("#skubarang").val("").focus();
	location.reload();
});

$("#tambahdata").click(function () {
	var vl1 = $("#brgid").val();
	var vl2 = $("#po").val();
	var mode = $("#kodeupd").val();
	var vl3 = $("#jmlkgs").val();
	var vl4 = $("#jmlpcs").val();
	// $("#satuan").change();
	if (vl1 == "" && vl2 == "") {
		pesan("Isi data terlebih dahulu", "info");
	} else {
		var kgs = $("#jmlkgs").val();
		if (
			$("#satuan option:selected").text().trim() == "PCS" &&
			$("#po").val() == ""
		) {
			// var kgs = '';
		}
		var dp = $("#iddept").val();
		if (dp == "GF" && $("#nobale").val() == "") {
			pesan("Nobale Harus di isi", "error");
			return false;
		}
		var br = $("#br").prop("checked") ? "1" : "0";
		if (dp == "NT" && $("#po").val() != "") {
			var br = "1";
		}
		if (vl3 == "" || vl3 == "0" || vl4 == "" || vl4 == "0") {
			pesan("jumlah dan Kgs tidak Boleh kosong !", "error");
			return false;
		} else {
			var id = $("#idopn").val();
			var po = $("#po").val();
			var item = $("#item").val();
			var dis = $("#dis").val();
			var brg = $("#brgid").val();
			var spe = $("#spek").val();
			var pcs = $("#jmlpcs").val();
			var stn = $("#satuan").val();
			var ket = $("#ket").val();
			var pc2 = $("#pcsg").val();
			var id2 = $("#xid").val();
			var hlm = $("#hlm").val();
			var dok = $("#dok").val();
			var ins = $("#insno").val();
			var ble = $("#nobale").val();
			var rut = $("#norut").val();
			var exnt = $("#exnet").prop("checked") ? "1" : "0";
			$.ajax({
				dataType: "json",
				type: "POST",
				url: base_url + mode,
				data: {
					xid: id,
					xpo: po,
					xitem: item,
					xdis: dis,
					xbrg: brg,
					xspe: spe,
					xpcs: pcs,
					xstn: stn,
					xkgs: kgs,
					xket: ket,
					xpc2: pc2,
					xid2: id2,
					xhlm: hlm,
					xdok: dok,
					xins: ins,
					xble: ble,
					xbr: br,
					xnt: exnt,
					xru: rut,
				},
				success: function (data) {
					if (data.length == "1") {
						pesan("Data berhasil disimpan", "success");
						$("#resetdata").click();
						window.location.reload();
					} else {
						pesan("Error, Cek data dan pastikan koneksi baik", "error");
					}
				},
			});
		}
	}
});

$(document).on("click", "#editdataopname", function () {
	var rel = $(this).attr("rel");
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "opname/caridatabrgopname",
		data: {
			id: rel,
		},
		success: function (data) {
			if (data[0]["jntb"] == "tb-po") {
				$("#kgsg").val(data[0]["kgs"] / data[0]["jumlah"]);
			}
			let cek = data[0].br == "0" ? false : true;
			let nte = data[0].exnet == "0" ? false : true;
			$("#sku").val(
				ponodis(
					data[0]["po"],
					data[0]["item"],
					data[0]["dis"],
					data[0]["kode_brg"]
				)
			);
			$("#skubarang").val(
				ponodis(
					data[0]["po"],
					data[0]["item"],
					data[0]["dis"],
					data[0]["kode_brg"]
				)
			);
			$("#po").val(data[0]["po"]);
			$("#item").val(data[0]["item"]);
			$("#dis").val(data[0]["dis"]);
			$("#jntb").val(data[0]["jntb"]);
			$("#brgid").val(data[0]["kode_brg"]);
			$("#spek").val(data[0]["spek"]);
			$("#idtb").val(data[0]["id"]);
			$("#color").val(data[0]["color"]);
			$("#insno").val(data[0]["insno"]);
			$("#norut").val(data[0]["norut"]);
			if (data[0]["pcs"] == "0") {
				$("#jmlpcs").val(data[0]["kgs"]);
			} else {
				$("#jmlpcs").val(data[0]["pcs"]);
			}
			$("#jmlkgs").val(data[0]["kgs"]);
			$("#satuan").val(data[0]["id_satuan"]);
			$("#hlm").val(data[0]["hlm"]);
			$("#dok").val(data[0]["dok"]);
			$("#nobale").val(data[0]["nobale"]);
			$("#ket").val(data[0]["ket"]);
			$("#br").prop("checked", cek);
			$("#exnet").prop("checked", nte);
			$("#kodeupd").val("opname/editdata");
			$("#xid").val(rel);
			$("#norut").removeAttr("readonly");
		},
	});
});

$("#satuan").change(function () {
	$("#pcsg").val("");
	$("#jmlkgs").val("");
	var jmlpcs = $("#jmlpcs").val();
	var sat = $("#satuan option:selected").text();
	var po = $("#po").val();
	if (sat.trim() != "SET") {
		if (jmlpcs != "" || jmlpcs != "0") {
			if (sat.trim() == "PCS") {
				$("#pcsg").val(jmlpcs);
				if (po != "") {
					var hasil =
						parseFloat($("#jmlpcs").val()) * parseFloat($("#kgsg").val());
					$("#jmlkgs").val(rupiah(hasil, ".", ",", 3));
				} else {
					$("#jmlkgs").val(jmlpcs);
				}
			} else {
				if (sat.trim() == "KGS") {
					$("#jmlkgs").val(jmlpcs);
				}
			}
		}
	} else {
		if ($("#item").val().includes("-1")) {
			$.when(hitungset()).then(function (data) {
				if (data.length > 0) {
					if (jmlpcs != "" || jmlpcs != "0") {
						var hasil =
							parseFloat($("#jmlpcs").val()) * parseFloat(data[0].berat);
						$("#jmlkgs").val(rupiah(hasil, ".", ",", 3));
					}
				} else {
					pesan("Data tidak ditemukan !", "info");
				}
			});
		} else {
			pesan("Harap Pilih jala A !", "info");
		}
	}
});
var onfoc;
$("#jmlpcs").blur(function () {
	if (onfoc != $(this).val()) {
		if ($("#satuan").val() != "") {
			$("#satuan").change();
		}
	}
});
$("#jmlpcs").focus(function () {
	onfoc = $(this).val();
});

$("#scanbarang").click(function () {
	pesan("Sedang dalam tahap pembuatan !", "info");
});

$(document).on("click", "#chk2", function () {
	var cek = $(this).val();
	alert(cek);
	$("#tombol" + cek).click();
});

function hitungset() {
	var po = $("#po").val();
	var item = $("#item").val();
	return $.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "opname/caribarangset",
		data: {
			xpo: po,
			xitem: item,
		},
	});
}

function caribale(dex) {
	xed = $("#skubarang").val();
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "opname/caribale",
		data: {
			sku: dex,
			uks: xed,
		},
		success: function (data) {
			// alert(data.length);
			if (data.length == "1") {
				if (data[0]["tb"] == "tb_ref") {
					var edata = data[0]["kode_brg"];
				} else {
					var edata = data[0]["po"] + data[0]["item"] + data[0]["dis"];
				}
				// alert(edata);
				isidata(edata, data[0]["tb"]);
				$("#nobale").val($("#skubale").val());
				$("#jmlpcs").val(data[0].stokpc);
				$("#jmlkgs").val(data[0].stokpc * data[0].stok);
				$("#satuan").val(data[0].id_satuan);
			} else {
				if (data.length == "0") {
					pesan("Data tidak ada, cek data dan pastikan koneksi baik", "info");
				} else {
					var ww = xed + " " + dex;
					if (adaspasi(ww)) {
						var arrjd = ww.split(" ");
						var jd = "";
						for (let i = 0; i < arrjd.length; i++) {
							jd += arrjd[i] + "/";
						}
						var jx = jd.trim();
					} else {
						var jx = dex;
					}
					// alert(jx);
					$("#caribarang").attr("href", base_url + "opname/caridatabale/" + jx);
					$("#caribarang").click();
				}
			}
		},
	});
}

function caribarang(dex) {
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "opname/caridatabarang",
		data: {
			sku: dex,
		},
		success: function (data) {
			if (data.length == "1") {
				if (data[0]["tb"] == "tb_ref") {
					var edata = data[0]["kode_brg"];
				} else {
					var edata = data[0]["po"] + data[0]["item"] + data[0]["dis"];
				}
				// alert(edata);
				isidata(edata, data[0]["tb"]);
			} else {
				if (data.length == "0") {
					pesan("Data tidak ada, cek data dan pastikan koneksi baik", "info");
				} else {
					if (adaspasi(dex)) {
						var arrjd = dex.split(" ");
						var jd = "";
						for (let i = 0; i < arrjd.length; i++) {
							jd += arrjd[i] + "/";
						}
						var jx = jd.trim();
					} else {
						var jx = dex;
						// alert(jx);
					}
					$("#caribarang").attr("href", base_url + "opname/caribarang/" + jx);
					$("#caribarang").click();
				}
			}
		},
	});
}

function isidata(idx, tbx) {
	$.ajax({
		dataType: "json",
		type: "POST",
		url: base_url + "opname/caribarangnya",
		data: {
			id: idx,
			tbl: tbx,
		},
		success: function (data) {
			if (data[0]["jntb"] == "tb-po") {
				$("#kgsg").val(data[0]["weight"]);
			}
			$("#sku").val(
				ponodis(
					data[0]["po"],
					data[0]["item"],
					data[0]["dis"],
					data[0]["brgid"]
				)
			);
			$("#skubarang").val(
				ponodis(
					data[0]["po"],
					data[0]["item"],
					data[0]["dis"],
					data[0]["brgid"]
				)
			);
			$("#po").val(data[0]["po"]);
			$("#item").val(data[0]["item"]);
			$("#dis").val(data[0]["dis"]);
			$("#jntb").val(data[0]["jntb"]);
			$("#brgid").val(data[0]["brgid"]);
			$("#spek").val(data[0]["spek"]);
			$("#idtb").val(data[0]["id"]);
			$("#color").val(data[0]["color"]);
			// $("#nobale").val(data[0]['nobale']);
			// $("#insno").val(data[0]['insno']);
			$("#jmlpcs").focus();
		},
	});
}

function kosongkan() {
	$("#sku").val("");
	$("#skubarang").val("");
	$("#po").val("");
	$("#item").val("");
	$("#dis").val("");
	$("#brgid").val("");
	$("#spek").val("");
	$("#jmlpcs").val("");
	$("#jmlkgs").val("");
	$("#ketopt").val("");
	$("#idtb").val("");
	$("#satuan").val("");
	$("#color").val("");
	$("#jntb").val("");
	$("#kgsg").val("");
	$("#xid").val("");
	$("#pcsg").val("");
	$("#dok").val("");
	$("#insno").val("");
	$("#nobale").val("");
	$("#skubale").val("");
	$("#br").prop("checked", false);
	$("#exnet").prop("checked", false);
	$("#kodeupd").val("opname/isidata");
}

function isikgs(tbl, jml) {
	if (tbl == "tb-brg") {
		$("#jmlkgs").val(jml);
	} else {
		var hsl = parseFloat(jml) * parseFloat($("#kgsg").val());
		$("#jmlkgs").val(hsl);
	}
}

function ww() {
	alert("GOL");
}
