$(document).ready(function () {
    // ถ้ามีการ คลิ้ก ปุ่มนี้ให้ส่งค่า
    $("#submit_register").click(function () {
    register();
    });
});

$.fn.dataTable.ext.errMode = 'throw';
var table_user = $('#table_user').DataTable({
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
        "url": 'api/v1/get_user',
        "type": 'get',
    },
    "columns": [{
        "width": '5%',
        "render": function (data, type, full, meta) {
            return meta.row + 1;
        }
    },{
        "data": 'username',
        "name": 'username',
    },{
        "data": 'name',
        "name": 'name',
    },{
        "data": 'status',
        "name": 'status',
    },{
        "data": 'ip_login',
        "name": 'ip_login',
    },{
        "data": 'action',
        "name": 'action'
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": [1]
        },
        {
            "className": 'text-center',
            "targets": [0, 3]
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

var Open_add_modal = function Open_add_modal() {
    $('#add_type_modal').modal('show');
    $("body").css("padding-right", "0");
}

var register = function register() {
    // Toastr Options
    var Toastr = Set_Toastr();
    // Laading  Options
    var loading = Ladda.create(document.querySelector('.btn-loading'));
    loading.start();
    loading.setProgress(5);
    var Check_rows = Check_null_input_register();
    // ถ้า Check_rows == true ให้ส่งค่าได้
    if (Check_rows == true) {
        loading.setProgress(50);
        var Data = new FormData();
        Data.append('username', $("#username_register").val());
        Data.append('password', $("#password_register").val());
        Data.append('fname', $("#fname").val());
        Data.append('lname', $("#lname").val());
        Data.append('phone', $("#phone").val());
        Data.append('email', $("#email").val());
        $.ajax({
            url: 'api/v1/do_register',
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
                $('#add_type_modal').modal('hide');
                var table = $('#table_user').DataTable();
                table.draw();
            }
        }).always(
            function () {
                loading.setProgress(100);
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

var Check_null_input_register = function Check_null_input_register() {
    function Check_null_username() {
        if ($("#username_register").val() == '') {
            $("#username_register").removeClass('is-valid');
            $("#username_register").addClass('is-invalid');
            return false;
        } else {
            $("#username_register").removeClass('is-invalid');
            $("#username_register").addClass('is-valid');
            return true;
        }
    }

    function Check_null_password() {
        if ($("#password_register").val() == '') {
            $("#password_register").removeClass('is-valid');
            $("#password_register").addClass('is-invalid');
            return false;
        } else {
            $("#password_register").removeClass('is-invalid');
            $("#password_register").addClass('is-valid');
            return true;
        }
    }

    function Check_null_fname() {
        if ($("#fname").val() == '') {
            $("#fname").removeClass('is-valid');
            $("#fname").addClass('is-invalid');
            return false;
        } else {
            $("#fname").removeClass('is-invalid');
            $("#fname").addClass('is-valid');
            return true;
        }
    }

    function Check_null_lname() {
        if ($("#lname").val() == '') {
            $("#lname").removeClass('is-valid');
            $("#lname").addClass('is-invalid');
            return false;
        } else {
            $("#lname").removeClass('is-invalid');
            $("#lname").addClass('is-valid');
            return true;
        }
    }

    function Check_null_phone() {
        if ($("#phone").val() == '') {
            $("#phone").removeClass('is-valid');
            $("#phone").addClass('is-invalid');
            return false;
        } else {
            $("#phone").removeClass('is-invalid');
            $("#phone").addClass('is-valid');
            return true;
        }
    }

    function Check_null_email() {
        if ($("#email").val() == '') {
            $("#email").removeClass('is-valid');
            $("#email").addClass('is-invalid');
            return false;
        } else {
            $("#email").removeClass('is-invalid');
            $("#email").addClass('is-valid');
            return true;
        }
    }

    var success_rows = 0;
    var error_rows = 0;
    var Check_null_username = Check_null_username() == true ? success_rows++ : error_rows++;
    var Check_null_password = Check_null_password() == true ? success_rows++ : error_rows++;
    var Check_null_fname = Check_null_fname() == true ? success_rows++ : error_rows++;
    var Check_null_lname = Check_null_lname() == true ? success_rows++ : error_rows++;
    var Check_null_phone = Check_null_phone() == true ? success_rows++ : error_rows++;
    var Check_null_email = Check_null_email() == true ? success_rows++ : error_rows++;
    var result = success_rows == 6 ? true : false;
    return result;
}

var Open_edit_modal = function Open_edit_modal(e) {
    $('#edit_type_modal').modal('show');
    $("body").css("padding-right", "0");
    var Data = new FormData();
    Data.append('type_id', $(e).attr('type_id'));
    // Ajax
    $.ajax({
        url: 'api/v1/get_edit_user_id',
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
           $.each(res.data, function (key, value) {
                $("#save_edit_modal").attr('user_id', value.user_id);
                $("#username_edit").val(value.username);
                $("#fname_edit").val(value.fname);
                $("#lname_edit").val(value.lname);
                $("#phone_edit").val(value.phone);
                $("#email_edit").val(value.email);
           });
        }
    });
}

var Save_edit_modal = function Save_edit_modal(e) {
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('user_id', $(e).attr('user_id'));
    Data.append('username_edit', $('#username_edit').val());
    Data.append('fname_edit', $('#fname_edit').val());
    Data.append('lname_edit', $('#lname_edit').val());
    Data.append('phone_edit', $('#phone_edit').val());
    Data.append('email_edit', $('#email_edit').val());
    // Ajax
    $.ajax({
        url: 'api/v1/save_edit_user',
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
            $('#edit_type_modal').modal('hide');
            var table = $('#table_user').DataTable();
            table.draw();
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