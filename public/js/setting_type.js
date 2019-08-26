$.fn.dataTable.ext.errMode = 'throw';
var table_type = $('#table_type').DataTable({
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
        "url": 'api/v1/get_type_setting',
        "type": 'get',
    },
    "columns": [{
        "width": '5%',
        "render": function (data, type, full, meta) {
            return meta.row + 1;
        }
    }, {
        "data": 'type_name',
        "name": 'type_name',
    }, {
        "data": 'Show',
        "name": 'Show'
    }, {
        "data": 'action',
        "name": 'action'
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": [1]
        },
        {
            "className": 'text-center',
            "targets": [0, 2]
        }, {
            "className": 'text-right',
            "targets": []
        }, {
            "className": 'text-truncate',
            "targets": []
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

var table_place = $('#table_place').DataTable({
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
        "url": 'api/v1/get_place_setting',
        "type": 'get',
    },
    "columns": [{
        "width": '5%',
        "render": function (data, type, full, meta) {
            return meta.row + 1;
        }
    }, {
        "data": 'type_name',
        "name": 'type_name',
    }, {
        "data": 'Show',
        "name": 'Show'
    }, {
        "data": 'action',
        "name": 'action'
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": [1]
        },
        {
            "className": 'text-center',
            "targets": [0, 2]
        }, {
            "className": 'text-right',
            "targets": []
        }, {
            "className": 'text-truncate',
            "targets": []
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

var Open_add_modal = function Open_add_modal(e) {
    $('#add_type_modal').modal('show');
    $("body").css("padding-right", "0");
    var type_class = $(e).attr('type_class');
    $("#add_type_name").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#save_modal_add").attr('type_class', type_class);
}

var Open_edit_modal = function Open_edit_modal(e) {
    $('#edit_type_modal').modal('show');
    $("body").css("padding-right", "0");
    var type_id = $(e).attr('type_id');
    var type_name = $(e).attr('type_name');
    $("#edit_type_name").val('').removeClass('is-valid').removeClass('is-invalid');
    $("#edit_type_name").val(type_name);
    $("#save_edit_mdoal").attr('type_id', type_id);
}

var Save_edit_modal = function Save_edit_modal(e) {
    var lang = $('html').attr('lang');
    var Toastr = Set_Toastr();
    var Auth = Auth_save_edit();
    var Data = new FormData();
    Data.append('type_id', $(e).attr('type_id'));
    Data.append('type_name', $("#edit_type_name").val());
    Data.append('type_class', $(e).attr('type_class'));
    if (Auth == true) {
        // Ajax
        $.ajax({
            url: 'api/v1/edit_type',
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
                $('#edit_type_modal').modal('hide');
                Toastr["success"](res.error_text);
                // Reload Table
                $('#table_type').DataTable().draw();
                $('#table_place').DataTable().draw();
            }
        });
    } else {
        if (lang == 'th') {
            Toastr["error"]("กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
        } else if (lang == 'en') {
            Toastr["error"]("Please fill out all fields.");
        }
    }
}

var Auth_save_edit = function Auth_save_edit() {
    var Check_null_edit_type_name = function Check_null_edit_type_name() {
        if ($("#edit_type_name").val() == '') {
            $("#edit_type_name").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#edit_type_name").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var success_rows = 0;
    var error_rows = 0;
    var Check_null_edit_type_name = Check_null_edit_type_name() == true ? success_rows++ : error_rows++;
    var result = success_rows == 1 ? true : false;
    return result;
}

var Save_add_modal = function Save_add_modal(e) {
    var lang = $('html').attr('lang');
    var Toastr = Set_Toastr();
    var Auth = Auth_save_add();
    var Data = new FormData();
    Data.append('add_type_name', $("#add_type_name").val());
    Data.append('type_class', $(e).attr('type_class'));
    if (Auth == true) {
        // Ajax
        $.ajax({
            url: 'api/v1/save_type',
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
                $('#add_type_modal').modal('hide');
                Toastr["success"](res.error_text);
                // Reload Table
                $('#table_type').DataTable().draw();
                $('#table_place').DataTable().draw();
            }
        });
    }else {
        if (lang == 'th') {
            Toastr["error"]("กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
        } else if (lang == 'en') {
            Toastr["error"]("Please fill out all fields.");
        }
    }
}

var Auth_save_add = function Auth_save_add() {
    var Check_null_add_type_name = function Check_null_add_type_name() {
        if ($("#add_type_name").val() == '') {
            $("#add_type_name").removeClass('is-valid').addClass('is-invalid');
            return false;
        } else {
            $("#add_type_name").removeClass('is-invalid').addClass('is-valid');
            return true;
        }
    }
    var success_rows = 0;
    var error_rows = 0;
    var Check_null_add_type_name = Check_null_add_type_name() == true ? success_rows++ : error_rows++;
    var result = success_rows == 1 ? true : false;
    return result;
}

var Open_eye_show_modal = function Open_eye_show_modal(e) {
    $('#eye_show_modal').modal('show');
    $("body").css("padding-right", "0");
    if ($(e).attr('name') == 'ปิดการแสดง') {
        var icon = '<i class="fas fa-eye-slash"></i>';
        var change_name = "ปิดการแสดง";
    }else{
        var icon = '<i class="fas fa-eye"></i>';
        var change_name = "เปิดการแสดง";
    }
    $("#icon_eye_modal_head").html(icon);
    $("#name_eye_modal_head").html($(e).attr('name'));
    $("#eye_show_type_id").html($(e).attr('type_id'));
    $("#name_eye_modal_body").html(change_name);
    $("#eye_show_type_name").html($(e).attr('type_name'));
    $("#save_eye_show_mdoal").attr('type_id', $(e).attr('type_id'));
    $("#save_eye_show_mdoal").attr('change_name', change_name);
    $("#save_eye_show_mdoal").attr('type_class', $(e).attr('type_class'));
}

var Save_eye_show_modal = function Save_eye_show_modal(e) {
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('type_id', $(e).attr('type_id'));
    Data.append('change_name', $(e).attr('change_name'));
    Data.append('type_class', $(e).attr('type_class'));
    // Ajax
    $.ajax({
        url: 'api/v1/save_show_type',
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
            $('#eye_show_modal').modal('hide');
            Toastr["success"](res.error_text);
            // Reload Table
            $('#table_type').DataTable().draw();
            $('#table_place').DataTable().draw();
        }
    });
}

var Open_delete_modal = function Open_delete_modal(e) {
    $('#delete_type_modal').modal('show');
    $("body").css("padding-right", "0");
    $("#save_delete_type_modal").attr('type_id', $(e).attr('type_id'));
}

var Save_delete_type_modal = function Save_delete_type_modal(e) {
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('type_id', $(e).attr('type_id'));
    // Ajax
    $.ajax({
        url: 'api/v1/delete_type',
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
           $('#delete_type_modal').modal('hide');
           Toastr["success"](res.error_text);
            // Reload Table
            $('#table_type').DataTable().draw();
            $('#table_place').DataTable().draw();
        }
    });
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