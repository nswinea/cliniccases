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
        var opts = {
            offset: 'bottom-in-view',
            onlyOnScroll: true,
            //navUrl: $('.navigation').find('a').attr('href')
        };

        $('.infinite').waypoint(function () {
            var navUrl = $('.navigation').find('a').attr('href');
            $.get(navUrl, function (data) {
                //console.log($(data).find('.inf_contain'));
                var content = $(data);
                content.find('.infinite>li').appendTo('.infinite');
                $('.navigation').html(content.find('.navigation').html());
                $('ul[data-role=listview]').listview('refresh');
                $('.infinite').waypoint(opts);
            });

        }, opts);
    }
});

//Handle Nav
$(document).on('pagecreate', function () {
    $('#m_head').find('a').removeClass('ui-btn-active');
    var path = $.mobile.path.parseUrl(window.location.href);
    var target = 'index.php' + path.search;
    $('#m_head').find('a[href="' + target + '"]').addClass('ui-btn-active');
});

