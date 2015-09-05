<?php
require_once 'core/init.php';
//var_dump — Dumps information about a variable
//var_dump(Token::check(Input::get('token')));

if(Input::exists()){
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                    'regexPassword' => 'password'
                ),
                'password_again' => array(
                    'required' => true,
                    'matches' => 'password'
                ),
                'phoneNo' => array(
                    'required' => true,
                    'min' => 10,
                    'regexPhone' => 'phoneNo'
                ),
                'name1' => array(
                    'required' => true,
                    'regexString' => 'name1'
                ),
                'name2' => array(
                    'required' => true,
                    'regexString' => 'name2'
                ),
                'email' => array(
                    'required' => true,
                    'regexEmail' => 'email',
                    'max' => 100
                )
            )
        );
        if($validation->passed()) {
            $_SESSION['username'] = Input::get('username');
            $_SESSION['password'] = Input::get('password');
            $_SESSION['name1']    = Input::get('name1');
            $_SESSION['name2']    = Input::get('name2');
            $_SESSION['email']    = Input::get('email');
            $_SESSION['phoneNo']  = Input::get('phoneNo');
            Redirect::to('registerConfirm.php');
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div id="navBar">
        <!--Unordered list-->
        <ul>
            <!--List items-->
            <li><a href="#" class="current">Home</a></li>
            <li><a href="http://www.ucsc.cmb.ac.lk/" >UCSC</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">contact</a></li>
            <li><a href="login.php">Sign in</a></li>

        </ul>
    </div>


    <div id="regForm">
        <form action="" method="post">
            <div>
                <input id="username" type="text" name="username"  placeholder="Enter username" value="<?php echo Input::get('username'); ?>" autocomplete="off" >
            </div>

            <div>
                <input id="password" type="password" name="password" placeholder="Enter password">
            </div>

            <div>
                <input id="password_again" type="password" name="password_again" placeholder="Enter your password again">
            </div>

            <div>
                <input id="name1" type="text" name="name1" placeholder="Your first name" value="<?php echo escape(Input::get('name1')); ?>">
            </div>
            <div>
                <input id="name2" type="text" name="name2" placeholder="Your last name" value="<?php echo escape(Input::get('name2')); ?>">
            </div>
            <div>
                <input id="email" type="email" name="email" placeholder="email address" value="<?php echo escape(Input::get('email')); ?>">
            </div>
            <div>
                <input id="phoneNo" type="text" name="phoneNo" placeholder="Mobile number" value="<?php echo escape(Input::get('phoneNo')); ?>">
            </div>
            <div>
                <input id="level" type="number" name="level" placeholder="Admin/moderator/user" value="<?php echo escape(Input::get('year')); ?>">
            </div>

            <input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input id="next" type="submit" value="Next">
        </form>


    </div>
<!--<script>
function myFunction() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("rePassword").value;
    if (pass1 != pass2) {
        //alert("Passwords Do not match");
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("rePassword").style.borderColor = "#E34234";
    }
    else {
        alert("Passwords Match!!!");
    }
}
myFunction();
</script> -->
</body>
</html>
