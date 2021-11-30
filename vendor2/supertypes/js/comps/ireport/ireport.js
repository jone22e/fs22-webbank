function ireport() {
    return {
        init : function () {
            $('#btn-compilar').unbind('click');
            $('#btn-compilar').click(function () {
                ireport.toXML();
            });

            $('.element').unbind('click');
            $('.element').click(function () {

                ele = $(this);

                $('.ui-resizable-handle').remove();
                $('.ht').val(ele.html());

                $('.ht').unbind('change');
                $('.ht').change(function () {
                    ele.html($('.ht').val());
                });
                ireport.init();
            });

            $('.element').resizable({
                handles: 'se',
            });
            $('.element').draggable({
                //containment: '.book',
                containment: "parent",
                scroll: false,
                start: function () {
                },
                drag: function (event, ui) {
                },
                stop: function (event, ui) {
                }
            });


        },
        load : function () {

        },
        toXML : function () {

            var sections = [];

            $('.ui-resizable-handle').remove();

            $( ".section" ).each(function( index ) {
                var elements = [];
                $( ".element", $(this) ).each(function( index ) {
                    elements.push({
                        "element" : {
                            "type" : $(this).attr('element'),
                            "html" : $(this).html(),
                            "width" : $(this).css("width"),
                            "height" : $(this).css("height"),
                            "fontsize" : $(this).css("font-size"),
                            "top" : $(this).css("top"),
                            "left" : $(this).css("left"),
                        }
                    })
                });

                sections.push({
                   "section" : {
                       "type" : $(this).attr('section'),
                       "height" : $(this).css("height"),
                       "elements" : elements
                   }
                });
            });

            $.ajax({
                method: "POST",
                url: "/backend/js/comps/ireport/generatejrxml.php",
                /*dataType: "json",*/
                data: {
                    json : JSON.stringify(sections)
                },
                beforeSend: function () {
                }
            }).done(function (res) {

            });

            ireport.init();
        }
    }
}

var ireport = new ireport();
ireport.init();