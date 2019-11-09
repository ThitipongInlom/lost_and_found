$.fn.dataTable.ext.errMode = 'throw';
var table_all = $('#table_all').DataTable({
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "responsive": true,
    "fixedHeader": true,
    "aLengthMenu": [
        [10, 20, -1],
        ["10", "20", "ทั้งหมด"]
    ],
    "ajax": {
        "url": 'api/v1/get_type',
        "type": 'get',
        "data": function (d) {
            d.type_select_table = $("#type_select_table").val();
        }
    },
    "columns": [{
        "data": 'list_id',
        "name": 'list_id',
        "width": '5%',
    },{
        "data": 'item_type',
        "name": 'item_type',
        "width": '10%',
    },{
        "data": 'item_detail',
        "name": 'item_detail',
        "width": '30%',
    },{
        "data": 'place_found',
        "name": 'place_found',
        "width": '15%',
    },{
        "data": 'place',
        "name": 'place',
        "width": '15%',
    },{
        "data": 'date_found',
        "name": 'date_found',
        "width": '10%',
    },{
        "data": 'return_item',
        "name": 'return_item',
        "width": '5%',
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
            "targets": [0, 4, 5, 6]
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
    "search": {
        "regex": true
    },
    "order": [
        [5, 'desc']
    ]
});

var Set_daterange_single = function Set_daterange_single() {
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
}

$(function () {
    Set_daterange_single();
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

var load_table_on_select = function load_table_on_select() {
    var table = $('#table_all').DataTable();
    table.draw();
}

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
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var delete_img = 'ลบรูปภาพ';
    } else if (lang == 'en') {
        var delete_img = 'Delete photo';
    }
    if ($(".show_img_render").length == 0) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_1" style="background-image: url(\'' + event.target.result + '\');"><span>' + delete_img + '</span></div>');
        };
        reader.readAsDataURL($("#file_1")[0].files[0]);
    }
    if ($(".show_img_render").length == 1) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_2" style="background-image: url(\'' + event.target.result + '\');"><span>' + delete_img + '</span></div>');
        };
        reader.readAsDataURL($("#file_2")[0].files[0]);
    }
    if ($(".show_img_render").length == 2) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $(".images").prepend('<div class="img show_img_render" img_load="file_3" style="background-image: url(\'' + event.target.result + '\');"><span>' + delete_img + '</span></div>');
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
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var view = 'ดูข้อมูล';
        var close = 'ปิด';
        var turn_back = 'ย้อนกลับ';
        var next = 'ต่อไป';
    } else if (lang == 'en') {
        var view = 'View Data';
        var close = 'Close';
        var turn_back = 'Turn Back';
        var next = 'Next';
    }
    $('#model_crate_info').modal('show');
    $("body").css("padding-right", "0");
    $(".model_view_chk_date").hide();
    var list_item_id = $(e).attr('list_item_id');
    $("#head_model_info").removeClass('bg-danger').addClass('bg-info');
    $("#head_model_tital").html('<i class="fas fa-info"></i> ' + view);
    $("#footer_button_info").html('<div class="col-md-12"><button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ' + close + '</button></div>');
    // Display Model 
    $("#info_wait_display").hide();
    $("#info_trun_display").hide();
    $("#info_turn_1_display").hide();
    $("#info_turn_2_display").hide();
    $("#info_turn_3_display").hide();
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
            $("#carousel-inner-1").remove();
            $("#div-inner-1").remove();
            $("#carousel-inner-2").remove();
            $("#div-inner-2").remove();
            $("#carousel-inner-3").remove();
            $("#div-inner-3").remove();
            $(".carousel-control-prev").remove();
            $(".carousel-control-next").remove();
            // Add Img
            var img_default = "this.onerror=null;this.src='img/main/default.jpg';";
            if (res.data.img_1 != null) {
                $(".carousel-inner").append('<div class="carousel-item active" id="div-inner-1" name_img="' + res.data.img_1 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);"><img src="" id="carousel-inner-1" class="d-block rounded" width="200" height="150" onerror="' + img_default + '"></div>');
                $("#carousel-inner-1").attr('src', 'img/main/' + res.data.img_1);
            }
            if (res.data.img_2 != null) {
                $(".carousel-inner").append('<div class="carousel-item" id="div-inner-2" name_img="' + res.data.img_2 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);"><img src="" id="carousel-inner-2" class="d-block rounded" width="200" height="150" onerror="' + img_default + '"></div>');
                $("#carousel-inner-2").attr('src', 'img/main/' + res.data.img_2);
            }
            if (res.data.img_3 != null) {
                $(".carousel-inner").append('<div class="carousel-item" id="div-inner-3" name_img="' + res.data.img_3 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);"><img src="" id="carousel-inner-3" class="d-block rounded" width="200" height="150" onerror="' + img_default + '"></div>');
                $("#carousel-inner-3").attr('src', 'img/main/' + res.data.img_3);
            }
            // Add Next IMG
            if (res.data.img_2 != null || res.data.img_3 != null) {
                $(".carousel-control-prev-view").prepend('<a class="carousel-control-prev" href="#info_model_view" role="button" data-slide="prev"><span class="carousel-control-prev-icon" style="background-color: #000000;" aria-hidden="true"></span><span class="sr-only">' + turn_back + '</span></a>');
                $(".carousel-control-next-view").prepend('<a class="carousel-control-next" href="#info_model_view" role="button" data-slide="next"><span class="carousel-control-next-icon" style="background-color: #000000;" aria-hidden="true"></span><span class="sr-only">' + next + '</span></a>');
            }
            // info wait Display
            if (res.data.return_item == 'wait' || res.data.return_item == 'turn') {
                $("#info_wait_display").show();
                $("#info_item_out").val(res.data.name_item_out);
                $("#info_dep_item_out").val(res.data.dep_item_out);
                $("#info_date_item_out").val(moment(res.data.date_item_out).format('DD/MM/YYYY'));
                $("#info_print_type_send").val(res.data.type_item_out);
            }
            // info turn Display
            if (res.data.return_item == 'turn') {
                $("#info_trun_display").show();
                if (res.data.type_item_out == '1') {
                    $("#info_turn_1_display").show();
                    $("#info_return_type_1_name").val(res.data.name_return_guest);
                    $("#info_return_type_1_address").val(res.data.address_return_guest);
                    $("#info_return_type_1_date").val(moment(res.data.date_return_guest).format('DD/MM/YYYY'));
                    $("#info_return_type_1_phone").val(res.data.phone_return_guest);
                } else if (res.data.type_item_out == '2') {
                    $("#info_turn_2_display").show();
                    $("#info_return_type_2_name").val(res.data.name_return_guest);
                    $("#info_return_type_2_dep").val(res.data.dep_return_guest);
                    $("#info_return_type_2_address").val(res.data.address_return_guest);
                    $("#info_return_type_2_ems").val(res.data.ems_return_guest);
                } else if (res.data.type_item_out == '3') {
                    $("#info_turn_3_display").show();
                    $("#info_return_type_3_other").val(res.data.other_return_guest);
                }
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
        var lang = $('html').attr('lang');
        if (lang == 'th') {
            Toastr["error"]("กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
        } else if (lang == 'en') {
            Toastr["error"]("Please fill out all fields.");
        }
        loading.remove();
    }
}

var Open_model_edit = function Open_model_edit(e) {
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var add_pictures = 'เพิ่มรูปภาพ';
        var view_pictures = 'ดูรูปภาพ';
        var delete_pictures = 'ลบรูปภาพ';
    } else if (lang == 'en') {
        var add_pictures = 'Add pictures';
        var view_pictures = 'View';
        var delete_pictures = 'Delete';
    }
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
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 mt-1 text-center" id="edit_img_div_1"><span class="badge badge-primary" name_img="' + res.data.img_1 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">' + view_pictures + '</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '"  name_img="' + res.data.img_1 + '" style="cursor: pointer;" onclick="Delete_Image(this,1);">' + delete_pictures + '</span></div>');
            }
            if (res.data.img_2 != null) {
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 text-center" id="edit_img_div_2"><span class="badge badge-primary" name_img="' + res.data.img_2 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">' + view_pictures + '</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '" name_img="' + res.data.img_2 + '" style="cursor: pointer;" onclick="Delete_Image(this,2);">' + delete_pictures + '</span></div>');
            }
            if (res.data.img_3 != null) {
                $(".edit_img_div").append('<div class="edit_img_div_images show_img_edit_render mb-1 text-center" id="edit_img_div_3"><span class="badge badge-primary" name_img="' + res.data.img_3 + '" style="cursor: pointer;" onclick="OpenImage_windows(this);">' + view_pictures + '</span>  <span class="badge badge-danger" list_id="' + res.data.list_id + '" name_img="' + res.data.img_3 + '" style="cursor: pointer;" onclick="Delete_Image(this,3);">' + delete_pictures + '</span></div>');
            }
            // Check IMG SUM
            if ($(".show_img_edit_render").length == 1) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>' + add_pictures + ' 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>' + add_pictures + ' 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>' + add_pictures + ' 3</b></div>');
                }
            } else if ($(".show_img_edit_render").length == 2) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>' + add_pictures + ' 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>' + add_pictures + ' 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>' + add_pictures + ' 3</b></div>');
                }
            } else if ($(".show_img_edit_render").length == 3) {
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>' + add_pictures + ' 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>' + add_pictures + ' 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>' + add_pictures + ' 3</b></div>');
                }
            } else{
                if (res.data.img_1 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_1" style="cursor: pointer;" onclick="file_edit_select(1,77);"><b>' + add_pictures + ' 1</b></div>');
                }
                if (res.data.img_2 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_2" style="cursor: pointer;" onclick="file_edit_select(2,77);"><b>' + add_pictures + ' 2</b></div>');
                }
                if (res.data.img_3 == null) {
                    $(".edit_img_div").append('<div class="edit_img_div_images mb-1 text-center" id="edit_img_div_add_3" style="cursor: pointer;" onclick="file_edit_select(3,77);"><b>' + add_pictures + ' 3</b></div>');
                }
            }
        }
    });
}

var file_edit_select = function file_edit_select(e,mode) {
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var wait_save_picture = 'รอ บันทึกรูปภาพ';
    } else if (lang == 'en') {
        var wait_save_picture = 'Wait to save';
    }
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
        $("#edit_img_div_add_1").html('<i class="fas fa-image"></i> <b>' + wait_save_picture + '</b>');
    } else if (e == '2' && mode == '100') {
        $("#edit_img_div_add_2").html('<i class="fas fa-image"></i> <b>' + wait_save_picture + '</b>');
    } else if (e == '3' && mode == '100') {
        $("#edit_img_div_add_3").html('<i class="fas fa-image"></i> <b>' + wait_save_picture + '</b>');
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
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var finish_deleting_photos = 'ลบรูปภาพเสร็จสิ้น';
    } else if (lang == 'en') {
        var finish_deleting_photos = 'Finish deleting';
    }
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
                $("#edit_img_div_1").html('<b><i class="fas fa-trash"></i> ' + finish_deleting_photos + '</b>');
            } else if (number == '2') {
                $("#edit_img_div_2").html('<b><i class="fas fa-trash"></i> ' + finish_deleting_photos + '</b>');
            } else if (number == '3') {
                $("#edit_img_div_3").html('<b><i class="fas fa-trash"></i> ' + finish_deleting_photos + '</b>');
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
    var lang = $('html').attr('lang');
    if (lang == 'th') {
        var delete_data = 'ลบข้อมูล';
        var close = 'ปิด';
        var confirm_deletion = 'ยืนยันการลบข้อมูล';
    } else if (lang == 'en') {
        var delete_data = 'Delete Data';
        var close = 'Close';
        var confirm_deletion = 'Confirm data deletion';
    }
    var Toastr = Set_Toastr();
    var list_item_id = $(e).attr('list_item_id');
    this.Open_model_info('<div list_item_id="' + list_item_id + '"></div');
    $("#head_model_info").removeClass('bg-info').addClass('bg-danger');
    $("#head_model_tital").html('<i class="fas fa-trash"></i> ' + delete_data);
    $("#footer_button_info").html('<div class="col-md-6"><button class="btn btn-sm btn-block btn-primary" id="confirm_delete"><i class="fas fa-trash"></i> ' + confirm_deletion + '</button></div><div class="col-md-6"><button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ' + close + '</button></div>');
    $("#confirm_delete").on("click", function () {
    var Data = new FormData();
    Data.append('list_item_id', list_item_id);
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
            $('#model_crate_info').modal('hide');
            var table = $('#table_all').DataTable();
            table.draw();
        }
    });
    });
}

var Open_model_print = function Open_model_print(e) {
    var Toastr = Set_Toastr();
    var list_item_id = $(e).attr('list_item_id');
    $('#model_crate_print').modal('show');
    $("body").css("padding-right", "0");
    $("#print_tr_guest").hide();
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
            $("#print_itemid").html(res.data.list_id);
            $("#print_item_type").html(res.data.item_type);
            $("#print_place_found").html(res.data.place_found);
            $("#print_item_detail").html(res.data.item_detail);
            $("#print_date_found").html(moment(res.data.date_found).format('DD/MM/YYYY'));
            $("#print_found_by").html(res.data.found_by);
            $("#print_locate_track").html(res.data.locate_track);
            if (res.data.guest_name != '-') {
                $("#print_tr_guest").show();
                $("#print_guest_name").html(res.data.guest_name);
                $("#print_check_in_date").html(moment(res.data.check_in_date).format('DD/MM/YYYY'));
                $("#print_check_out_date").html(moment(res.data.check_out_date).format('DD/MM/YYYY'));
            }
            if (res.data.name_item_out != '') {
                $("#name_item_out").val(res.data.name_item_out);
            }
            if (res.data.dep_item_out != '') {
                $("#dep_item_out").val(res.data.dep_item_out);
            }
            if (res.data.type_item_out != null) {
                $("#print_type_send").val(res.data.type_item_out);
            }
            $("#print_img_1").remove();
            $("#print_img_2").remove();
            $("#print_img_3").remove();
            var img_default = "this.onerror=null;this.src='img/main/default.jpg';";
            if (res.data.img_1 != null) {
                $("#print_td_img_1").append('<img src="" id="print_img_1" class="d-block rounded" width="200" height="150" onerror="' + img_default + '">');
                $("#print_img_1").attr('src', 'img/main/' + res.data.img_1);
            }
            if (res.data.img_2 != null) {
                $("#print_td_img_2").append('<img src="" id="print_img_2" class="d-block rounded" width="200" height="150" onerror="' + img_default + '">');
                $("#print_img_2").attr('src', 'img/main/' + res.data.img_2);
            }
            if (res.data.img_3 != null) {
                $("#print_td_img_3").append('<img src="" id="print_img_3" class="d-block rounded" width="200" height="150" onerror="' + img_default + '">');
                $("#print_img_3").attr('src', 'img/main/' + res.data.img_3);
            }
            $("#submit_print").attr('item_id', res.data.list_id);
        }
    });
}

var Open_print = function Open_print(e) {
    var Toastr = Set_Toastr();
    var Sned_id = $(e).attr('item_id');
    var type_send = $("#print_type_send").val();
    var name_item_out = $("#name_item_out").val();
    var dep_item_out = $("#dep_item_out").val();
    if (name_item_out == '') {
        Toastr["error"]('กรุณากรอกผู้นำสินค้าออก');
    }else if (dep_item_out == '') {
        Toastr["error"]('กรุณากรอกแผนก');
    }else if (type_send == '0'){
        Toastr["error"]('กรุณาเลือก ประเภท');
    }else{
        var New_winwodws;
        $('#model_crate_print').modal('hide');
        New_winwodws = window.open("print/" + Sned_id + "?type_send=" + type_send + "&name_item_out=" + name_item_out + "&dep_item_out=" + dep_item_out, "", "width=800, height=500");
        setTimeout(function() {
         var table = $('#table_all').DataTable();
         table.draw();
        }, 500);
    }
}

var Open_model_return = function Open_model_return(e) {
    $("#model_return_body").html('');
    $("#button_save_return").html('');
    var Toastr = Set_Toastr();
    var list_item_id = $(e).attr('list_item_id');
    $('#model_return').modal('show');
    $("body").css("padding-right", "0");
    var Data = new FormData();
    Data.append('list_item_id', list_item_id);
    // Ajax
    $.ajax({
        url: 'api/v1/return_item',
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
            console.log(res.data);
            $("#model_return_body").html(res.data);
            $("#button_save_return").html(res.button);
            Set_daterange_single();
        }
    });
}

var Save_model_return = function Save_model_return(e) {
    var type_item_out = $(e).attr('type_item_out');
    var list_id = $(e).attr('list_id');
    var Data = new FormData();
    if (type_item_out == '1') {
        Data.append('return_type_1_name', $("#return_type_1_name").val());
        Data.append('return_type_1_address', $("#return_type_1_address").val());
        Data.append('return_type_1_date', $("#return_type_1_date").val());
        Data.append('return_type_1_phone', $("#return_type_1_phone").val());
        Data.append('type_item_out', type_item_out);
        Data.append('list_id', list_id);
        var auth = Set_check_return_data(type_item_out);
        if (auth == true) {
            Sned_save_model_return(Data);
        }
    } else if (type_item_out == '2') {
        Data.append('return_type_2_name', $("#return_type_2_name").val());
        Data.append('return_type_2_dep', $("#return_type_2_dep").val());
        Data.append('return_type_2_address', $("#return_type_2_address").val());
        Data.append('return_type_2_ems', $("#return_type_2_ems").val());
        Data.append('type_item_out', type_item_out);
        Data.append('list_id', list_id);
        var auth = Set_check_return_data(type_item_out);
        if (auth == true) {
            Sned_save_model_return(Data);
        }
    } else if (type_item_out == '3') {
        Data.append('return_type_3_other', $("#return_type_3_other").val());
        Data.append('type_item_out', type_item_out);
        Data.append('list_id', list_id);
        var auth = Set_check_return_data(type_item_out);
        if (auth == true) {
            Sned_save_model_return(Data);
        }
    }
}

var Sned_save_model_return = function Sned_save_model_return(Data) {
    // Ajax
    $.ajax({
        url: 'api/v1/save_retuen',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (res) {
            Set_return_model_null();
            $('#model_return').modal('hide');
            var table = $('#table_all').DataTable();
            table.draw();
        }
    });
}

var Set_check_return_data = function Set_check_return_data(type_item_out) {
    if (type_item_out == '1') {
        var return_type_1_name = function return_type_1_name() {
            if ($("#return_type_1_name").val() == '') {
                $("#return_type_1_name").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_1_name").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_1_address = function return_type_1_address() {
            if ($("#return_type_1_address").val() == '') {
                $("#return_type_1_address").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_1_address").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_1_date = function return_type_1_date() {
            if ($("#return_type_1_date").val() == '') {
                $("#return_type_1_date").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_1_date").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_1_phone = function return_type_1_phone() {
            if ($("#return_type_1_phone").val() == '') {
                $("#return_type_1_phone").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_1_phone").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }

        var success_rows = 0;
        var error_rows = 0;
        var return_type_1_name = return_type_1_name() == true ? success_rows++ : error_rows++;
        var return_type_1_address = return_type_1_address() == true ? success_rows++ : error_rows++;
        var return_type_1_date = return_type_1_date() == true ? success_rows++ : error_rows++;
        var return_type_1_phone = return_type_1_phone() == true ? success_rows++ : error_rows++;
        var result = success_rows == 4 ? true : false;
        return result;

    } else if (type_item_out == '2') {
        var return_type_2_name = function return_type_2_name() {
            if ($("#return_type_2_name").val() == '') {
                $("#return_type_2_name").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_2_name").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_2_dep = function return_type_2_dep() {
            if ($("#return_type_2_dep").val() == '') {
                $("#return_type_2_dep").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_2_dep").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_2_address = function return_type_2_address() {
            if ($("#return_type_2_address").val() == '') {
                $("#return_type_2_address").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_2_address").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var return_type_2_ems = function return_type_2_ems() {
            if ($("#return_type_2_ems").val() == '') {
                $("#return_type_2_ems").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_2_ems").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }

        var success_rows = 0;
        var error_rows = 0;
        var return_type_2_name = return_type_2_name() == true ? success_rows++ : error_rows++;
        var return_type_2_dep = return_type_2_dep() == true ? success_rows++ : error_rows++;
        var return_type_2_address = return_type_2_address() == true ? success_rows++ : error_rows++;
        var return_type_2_ems = return_type_2_ems() == true ? success_rows++ : error_rows++;
        var result = success_rows == 4 ? true : false;
        return result;

    } else if (type_item_out == '3') {
        var return_type_3_other = function return_type_3_other() {
            if ($("#return_type_3_other").val() == '') {
                $("#return_type_3_other").removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#return_type_3_other").removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }

        var success_rows = 0;
        var error_rows = 0;
        var return_type_3_other = return_type_3_other() == true ? success_rows++ : error_rows++;
        var result = success_rows == 1 ? true : false;
        return result;
    }
}

var Set_return_model_null = function Set_return_model_null() {
    $("#return_type_1_name").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_1_address").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_1_date").removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_1_phone").removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_2_name").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_2_dep").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_2_address").removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_2_ems").removeClass('is-valid').removeClass('is-invalid');
    $("#return_type_3_other").removeClass('is-valid').removeClass('is-invalid');
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
    $("#record_by").removeClass('is-valid').removeClass('is-invalid');
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

var Set_Toastr = function Set_Toastr() {
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