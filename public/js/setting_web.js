var Upload_background_web = function Upload_background_web() {
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('img', $("#background_web").prop('files')[0]);
    // Ajax
    $.ajax({
        url: 'api/v1/background_web',
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
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000);
        }
    })
}

var Upload_icon_web = function Upload_icon_web() {
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('img', $("#icon_web").prop('files')[0]);
    // Ajax
    $.ajax({
        url: 'api/v1/icon_web',
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
            setTimeout(function () {
                window.location.reload(true);
            }, 1000);
        }
    })
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