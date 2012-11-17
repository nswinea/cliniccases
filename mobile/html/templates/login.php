<div data-role="page" id="mobile_login">

    <div data-role="header" data-theme="b">
        <h1><img class="login_image" src="../html/images/logo_sm.png"></h1>
        <h3> <?php echo CC_PROGRAM_NAME; ?></h3>
    </div>

    <div data-role="content">   
        <form name="login" id="login" method="post" action="index.php?i=login" data-ajax="false">
            <div data-role="divcontain">
                <label for "username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div data-role="divcontain">
                <label for "password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <button>Login</button>
        </form>
    </div>
</div>

