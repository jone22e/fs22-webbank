function block_start(id, replace ) {
    if (replace==null) {
        replace = false;
    }
    $(id).each(function( index ) {
        var color = $(this).css('color');
        idx = id.replace(/\./g, "");
        idx = idx.replace('#', "");
        var html = '<svg id="svg_btn_salvar_id'+idx+'" class="svg_btn_salvar_id'+idx+'" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="16px" height="16px" viewBox="0 0 128 128" xml:space="preserve" fill="'+color+'" ><g><circle cx="16" cy="64" r="16" fill="'+color+'" fill-opacity="1"/><circle cx="16" cy="64" r="14.344" fill="'+color+'" fill-opacity="1" transform="rotate(45 64 64)"/><circle cx="16" cy="64" r="12.531" fill="'+color+'" fill-opacity="1" transform="rotate(90 64 64)"/><circle cx="16" cy="64" r="10.75" fill="'+color+'" fill-opacity="1" transform="rotate(135 64 64)"/><circle cx="16" cy="64" r="10.063" fill="'+color+'" fill-opacity="1" transform="rotate(180 64 64)"/><circle cx="16" cy="64" r="8.063" fill="'+color+'" fill-opacity="1" transform="rotate(225 64 64)"/><circle cx="16" cy="64" r="6.438" fill="'+color+'" fill-opacity="1" transform="rotate(270 64 64)"/><circle cx="16" cy="64" r="5.375" fill="'+color+'" fill-opacity="1" transform="rotate(315 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="320ms" repeatCount="indefinite"></animateTransform></g></svg>'
        $(this).attr('disabled', 'disabled');
        if (replace==true) {
            $(this).html(html);
        } else {
            $(this).html(html + ' ' + $(this).html());
        }

    });
}

function block_end(id) {
    $( id ).each(function( index ) {

        $(this).removeAttr('disabled');
        idx = id.replace(/\./g, "");
        idx = idx.replace('#', "");
        $('.svg_btn_salvar_id'+idx).remove();

    });
}

function toReais(val, dec=2) {
    return parseFloat(val).toFixed(dec).replace(".", ",");
}

function toReaisMiliar(val) {
    var tmp = val.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
    return tmp;
}

function toDouble(val) {
    if (val=='') {
        return 0;
    } else {
        val = val.replace(".", "");
        return parseFloat(val.replace(",", "."));
    }
}

function mask() {
    $(".double").maskMoney({prefix:'', allowNegative: false, thousands:'', decimal:',', affixesStay: false, allowZero : true});
    $(".double-3").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 3});
    $(".double-4").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 4});
    $(".double-5").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 5});
    $(".double-6").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 6});
    $(".double-7").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 7});
    $(".double-8").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 8});
    $(".double-9").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero : true, precision: 9});
    $(".int").maskMoney({prefix:'', allowNegative: false, thousands:'', decimal:',', affixesStay: false, precision: 0,allowZero : true});
    var options2 =  {
        onKeyPress: function(value, e, field, options2) {
            var id = field.attr('id');
            var masks = ['(00) 0000-00000', '(00) 0 0000-0000'];
            if (e.keyCode == 8 || e.keyCode == 46){
                var mask = (value.length <= 15) ? masks[0] : masks[1];
            } else {
                var mask = (value.length > 14) ? masks[1] : masks[0];
            }
            $('#'+id).mask(mask, options2);
        }
    };
    $(".telefone").mask('(00) 0000-00000#' , options2);
    $(".cep").mask('00000-000');
    $(".cnpj").mask('00.000.000/0000-00');
    $(".cpf").mask('000.000.000-00');
    $(".hora").mask('00:00');



    $(".datapicker").mask('00/00/0000');
    $('.datapicker').datepicker({
        language: "pt-BR",
        autoclose: true
    });
}