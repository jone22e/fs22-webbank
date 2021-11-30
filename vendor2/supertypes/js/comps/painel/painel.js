var panel__Size = 400;
var panel__Callbackclose = null;
function Painel() {
    return {
        init : function () {
            //teste de compressão
            $('body').append('<div class="painel">' +
                                '<div class="painel-btn-close"></div>' +
                                '<div class="painel-inside"></div>' +
                            '</div>' +
                            '<div class="painel-overlay"></div>');
            $('body').append('');
        },
        open : function () {
            panel__Callbackclose = null;
            $(".painel").show();
            $('.painel-overlay').fadeIn();
            $(".painel").animate({right: '0px'}, 100, 'swing', function () {
            });
            $('.painel-overlay').unbind('click');
            $('.painel-overlay').click(function () {
                Painel().close();
            });
            $('.painel-btn-close').unbind('click');
            $('.painel-btn-close').click(function () {
                Painel().close();
            });
        },
        onclose : function(callback) {
            panel__Callbackclose = callback;
        },
        close : function () {
            $('.painel-overlay').fadeOut();
            $(".painel").animate({right: '-'+panel__Size+'px'}, 100, 'swing', function () {
                $(".painel").hide();
            });
            Painel().setSize(400);
            if (panel__Callbackclose!=null) {
                panel__Callbackclose.call();
            }
        },
        innerHtml : function (html) {
            $('.painel-inside').html(html);
        },
        setSize : function (w) {
            panel__Size = w;
            $(".painel").css({
                width: panel__Size+"px",
                right: "-"+panel__Size+"px"
            });
        }
    }
}

var painel = new Painel();
painel.init();

