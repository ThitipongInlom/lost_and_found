$.fn.dataTable.ext.errMode = 'throw';
var table_all = $('#table_all').DataTable({
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "responsive": true,
    "fixedHeader": true,
    "aLengthMenu": [
        [10, 20, 25, -1],
        ["10", "20", "25", "ทั้งหมด"]
    ],
    "ajax": {
        "url": 'api/v1/get_type',
        "type": 'get',
    },
    "columns": [{
        "data": 'rownum',
        "name": 'rownum',
        "width": '5%',
    },{
        "data": 'item_type',
        "name": 'item_type',
        "width": '15%',
    },{
        "data": 'item_detail',
        "name": 'item_detail',
        "width": '35%',
    },{
        "data": 'place_found',
        "name": 'place_found',
        "width": '15%',
    },{
        "data": 'date_found',
        "name": 'date_found',
        "width": '10%',
    },{
        "data": 'action',
        "name": 'action',
        "width": '20%',
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": []
        },
        {
            "className": 'text-center',
            "targets": [0, 1, 4, 5]
        },{
            "className": 'text-right',
            "targets": []
        },{
            "className": 'text-truncate',
            "targets": [2]
        },
    ],
    "language": {
        "lengthMenu": "แสดง _MENU_ รายการ",
        "search": "ค้นหา:",
        "info": "แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ รายการ",
        "infoEmpty": "แสดง 0 ถึง 0 ทั้งหมด 0 รายการ",
        "infoFiltered": "(จาก ทั้งหมด _MAX_ ทั้งหมด รายการ)",
        "processing": "กำลังโหลดข้อมูล...",
        "zeroRecords": "ไม่มีข้อมูล",
        "paginate": {
            "first": "หน้าแรก",
            "last": "หน้าสุดท้าย",
            "next": "ต่อไป",
            "previous": "ย้อนกลับ"
        },
    },
    search: {
        "regex": true
    },
});

$('.daterange_single').daterangepicker({
    singleDatePicker: true,
    opens: 'right',
    drops: 'up',
    locale: {
        format: 'DD/MM/YYYY',
        applyLabel: "ยืนยัน",
        cancelLabel: "ยกเลิก",
        fromLabel: "จาก",
        toLabel: "ไปยัง",
        customRangeLabel: "กำหนดเอง",
        daysOfWeek: [
            "อา.",
            "จ.",
            "อ.",
            "พ.",
            "พฤ.",
            "ศ.",
            "ส."
        ],
        monthNames: [
            "มกราคม",
            "กุมภาพันธ์",
            "มีนาคม",
            "เมษายน",
            "พฤษภาคม",
            "มิถุนายน",
            "กรกฎาคม",
            "สิงหาคม",
            "กันยายน",
            "ตุลาคม",
            "พฤศจิกายน",
            "ธันวาคม"
        ],
    }
});

$(function () {
    $("#date_guest_select").hide();
    $(".file_hide").hide();
    $(".file_hide_edit").hide();
    $("#info_model_view").carousel({
        interval: 10000,
        pause: 'hover',
        mouseleave: true,
    });
});
$(document).ajaxComplete(function () {
    $('[data-toggle="tooltip"]').tooltip({
        "html": true,
    });
});

var Gen_upload_file = function Gen_upload_file() {
    // Click File
    if ($(".show_img_render").length == 0) {
        if ($('#file_1').get(0).files.length === 0) {
            $("#file_1").click();
            //console.log('File 1 Sub File 1');
        } else if ($('#file_2').get(0).files.length === 0) {
            $("#file_2").click();
            //console.log('File 1 Sub File 2');
        } else if ($('#file_3').get(0).files.length === 0) {
            $("#file_3").click();
            //console.log('File 1 Sub File 3');
        }
    }
    if ($(".show_img_render").length == 1) {
        if ($('#file_2').get(0).files.length === 0) {
            $("#file_2").click();
            //console.log('File 2 Sub File 2');
        } else if ($('#file_3').get(0).files.length === 0) {
            $("#file_3").click();
            //console.log('File 2 Sub File 3');
        } else if ($('#file_1').get(0).files.length === 0) {
            $("#file_1").click();
            //console.log('File 2 Sub File 1');
        }
    }
    if ($(".show_img_render").length == 2) {
        if ($('#file_3').get(0).files.length === 0) {
            $("#file_3").click();
            //console.log('File 3 Sub File 3');
        } else if ($('#file_1').get(0).files.length === 0) {
            $("#file_1").click();
            //console.log('File 3 Sub File 1');
        } else if ($('#file_2').get(0).files.length === 0) {
            $("#file_2").click();
            //console.log('File 3 Sub File 2');
        }
    }

    // Check length
    if ($(".show_img_render").length == 2) {
        $(".pic").hide();
    } else {
        $(".pic").show();
    }

    // Remove Img
    $(".images").on('click', '.img', function () {
        // Remove
        $(this).remove();
        var Img_load = $(this).attr('img_load');
        $("#" + Img_load + "").val("");
        //console.log('Remove '+Img_load);
        // Check length
        if ($(".show_img_render").length > 2) {
            $(".pic").hide();
        } else {
            $(".pic").show();
        }
    });
}

var GenImg_preview = function GenImg_preview() {
    if ($(".show_img_render").length == 0) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_1" style="background-image: url(\'' + event.target.result + '\');"><span>ลบรูปภาพ</span></div>');
        };
        reader.readAsDataURL($("#file_1")[0].files[0]);
    }
    if ($(".show_img_render").length == 1) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_2" style="background-image: url(\'' + event.target.result + '\');"><span>ลบรูปภาพ</span></div>');
        };
        reader.readAsDataURL($("#file_2")[0].files[0]);
    }
    if ($(".show_img_render").length == 2) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_3" style="background-image: url(\'' + event.target.result + '\');"><span>ลบรูปภาพ</span></div>');
        };
        reader.readAsDataURL($("#file_3")[0].files[0]);
    }
}

var Open_model_add = function Open_model_add() {
    $('#model_crate_add').modal({
        backdrop: 'static',
        show: true
    });
    $("body").css("padding-right", "0");
}

$('#model_crate_add').on('hidden.bs.modal', function (e) {
    Set_add_model_null();
});

var Open_model_info = function Open_model_info(e) {
    $('#model_crate_info').modal('show');
    $("body").css("padding-right", "0");
    $(".model_view_chk_date").hide();
    var list_item_id = $(e).attr('list_item_id');
    // Data
    var Data = new FormData();
    Data.append('list_item_id', list_item_id);
    // Ajax
    $.ajax({
        url: 'api/v1/view_item',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (res) {
            // Guest Name
            if (res.data.guest_name != '-') {
                $(".model_view_chk_date").show();
                $("#view_chk_in_date").val(moment(res.data.check_in_date).format('DD/MM/YYYY'));
                $("#view_chk_in_date").val(moment(res.data.check_out_date).format('DD/MM/YYYY'));
            }
            $("#view_item_id").val(res.data.list_id);
            $("#view_item_type").val(res.data.item_type);
            $("#view_locate_found").val(res.data.place_found);
            $("#view_item_detail").val(res.data.item_detail);
            $("#view_guest_name").val(res.data.guest_name);
            $("#view_date_found").val(moment(res.data.date_found).format('DD/MM/YYYY'));
            $("#view_found_by").val(res.data.found_by);
            $("#view_locate_track").val(res.data.locate_track);
            $("#view_record_by").val(res.data.record_by);
            // IMG
            // Reset Img 
            $("#carousel-indicators-1").remove();
            $("#carousel-inner-1").remove();
            $("#div-inner-1").remove();
            $("#carousel-indicators-2").remove();
            $("#carousel-inner-item-2").remove();
            $("#div-inner-2").remove();
            $("#carousel-indicators-3").remove();
            $("#carousel-inner-item-3").remove();
            $("#div-inner-3").remove();
            $(".carousel-control-prev").remove();
            $(".carousel-control-next").remove();
            // Add Img
            if (res.data.img_1 != null) {
                $(".carousel-indicators").append('<li data-target="#info_model_view" data-slide-to="0" id="carousel-indicators-1" class="active"></li>');
                $(".carousel-inner").append('<div class="carousel-item active" id="div-inner-1"><img src="" id="carousel-inner-1" class="d-block rounded" width="200" height="150"></div>');
                $("#carousel-inner-1").attr('src', 'img/main/' + res.data.img_1);
            }
            if (res.data.img_2 != null) {
                $(".carousel-indicators").append('<li data-target="#info_model_view" data-slide-to="1" id="carousel-indicators-2"></li>');
                $(".carousel-inner").append('<div class="carousel-item" id="div-inner-2"><img src="" id="carousel-inner-2" class="d-block rounded" width="200" height="150"></div>');
                $("#carousel-inner-2").attr('src', 'img/main/' + res.data.img_2);
            }
            if (res.data.img_3 != null) {
                $(".carousel-indicators").append('<li data-target="#info_model_view" data-slide-to="2" id="carousel-indicators-3"></li>');
                $(".carousel-inner").append('<div class="carousel-item" id="div-inner-3"><img src="" id="carousel-inner-3" class="d-block rounded" width="200" height="150"></div>');
                $("#carousel-inner-3").attr('src', 'img/main/' + res.data.img_3);
            }
            // Add Next IMG
            if (res.data.img_2 != null || res.data.img_3 != null) {
                $(".carousel-control-prev-view").prepend('<a class="carousel-control-prev" href="#info_model_view" role="button" data-slide="prev"><span class="carousel-control-prev-icon" style="background-color: #000000;" aria-hidden="true"></span><span class="sr-only">ย้อนกลับ</span></a>');
                $(".carousel-control-next-view").prepend('<a class="carousel-control-next" href="#info_model_view" role="button" data-slide="next"><span class="carousel-control-next-icon" style="background-color: #000000;" aria-hidden="true"></span><span class="sr-only">ต่อไป</span></a>');
            }
        }
    });
}

var Save_model_add = function Save_model_add() {
    var Toastr = Set_Toastr();
    var Check_rows = Check_null_input();
    // Laading  Options
    var loading = Ladda.create(document.querySelector('.btn-loading'));
    loading.start();
    loading.setProgress(5);
    if (Check_rows == true) {
        loading.setProgress(50);
        // DATA
        var Data = new FormData();
        Data.append('place_found', $("#place_found").val());
        Data.append('item_type', $("#item_type").val());
        Data.append('item_detail', $("#item_detail").val());
        Data.append('date_found', $("#date_found").val());
        Data.append('guest_name', $("#guest_name").val());
        Data.append('check_in_date', $("#check_in_date").val());
        Data.append('check_out_date', $("#check_out_date").val());
        Data.append('found_by', $("#found_by").val());
        Data.append('locate_track', $("#locate_track").val());
        Data.append('record_by', $("#record_by").val());
        Data.append('img_1', $("#file_1").prop('files')[0]);
        Data.append('img_2', $("#file_2").prop('files')[0]);
        Data.append('img_3', $("#file_3").prop('files')[0]);
        // Ajax
        $.ajax({
            url: 'api/v1/save_add',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (res) {
                Toastr["success"](res.error_text);
                $('#model_crate_add').modal('hide');
                var table = $('#table_all').DataTable();
                table.draw();
                loading.remove();
                Set_add_model_null();
            }
        }).always(
            function () {
                loading.setProgress(45);
                setTimeout(function () {
                    loading.remove();
                }, 500);
            }
        );
    } else {
        Toastr["error"]("กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
        loading.remove();
    }
}

var Open_model_edit = function Open_model_edit(e) {
    var Toastr = Set_Toastr();
    $('#model_crate_edit').modal('show');
    $("body").css("padding-right", "0");
    var list_item_id = $(e).attr('list_item_id');
    $("#date_guest_select_edit").hide();
    // Data
    var Data = new FormData();
    Data.append('list_item_id', list_item_id);
    // Ajax
    $.ajax({
        url: 'api/v1/edit_item',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (res) {
            // Guest Name
            if (res.data.guest_name != '-') {
                $("#date_guest_select_edit").show();
                $("#edit_chk_in_date").val(moment(res.data.check_in_date).format('DD/MM/YYYY'));
                $("#edit_chk_in_date").val(moment(res.data.check_out_date).format('DD/MM/YYYY'));
            }
            $("#edit_item_id").val(res.data.list_id);
            $("#edit_item_type").val(res.data.item_type);
            $("#edit_locate_found").val(res.data.place_found);
            $("#edit_item_detail").val(res.data.item_detail);
            $("#edit_guest_name").val(res.data.guest_name);
            $("#edit_date_found").val(moment(res.data.date_found).format('DD/MM/YYYY'));
            $("#edit_found_by").val(res.data.found_by);
            $("#edit_locate_track").val(res.data.locate_track);
            $("#edit_record_by").val(res.data.record_by);
            // Remove Value
            $("#edit_img_div_1").remove();
            $("#edit_img_div_2").remove();
            $("#edit_img_div_3").remove();
            $("#edit_img_div_add_1").remove();
            $("#edit_img_div_add_2").remove();
            $("#edit_img_div_add_3").remove();
            $("#file_edit_1").val('');
            $("#file_edit_2").val('');
            $("#file_edit_3").val('');
            // Add IMG  
            if (res.data.img_1 != null) {
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 mt-1 text-center" id="edit_img_div_1"><span class="badge badge-primary" name_img="' + res.data.img_1 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">ดูรูปภาพ</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '"  name_img="' + res.data.img_1 + '" style="cursor: pointer;" onclick="Delete_Image(this,1);">ลบรูปภาพ</span></div>');
            }
            if (res.data.img_2 != null) {
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 text-center" id="edit_img_div_2"><span class="badge badge-primary" name_img="' + res.data.img_2 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">ดูรูปภาพ</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '" name_img="' + res.data.img_2 + '" style="cursor: pointer;" onclick="Delete_Image(this,2);">ลบรูปภาพ</span></div>');
            }
            if (res.data.img_3 != null) {
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 text-center" id="edit_img_div_3"><span class="badge badge-primary" name_img="' + res.data.img_3 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">ดูรูปภาพ</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '" name_img="' + res.data.img_3 + '" style="cursor: pointer;" onclick="Delete_Image(this,3);">ลบรูปภาพ</span></div>');
            }
            // Check IMG SUM
            if ($(".show_img_edit_render").length == 1) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>เพิ่มรูปภาพ 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>เพิ่มรูปภาพ 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>เพิ่มรูปภาพ 3</b></div>');
                }
            } else if ($(".show_img_edit_render").length == 2) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>เพิ่มรูปภาพ 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>เพิ่มรูปภาพ 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>เพิ่มรูปภาพ 3</b></div>');
                }
            } else if ($(".show_img_edit_render").length == 3) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>เพิ่มรูปภาพ 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>เพิ่มรูปภาพ 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>เพิ่มรูปภาพ 3</b></div>');
                }
            }
        }
    });
}

var file_edit_select = function file_edit_select(e,mode) {
    // Open Select file
    if (e == '1' && mode == '77') {
        $("#file_edit_1").click();
    } else if (e == '2' && mode == '77') {
        $("#file_edit_2").click();
    } else if (e == '3' && mode == '77') {
        $("#file_edit_3").click();
    }
    // onchange
    if (e == '1' && mode == '100') {
        $("#edit_img_div_add_1").html('<i class="fas fa-image"></i> <b>รอ บันทึกรูปภาพ</b>');
    } else if (e == '2' && mode == '100') {
        $("#edit_img_div_add_2").html('<i class="fas fa-image"></i> <b>รอ บันทึกรูปภาพ</b>');
    } else if (e == '3' && mode == '100') {
        $("#edit_img_div_add_3").html('<i class="fas fa-image"></i> <b>รอ บันทึกรูปภาพ</b>');
    }
}

var OpenImage_windows = function OpenImage_windows(e) {
	var partimg = $(e).attr("name_img");
	var New_winwodws;
    New_winwodws = window.open("img/main/" + partimg, "", "width=600, height=600");
	New_winwodws.onload = function () {
		setTimeout(function () {
		    $(New_winwodws.document).find('html').append('<head><title>Show Image View</title></head>');
		}, 500);
	}
}

var Delete_Image = function Delete_Image(e,number) {
    // Data
    var Data = new FormData();
    Data.append('list_id', $(e).attr('list_id'));
    Data.append('img_name', $(e).attr('name_img'));
    Data.append('img_number', number);
    // Ajax
    $.ajax({
        url: 'api/v1/delete_img',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (res) {
            if (number == '1') {
                $("#edit_img_div_1").html('<b><i class="fas fa-trash"></i> ลบรูปภาพเสร็จสิ้น</b>');
            } else if (number == '2') {
                $("#edit_img_div_2").html('<b><i class="fas fa-trash"></i> ลบรูปภาพเสร็จสิ้น</b>');
            } else if (number == '3') {
                $("#edit_img_div_3").html('<b><i class="fas fa-trash"></i> ลบรูปภาพเสร็จสิ้น</b>');
            }
        }
    });
}

var Save_model_edit = function Save_model_edit(e) {
    var Toastr = Set_Toastr();
    // Laading  Options
    var loading = Ladda.create(e);
    loading.start();
    loading.setProgress(50);
    // DATA
    var Data = new FormData();
    Data.append('list_id', $("#edit_item_id").val());
    Data.append('place_found', $("#edit_locate_found").val());
    Data.append('item_type', $("#edit_item_type").val());
    Data.append('item_detail', $("#edit_item_detail").val());
    Data.append('date_found', $("#edit_date_found").val());
    Data.append('guest_name', $("#edit_guest_name").val());
    Data.append('check_in_date', $("#edit_chk_in_date").val());
    Data.append('check_out_date', $("#edit_chk_out_date").val());
    Data.append('found_by', $("#edit_found_by").val());
    Data.append('locate_track', $("#edit_locate_track").val());
    Data.append('record_by', $("#edit_record_by").val());
    Data.append('img_1', $("#file_edit_1").prop('files')[0]);
    Data.append('img_2', $("#file_edit_2").prop('files')[0]);
    Data.append('img_3', $("#file_edit_3").prop('files')[0]);
    // Ajax
    $.ajax({
        url: 'api/v1/save_edit',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (res) {
            Toastr["success"](res.error_text);
            $('#model_crate_edit').modal('hide');
            var table = $('#table_all').DataTable();
            table.draw();
            loading.remove();
        }
    }).always(
        function () {
            loading.setProgress(45);
            setTimeout(function () {
                loading.remove();
            }, 500);
        }
    );
}

var Open_model_delete = function Open_model_delete(e) {
    var Toastr = Set_Toastr();
    $('#model_crate_delete').modal('show');
    $("body").css("padding-right", "0");
    $("#model_delete_id_view").html($(e).attr('list_item_id'));
    $("#model_submit_delete").click(function () {
        var loading = Ladda.create(this);
        loading.start();
        loading.setProgress(5);
        var Data = new FormData();
        Data.append('list_item_id', $(e).attr('list_item_id'));
        // Ajax
        $.ajax({
            url: 'api/v1/delete_item',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (res) {
                Toastr["success"](res.error_text);
                $('#model_crate_delete').modal('hide');
                var table = $('#table_all').DataTable();
                table.draw();
                loading.remove();
            }
        }).always(
            function () {
                loading.setProgress(45);
                setTimeout(function () {
                    loading.remove();
                }, 500);
            }
        );
    });
}

var Set_add_model_null = function Set_add_model_null() {
    $("#place_found").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#item_type").val('off').removeClass('is-valid').removeClass('is-invalid');
    $("#item_detail").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#guest_name").val('');
    $("#check_in_date").val('');
    $("#check_out_date").val('');
    $("#found_by").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#locate_track").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#record_by").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#file_1").val('');
    $("#file_2").val('');
    $("#file_3").val('');
    $("#date_found").removeClass('is-valid').removeClass('is-invalid');
    $("#card_img").removeClass('border-success').removeClass('border-danger');
    $(".show_img_render").remove();
    $(".file_hide").hide();
}

var Check_null_input = function Check_null_input () {
    var Check_null_place_found = function Check_null_place_found() {
        if ($("#place_found").val() == '') {
            $("#place_found").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#place_found").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_item_type = function Check_null_item_type() {
        if ($("#item_type").val() == 'off') {
            $("#item_type").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#item_type").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_item_detail = function Check_null_item_detail() {
        if ($("#item_detail").val() == '') {
            $("#item_detail").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#item_detail").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_date_found = function Check_null_date_found() {
        if ($("#date_found").val() == '') {
            $("#date_found").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#date_found").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_found_by = function Check_null_found_by() {
        if ($("#found_by").val() == '') {
            $("#found_by").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#found_by").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_locate_track = function Check_null_locate_track() {
        if ($("#locate_track").val() == '') {
            $("#locate_track").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#locate_track").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_record_by = function Check_null_record_by() {
        if ($("#record_by").val() == '') {
            $("#record_by").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#record_by").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var Check_null_item_img = function Check_null_item_img() {
        if ($(".show_img_render").length == '0') {
            $("#card_img").removeClass('border-success').addClass('border-danger');
            return false;
        } else {
            $("#card_img").removeClass('border-danger').addClass('border-success');
            return true;
        }
    }
    var success_rows = 0;
    var error_rows = 0;
    var Check_null_place_found = Check_null_place_found() == true ? success_rows++ : error_rows++;
    var Check_null_item_type = Check_null_item_type() == true ? success_rows++ : error_rows++;
    var Check_null_item_detail = Check_null_item_detail() == true ? success_rows++ : error_rows++;
    var Check_null_date_found = Check_null_date_found() == true ? success_rows++ : error_rows++;
    var Check_null_found_by = Check_null_found_by() == true ? success_rows++ : error_rows++;
    var Check_null_locate_track = Check_null_locate_track() == true ? success_rows++ : error_rows++;
    var Check_null_record_by = Check_null_record_by() == true ? success_rows++ : error_rows++;
    var Check_null_item_img = Check_null_item_img() == true ? success_rows++ : error_rows++;
    var result = success_rows == 8 ? true : false;
    return result;
}

var Set_Toastr = function name() {
    // Toastr Options
    Toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    return Toastr;
}

var date_guest_select_check = function date_guest_select_check(e) {
    if ($("#guest_name").keyup || $("#guest_name").keydown) {
        if ($("#guest_name").val().length > 1) {
            $("#date_guest_select").show();
        } else {
            $("#date_guest_select").hide();
        }
    }
}

var date_guest_select_edit_check = function date_guest_select_edit_check(e) {
    if ($("#edit_guest_name").keyup || $("#edit_guest_name").keydown) {
        if ($("#edit_guest_name").val().length > 1) {
            $("#date_guest_select_edit").show();
        } else {
            $("#date_guest_select_edit").hide();
        }
    }
}