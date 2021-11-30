var jmodal__Callbackclose = null;
function JModal() {
    return {
        init : function () {
            //teste de compressão
            $('body').append('<div class="jmodal">' +
                                '<div class="jmodal-btn-close"></div>' +
                                '<div class="jmodal-inside"></div>' +
                            '</div>' +
                            '<div class="jmodal-overlay"></div>');
            $('body').append('');
        },
        open : function () {
            jmodal__Callbackclose = null;
            $(".jmodal").show();
            $('.jmodal-overlay').fadeIn();
            $(".jmodal").fadeIn();
            $('.jmodal-overlay').unbind('click');
            $('.jmodal-overlay').click(function () {
                JModal().close();
            });
            $('.jmodal-btn-close').unbind('click');
            $('.jmodal-btn-close').click(function () {
                JModal().close();
            });
        },
        onclose : function(callback) {
            jmodal__Callbackclose = callback;
        },
        close : function () {
            $('.jmodal-overlay').fadeOut();
            $(".jmodal").hide();
            if (jmodal__Callbackclose!=null) {
                jmodal__Callbackclose.call();
            }
        },
        innerHtml : function (html) {
            $('.jmodal-inside').html(html);
        }
    }
}

var jmodal = new JModal();
jmodal.init();

