$(document).ready(function () {
    $("#username_login").keyup(function (event) {
        if (event.keyCode === 13) {
            login();
        }
    });
    $("#password_login").keyup(function (event) {
        if (event.keyCode === 13) {
            login();
        }
    });
    // ถ้ามีการ คลิ้ก ปุ่มนี้ให้ส่งค่า
    $("#submit_login").click(function () {
        login();
    });
    $("#username_register").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    $("#password_register").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    $("#fname").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    $("#lname").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    $("#phone").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    $("#email").keyup(function (event) {
        if (event.keyCode === 13) {
            register();
        }
    });
    // ถ้ามีการ คลิ้ก ปุ่มนี้ให้ส่งค่า
    $("#submit_register").click(function () {
        register();
    });
});
var login = function login() {
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
    var Check_rows = Check_null_input_login();
    // Laading  Options
    var loading = Ladda.create(document.querySelector('.btn-loading'));
    loading.start();
    loading.setProgress(5);
    if (Check_rows == true) {
        loading.setProgress(50);
        var Data = new FormData();
        Data.append('username', $("#username_login").val());
        Data.append('password', $("#password_login").val());
        $.ajax({
            url: 'api/v1/do_login',
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
                if (res.status == 'success') {
                    // Turn Login
                    Toastr["success"](res.error_text);
                    setTimeout(function () {
                        window.location.href = res.path + '/';
                    }, 1000);
                } else {
                    // Text Error 
                    Toastr["error"](res.error_text);
                    $("#username").removeClass('is-valid');
                    $("#password").removeClass('is-valid');
                    $("#username").val('');
                    $("#password").val('');
                    $("#username").focus();
                }
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

var Check_null_input_login = function Check_null_input_login() {
    function Check_null_username() {
        if ($("#username_login").val() == '') {
            $("#username_login").removeClass('is-valid');
            $("#username_login").addClass('is-invalid');
            return false;
        } else {
            $("#username_login").removeClass('is-invalid');
            $("#username_login").addClass('is-valid');
            return true;
        }
    }

    function Check_null_password() {
        if ($("#password_login").val() == '') {
            $("#password_login").removeClass('is-valid');
            $("#password_login").addClass('is-invalid');
            return false;
        } else {
            $("#password_login").removeClass('is-invalid');
            $("#password_login").addClass('is-valid');
            return true;
        }
    }

    var success_rows = 0;
    var error_rows = 0;
    var Check_null_username = Check_null_username() == true ? success_rows++ : error_rows++;
    var Check_null_password = Check_null_password() == true ? success_rows++ : error_rows++;
    var result = success_rows == 2 ? true : false;
    return result;
}

var register = function register() {
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
                if (res.status == 'success') {
                    // Turn Login
                    Toastr["success"](res.error_text);
                    setTimeout(function () {
                        window.location.href = res.path + '/login';
                    }, 1000);
                } else {
                    // Text Error 
                    Toastr["error"](res.error_text);
                }
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
        Toastr["error"]("กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
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