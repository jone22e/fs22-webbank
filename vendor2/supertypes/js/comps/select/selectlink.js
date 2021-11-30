(function ($) {
    $.fn.selectlink = function (settings) {

        var config = {
            'url': '',
            'validate':false,
            'placeholder': 'Digite para pesquisar',
            'css' : [],
            'click' : null,
            'cancel' : null,
            'autoload' : false,
        };
        if (settings){$.extend(config, settings);}


        if (config.placeholder=='' || config.placeholder==null) {
            config.placeholder='Digite para pesquisar';
        }


        return this.each(function () {

            var $this = $(this);
            var val = '';
            var esc = false;





            var name = 'select_' + $(this).attr('id');
            $(this).parent().addClass("dropdown");
            $(this).parent().append('<div class="dropdown-menu w-100 shadow-lg '+name+'_search " style="  min-width: 300px; '+config.css.join(';')+';" >\n' +
                '                                <div class="pl-2 pr-2 pb-2 small text-black-50">\n' +
                '                                   <input type="text" class="form-control form-control-sm '+name+'_search_input" placeholder="'+config.placeholder+'">\n'+
                '                                </div>\n'+
                '                                <div class="small text-black-50 '+name+'_search_result" style="max-height: 200px;  overflow-y: auto">\n' +
                '                                    <div class="pl-2 pr-2 ">'+config.placeholder+'</div>\n' +
                '                                </div>\n' +
                '                            </div>');

            $(this).attr('data-toggle','dropdown');
            $(this).attr('aria-haspopup','true');
            $(this).attr('aria-expanded','false');
            $('.'+name+'_search_input').attr('autocomplete','off');

            $('.'+name+'_search_input').unbind('focus');
            $('.'+name+'_search_input').focus(function () {
                if ($(this).val()!='' && !esc) {
                    val = $(this).val();
                    $this.attr('valid', 'true');
                } else {
                    if (val != $(this).val()) {
                        $this.attr('valid', 'false');
                    }
                }
            });

            $('.'+name+'_search_input').unbind('blur');
            $('.'+name+'_search_input').blur(function () {
                if (config.validate) {
                    if ($this.attr('valid')=='false') {
                        $(this).val('');
                    }
                }

                esc = false;
            });

            if (config.autoload==true) {
                    $('.'+name+'_search_input').unbind('focus');
                    $('.'+name+'_search_input').focus(function () {
                        $.ajax({
                            method: "POST",
                            url: config.url,
                            data: {
                                q: '',
                                className: 'dropdown-item text-truncate ' + name + '_item'
                            },
                            beforeSend: function () {
                            }
                        }).done(function (res) {
                            $('.' + name + '_search_result').html(res);
                            $('.' + name + '_item').unbind('click');
                            $('.' + name + '_item').click(function () {
                                $this.attr('valid', 'true');
                                var oname = $(this).attr('value');
                                $(this).val(oname);
                                $this.html(oname);
                                if (config.click != null) {
                                    config.click.call(this, $(this));
                                }
                            });
                        });
                    });
            }

            $('.'+name+'_search_input').unbind('keyup');
            $('.'+name+'_search_input').keyup(function (event) {
                if (!$('.'+name+'_search_result').hasClass("show")) {
                    $(this).click();
                }
                if ($this.val()!=val) {
                    $this.attr('valid', 'false');
                }
                if ( event.which != 38 && event.which != 40  && event.which != 27) {
                    esc = false;
                    var q = $(this).val();
                    $.ajax({
                        method: "POST",
                        url: config.url,
                        data: {
                            q: q,
                            className : 'dropdown-item text-truncate '+name+'_item'
                        },
                        beforeSend: function () {
                        }
                    }).done(function (res) {

                        $('.'+name+'_search_result').html(res);
                        $('.'+name+'_item').unbind('click');
                        $('.'+name+'_item').click(function () {
                            $this.attr('valid', 'true');
                            var oname = $(this).attr('value');
                            $(this).val(oname);
                            $this.html(oname);
                            if (config.click!=null) {
                                config.click.call(this, $(this));
                            }
                        });
                    });
                } else {
                    if (event.which == 27) {
                        esc = true;
                        if (config.cancel!=null) {
                            valid =  $this.attr('valid')=='true'?true:false;
                            config.cancel.call(this, valid);
                        }
                    }
                }
            });


        });

    };
})(jQuery);