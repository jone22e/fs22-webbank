(function ($) {
    $.fn.selectbox = function (settings) {

        var config = {
            'url': '',
            'validate':false,
            'loader':false,
            'placeholder': 'Digite para pesquisar',
            'css' : [],
            'click' : null,
            'cancel' : null,
            'novalidate' : null,
            'autoload' : false,
            'alignRight' : false,
        };
        if (settings){$.extend(config, settings);}


        if (config.placeholder=='' || config.placeholder==null) {
            config.placeholder='Digite para pesquisar';
        }

        var ajaxCalling = null;
        var ajaxCallingDelay = 0;

        return this.each(function () {

            var $this = $(this);
            var val = '';
            var esc = false;

            if ($this.is('[readonly]')) {
                return false;
            }

            var rigth = 'dropdown-menu-right';
            if (!config.alignRight) {
                rigth = '';
            }


            var name = 'select_' + $(this).attr('id');
            $(this).parent().addClass("dropdown");
            $(this).parent().append('<div class="dropdown-menu  w-100 '+rigth+' '+name+'_search " tabindex="0" style="font-size: 13px; max-height: 200px; '+config.css.join(';')+'; overflow-y: auto" >\n' +
                '                                <div class="pl-3 small text-black-50">\n' +
                '                                    '+config.placeholder+'\n' +
                '                                </div>\n' +
                '                            </div>');

            $(this).attr('autocomplete','off');
            $(this).attr('data-toggle','dropdown');
            $(this).attr('aria-haspopup','true');
            $(this).attr('aria-expanded','false');


            $(this).unbind('click');
            $(this).click(function () {
                if ($(this).is('[readonly]')) {
                    $('.'+name+'_search').hide();
                    return false;
                } else {
                    if ($('.'+name+'_search').css("display")=='none') {
                        $('.'+name+'_search').css("display", "");
                    }
                   // $('.'+name+'_search').show();
                }
            });

            $(this).unbind('focus');
            $(this).focus(function () {

                if ($(this).is('[readonly]')) {
                    return false;
                }

                if ($this.val()!='' && !esc) {
                    val = $this.val();
                    $this.attr('valid', 'true');
                } else {
                    if (val != $this.val()) {
                        $this.attr('valid', 'false');
                    }
                }
            });

            $(this).unbind('blur');
            $(this).blur(function () {

                if ($(this).is('[readonly]')) {
                    return false;
                }

                if (config.validate) {
                    if ($this.attr('valid')=='false') {
                        $this.val('');
                        config.novalidate.call(this);
                    }
                }

                esc = false;
            });

            if (config.autoload==true) {

                    $(this).unbind('focus');
                    $(this).focus(function () {
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
                            $('.' + name + '_search').html(res);
                            $('.' + name + '_item').unbind('click');
                            $('.' + name + '_item').click(function () {
                                $this.attr('valid', 'true');
                                var oname = $(this).attr('value');
                                $this.val(oname);
                                if (config.click != null) {
                                    config.click.call(this, $(this));
                                }
                            });

                            $('.'+name+'_item').unbind('keydown');
                            $('.'+name+'_item').keydown(function (event) {
                                if ( event.which == 40) {
                                    $(this).next().focus();
                                }
                                if ( event.which == 38) {
                                    $(this).prev().focus();
                                }
                            });
                        });
                    });
            }



            $(this).unbind('keyup');
            $(this).keyup(function (event) {

                if ($(this).is('[readonly]')) {
                    return false;
                }

                if (ajaxCallingDelay!=null) {
                    clearTimeout(ajaxCallingDelay);
                }
                var objThis = $(this);

                if ( event.which == 40) {
                    if (!$('.'+name+'_search').is(':focus')) {
                        $('.' + name + '_item:first').focus();
                  //      $('.' + name + '_item:first').addClass("active");
                    }
                }

                ajaxCallingDelay = setTimeout(function () {

                    if (!$('.'+name+'_search').hasClass("show")) {
                        objThis.click();
                    }
                    if ($this.val()!=val) {
                        $this.attr('valid', 'false');
                    }
                    if ( event.which != 38 && event.which != 40  && event.which != 27) {
                        esc = false;
                        var q = objThis.val();

                        if (ajaxCalling!=null) {
                            ajaxCalling.abort();
                            ajaxCalling = null;
                        }

                        ajaxCalling = $.ajax({
                            method: "POST",
                            url: config.url,
                            data: {
                                q: q,
                                className : 'dropdown-item text-truncate '+name+'_item'
                            },
                            beforeSend: function () {
                                if (config.loader) {
                                    $('.'+name+'_search').html('<div class="load"></div>');
                                }
                            }
                        }).done(function (res) {

                            $('.'+name+'_search').html(res);
                            $('.'+name+'_item').unbind('click');
                            $('.'+name+'_item').click(function () {
                                $this.attr('valid', 'true');
                                var oname = $(this).attr('value');
                                $this.val(oname);
                                if (config.click!=null) {
                                    config.click.call(this, $(this));
                                }
                            });

                            $('.'+name+'_item').unbind('keydown');
                            $('.'+name+'_item').keydown(function (event) {
                                if ( event.which == 40) {
                                    $(this).next().focus();
                                }
                                if ( event.which == 38) {
                                    $(this).prev().focus();
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

                },500);


            });




        });

    };
})(jQuery);