<?php
require_once 'core/init.php';

//$_SESSION['uname'] = Input::get('username');

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'username' => array(
               'required' => true
            ),
            'password' => array(
                'required' => true
            ),
        ));
        if($validation->passed()){
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
//            $pass = Input::get('password');
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);
            if($login){
                Redirect::to('index.php');
            } else {
                ?>
                <script type="text/javascript"> alert(" Sorry, Logging failed. ")</script>
<?php
//                echo '<p> Sorry, Logging failed. </p>';
//                echo Hash::make($pass, $user->data()->salt);
            }
        } else {
            foreach ($validation->errors() as $er) {
                echo $er, '<\ br>';
            }
        }
    }
}
?>

<!DOCTYPE html>
    <div id="loginForm">
        <form action="login.php" method="POST">
            <!--<div>
                <h1 id="signin">Sign in</h1>
            </div> -->

            <img id="easypayLogo" src="images/logo.png" height="100px"/>
            <div>
                <input required id="username" type="text" name="username" autocomplete="off" placeholder="Enter username" size="25" maxlength="20"/>
            </div>
            <div>
                <input required id="password" type="password" name="password" autocomplete="off" placeholder="Enter password" size="25" maxlength="20"/>
            </div>
            <div id="remember"><input type="checkbox"  name="remember"/> Remember me</div>

            <div>
                <input id="loginButton" type="submit" value="Sign in" name="signin"/>
            </div>
            <div id="forgotPassword">  <a href="forgetpass.php" title="To recover your password, click here " >Forgot password?</a></div>
            <hr id="hr">

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
        <a href="register.php"><button id="signupButton">Sign up</button></a>

    </div>

</div>
</body>
</html>