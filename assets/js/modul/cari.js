$(document).ready(function () {

})
// $("#deptopname").change(function () {
//     $.ajax({
//         type: "POST",
//         url: base_url + 'opname/filterstokopname',
//         data: {
//             dta: $(this).val(),
//         },
//         success: function (data) {
//             // alert(data);
//             location.reload();
//         }
//     })
// })

$("#caribarang").click(function () {
    var po = $("#po").val();
    var de = $("#deptopname").val();
    $.ajax({
        type: "POST",
        url: base_url + 'caribarang/cari',
        data: {
            dta: po,
            atd: de
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    })
})

$("#resetbarang").click(function () {
    $.ajax({
        type: "POST",
        url: base_url + 'caribarang/clear',
        data: {
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    })
})