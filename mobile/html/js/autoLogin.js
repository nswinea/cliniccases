
//auto login
if (localStorage.ccmHash)
{
    
    $.post('includes/Login.php', {'auto' : localStorage.ccmHash,
    'username' : localStorage.ccmUser, 'password' : false,
    'remember' : false}, function (data) {
        var serverResponse = $.parseJSON(data);
        if (serverResponse.error === true)
        {
            return false;
        }
        else
        {
            //redirect
            window.location = 'index.php?i=home';
        }
            
    });
}


