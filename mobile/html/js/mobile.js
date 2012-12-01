$(document).bind('pageinit', function () {

    $('#loginButton').click(function (event) {
        event.preventDefault();
        if ($('input[name="username"]').val() === '' || $('input[name="password"]').val() === '')
        {
            $('#loginError p').html('You must supply a username and password.');
            $('#loginError').popup('open');
            return false;
        }
        else
        {
            $.post('includes/Login.php', $('#login').serialize(), function (data) {
                var serverResponse = $.parseJSON(data);
                if (serverResponse.error === true)
                {
                    $('#loginError p').html(serverResponse.message);
                    $('#loginError').popup('open');
                }
                else
                {
                    if (serverResponse.hash)
                    {
                        localStorage.ccmUser = serverResponse.username;
                        localStorage.ccmHash = serverResponse.hash;
                    }
                    //redirect
                    window.location = 'index.php?i=home';
                }

            });
        }

    });

    //Go back in history on swipe right
    $(document).swiperight(function () {
        history.go(-1);

    });

    //Handle infinite scroll
    if ($('.infinite').length)
    {
        //set jquery waypoint options
        var opts = {
            offset: 'bottom-in-view',
            onlyOnScroll: true,
        };

        var iScroll = function () {
            $('.infinite').waypoint(function () {
                //Hide nav div; if no js, user can click link
                $('.navigation').hide();

                var navUrl = $('.navigation').find('a').attr('href');
                $.ajax(navUrl, {
                    beforeSend: function () {$.mobile.loading('show'); },
                    complete: function () {$.mobile.loading('hide'); }
                }).done(
                    function (data) {
                        var content = $(data);
                        content.find('.infinite>li').appendTo('.infinite');
                        $('.navigation').html(content.find('.navigation').html());
                        $('ul[data-role=listview]').listview('refresh');
                        $('.infinite').waypoint(opts);
                    });

            }, opts);
        };

        iScroll();
    }

    //Handle infinite scroll on search
    if ($('.inf_search').length)
    {
        $('.inf_search').keyup(function () {
            $('div.inf_contain').load('index.php?i=cases&search=' + $(this).val() + ' div.inf_contain', function () {
                $('ul[data-role=listview]').listview();
                iScroll();
                $('.navigation').hide();
            });
        });

        $('.ui-input-clear').on('click', function () {
            $('div.inf_contain').load('index.php?i=cases div.inf_contain', function () {
                $('ul[data-role=listview]').listview();
            });
        });
    }
});

//Handle Nav
$(document).on('pageshow', function () {
    $('#m_head').find('a').removeClass('ui-btn-active');
    var path = $.mobile.path.parseUrl(window.location.href);
    var target = 'index.php' + path.search;
    var navChoices = ['home', 'cases', 'messages', 'board', 'journals'];
    $.each(navChoices, function (index, value) {
        if (target.indexOf(value) !== -1)
        {
            $('#m_head').find('a[data-index="' + index + '"]').addClass('ui-btn-active');
        }
    });
});

