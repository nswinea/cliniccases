(function ($) {

    $.fn.mInfinite = function (options) {

    // Create some defaults, extending them with any options that were provided
        var settings = $.extend({
            nextSelector: 'div.navigation a:first',
            navSelector: 'div.navigation',
            itemSelector: 'div.post',
            listSelector: 'ul.infinite'
        }, options);

        var methods = {
            init : function (options) {
            },
            show : function () {
            // IS
            },
            hide : function () {
            // GOOD
            },
            update : function (content) {
            // !!!
            }
        };

        $.fn.mInfinite = function (method) {

            // Method calling logic
            if (methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if (typeof method === 'object' || ! method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' +  method + ' does not exist on jQuery.mInfinite');
            }

        };


        return this.each(function () {

            // Tooltip plugin code here
            var o = options;
            var req = $(o.nextSelector).attr('href');
            console.log(o);

            //you don't want to set a bunch of AJAX requests at once,
            //so set a flag so only one will go off at a time
            $(window).on('scroll', function () {
                var yDistance = $('body').scrollTop();
                console.log('yDistance= ' + yDistance + ' window.height= ' + $(window).height() + ' mobile.ui-content.height= ' + $.mobile.activePage.children('.ui-content').height());

                //here you can check how far down the user is and do your AJAX call
                if ((yDistance + $(window).height()) > ($.mobile.activePage.children('.ui-content').height() - 150)) {
                    $('<div/>').load(req + ' .inf_contain', function () {
                        $(this).children('li').appendTo(o.listSelector);
                        $(o.navSelector).html($(this).find('.navigation a'));
                        $('ul[data-role=listview]').listview('refresh');
                    });
                }
            });

        });
    };
})(jQuery);
