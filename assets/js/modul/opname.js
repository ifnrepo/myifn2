$(document).ready(function () {

})
$("#deptopname").change(function () {
    $.ajax({
        type: "POST",
        url: base_url + 'opname/filterstokopname',
        data: {
            dta: $(this).val(),
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    })
})

$("#carisublok").click(function () {
    if ($("#namasublok").val() != '') {
        $.ajax({
            type: "POST",
            url: base_url + 'opname/carisublok',
            data: {
                dta: $("#namasublok").val(),
            },
            success: function (data) {
                // alert(data);
                location.reload();
            }
        })
    }
})

$("#kosongkansublok").click(function () {
    $.ajax({
        type: "POST",
        url: base_url + 'opname/kosongkansublok',
        data: {
            dta: $("#namasublok").val(),
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    })
})