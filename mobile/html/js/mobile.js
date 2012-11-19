$(document).bind('pageinit', function () {
 
 
    $('#loginButton').click(function(event){
        event.preventDefault();
        if ($('input[name="username"]').val() == '' || $('input[name="password"]').val() == '') 
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
 
 
 
 
});
