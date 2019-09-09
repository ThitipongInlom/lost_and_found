var show_tab_1 = function show_tab_1() {
    $("#Tab1_Display").html('');
    $(".loading_action").show();
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('range_date', $("#Tab_1_date").val());
    $.ajax({
        url: 'api/v1/get_tab_1',
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
            $(".loading_action").hide();
            $("#Tab1_Display").html(res.Table);
        }
    });
}

var show_tab_2 = function show_tab_2() {
    $("#Tab2_Display").html('');
    $(".loading_action").show();
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('range_date', $("#Tab_2_date").val());
    $.ajax({
        url: 'api/v1/get_tab_2',
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
            $(".loading_action").hide();
            $("#Tab2_Display").html(res.Table);
        }
    });
}

var show_tab_3 = function show_tab_3() {
    $("#Tab3_Display").html('');
    $(".loading_action").show();
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('range_date', $("#Tab_3_date").val());
    $.ajax({
        url: 'api/v1/get_tab_3',
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
            $(".loading_action").hide();
            $("#Tab3_Display").html(res.Table);
        }
    });
}

var show_tab_4 = function show_tab_4() {
    $("#Tab4_Display").html('');
    $(".loading_action").show();
    var Toastr = Set_Toastr();
    var Data = new FormData();
    Data.append('range_date', $("#Tab_4_date").val());
    $.ajax({
        url: 'api/v1/get_tab_4',
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
            $(".loading_action").hide();
            $("#Tab4_Display").html(res.Table);
        }
    });
}

$('.daterange').daterangepicker({
    showDropdowns: true,
    ranges: {
        'วันนี้': [moment(), moment()],
        'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
        '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
        'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
        'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    alwaysShowCalendars: true,
    opens: 'right',
    cancelClass: "btn-danger",
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
}, function (start, end, label) {
    console.log('เลือกวันที่ ระหว่าง : ' + start.format('YYYY-MM-DD') + ' ถึง ' + end.format('YYYY-MM-DD'));
});

var print_page = function print_page(elem) {
    var domClone = elem.cloneNode(true);
    var $printSection = document.getElementById("printSection");
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
    $printSection.innerHTML = "";
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
