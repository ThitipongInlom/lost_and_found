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
        "data": 'action',
        "name": 'action'
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": [1]
        },
        {
            "className": 'text-center',
            "targets": [0]
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