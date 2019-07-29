$('#lang_select').select2({
    theme: 'bootstrap4',
    templateResult: addlangimg,
    templateSelection: addlangimg,
    width: '180'
});
$('#lang_select').on('select2:selecting', function (e) {
    var url = e.target.attributes.url_base.value;
    var lang = e.params.args.data.id;
    $.ajax({
        url: url + "/switch_lang",
        type: 'GET',
        data: {
            lang: lang
        },
        success: function () {
            location.reload();
        }
    });
});

function addlangimg(opt) {
    if (!opt.id) {
        return opt.text;
    }
    var optimage = $(opt.element).data('image');
    if (!optimage) {
        return opt.text;
    } else {
        var $opt = $(
            '<span class="langimg"><img src="' + optimage + '" class="userPic"  width="24" > ' + $(opt.element).text() + '</span>'
        );
        return $opt;
    }
};
