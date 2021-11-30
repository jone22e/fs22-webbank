(function ($) {
    $.fn.counter = function (settings) {

        var config = {
            'url': '',
            'validate':false,
            'click' : null,
            'cancel' : null
        };
        if (settings){$.extend();}

        return this.each(function () {
            var $this = $(this);
            if ($(this).attr('maxlength')>0) {
                var max = $(this).attr('maxlength');
                var oid = $(this).attr("id")+"_max";
                $(this).parent().append('<div class="'+oid+'" style="font-size: 10px; color: gray"></div>')
                $(this).unbind("keyup");
                $(this).keyup(function () {
                    var val = $(this).val();
                    $('.'+oid).html( val.length +" de "+max);
                });
            }
        });

    };
})(jQuery);