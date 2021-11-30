var countDownTimer = [];
(function ($) {
    $.fn.countdown = function (settings) {

        var config = {
            'expiredMsg': 'EXPIRADO',
            'days' : 'D'
        };
        if (settings){$.extend();}

        return this.each(function () {
            var $this = $(this);
            var oid = $this.attr('oid');
            var countDownDate  = new Date($this.attr('date'));
            countDownTimer[oid] = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var days = String(Math.floor(distance / (1000 * 60 * 60 * 24)));
                var hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                var minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                var seconds = String(Math.floor((distance % (1000 * 60)) / 1000));
                $this.html(
                    days + config.days +" "
                    + hours.padStart(2,'0') + ":"
                    + minutes.padStart(2,'0') + ":"
                    + seconds.padStart(2,'0')
                );
                if (distance < 0) {
                    clearInterval(x[oid]);
                    $this.html(config.expiredMsg);
                }
            }, 1000);
        });

    };
})(jQuery);