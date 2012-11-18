<?php if ($_POST){require('includes/Login.php');}?>

<div data-role="page" id="mobile_login">

    <div data-role="header" data-theme="b">
        <h1><img class="login_image" src="../html/images/logo_sm.png"></h1>
        <h3> <?php echo CC_PROGRAM_NAME; ?></h3>
    </div>

    <div data-role="content">   

        <div data-role="popup" id="loginError">
            <p>Sorry, but your login failed.  Please try again.</p>
        </div>
        
        <form name="login" id="login" > 
            <div data-role="divcontain">
                <label for "username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div data-role="divcontain">
                <label for "password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <button id="loginButton">Login</button>
        </form>
    </div>
</div>

