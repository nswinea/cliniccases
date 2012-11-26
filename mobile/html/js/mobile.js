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
        $('.infinite').mInfinite({
            navSelector  : 'div.navigation',
            // selector for the paged navigation (it will be hidden)

            nextSelector : 'div.navigation a:first',
            // selector for the NEXT link (to page 2)

            itemSelector : 'ul.infinite li',
            // selector for all items you'll retrieve

            listSelector : 'ul.infinite',
            // selector for all items you'll retrieve

        }, function ()
        {
            //Refresh list when new data added via infinite scroll
            $('ul[data-role=listview]').listview('refresh');
            alert('refresh bitch');

            //Handle search
            $('.inf_search').keyup(function () {
                var searchTerm = $(this).val();
                if (searchTerm.length > 2)
                {
                    //$(window).unbind('.infscr');
                    $('div.inf_contain').load('index.php?i=cases&search=' +
                    searchTerm + ' div.inf_contain', function () {
                        $('ul[data-role=listview]').listview();
                    });
                }
            });
        });

    }
});

//Handle Nav
$(document).on('pagecreate', function () {
    $('#m_head').find('a').removeClass('ui-btn-active');
    var path = $.mobile.path.parseUrl(window.location.href);
    var target = 'index.php' + path.search;
    $('#m_head').find('a[href="' + target + '"]').addClass('ui-btn-active');
});

