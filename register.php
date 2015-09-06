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
                ?>
                <script type="text/javascript"> alert(" Sorry, process failed.". <?php echo escape($error); ?>)</script>
            <?php
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body class="news">
    <header>
        <div class="nav">
            <!--Unordered list-->
            <ul>
                <!--List items-->
                <li><a href="#" class="current">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">contact</a></li>
                <li><a href="login.php">Sign in</a></li>

            </ul>
        </div>
    </header>
    <div class="regForm">
        <section id="content">
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


<style>
body {
    background: #DCDDDF url(http://cssdeck.com/uploads/media/items/7/7AF2Qzt.png);
    color: #000;
    font: 14px Arial;
    margin: 0 auto;
    padding: 0;
    position: relative;
}
form:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}
.regForm { margin: 25px auto; position: relative; width: 900px; }
#content {
    background: #f9f9f9;
    border: 1px solid #c4c6ca;
    margin: 0 auto;
    padding: 25px 0 0;
    position: relative;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    width: 400px;
}


#content form { margin: 0 20px; position: relative }
#content form input[type="text"],
#content form input[type="password"],
#content form input[type="email"],
#content form input[type="number"]{
    border: 1px solid #c8c8c8;
    color: #777;
    font: 13px Helvetica, Arial, sans-serif;
    margin: 0 0 10px;
    padding: 6px 6px 10px 30px;
    width: 80%;
}
#content form input[type="text"]:focus,
#content form input[type="password"]:focus, 
#content form input[type="email"]:focus,
#content form input[type="number"]:focus{
    -webkit-box-shadow: 0 0 2px #ed1c24 inset;
    -moz-box-shadow: 0 0 2px #ed1c24 inset;
    -ms-box-shadow: 0 0 2px #ed1c24 inset;
    -o-box-shadow: 0 0 2px #ed1c24 inset;
    box-shadow: 0 0 2px #ed1c24 inset;
    background-color: #fff;
    border: 1px solid #ed1c24;
    outline: none;
}
#username { background-position: 10px 10px !important }
#password { background-position: 10px -53px !important }
#content form input[type="submit"] {
    background: rgb(254,231,154);
    border: 1px solid #D69E31;
    color: #85592e;
    cursor: pointer;
    float: left;
    font: bold 15px Helvetica, Arial, sans-serif;
    height: 35px;
    margin: 20px 0 35px 15px;
    position: relative;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    width: 120px;
}
#content form input[type="submit"]:hover {
    background: rgb(254,193,81);
    background: -moz-linear-gradient(top,  rgba(254,193,81,1) 0%, rgba(254,231,154,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
    background: -o-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
    background: -ms-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
    background: linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fec151', endColorstr='#fee79a',GradientType=0 );
}
#content form div a {
    color: #004a80;
    float: right;
    font-size: 12px;
    margin: 30px 15px 0 0;
    text-decoration: underline;
}

.button a:hover {
    background-position: 0 -135px;
    color: #00aeef;
}

.nav ul {
  list-style: none;
  background-color: #84C5DB;
  text-align: center;
  padding: 0;
  margin: 0;
}
.nav li {
  font-family: 'Oswald', sans-serif;
  font-size: 0.2em;
  line-height: 10px;
  height: 40px;
  border-bottom: 1px solid #888;
}
 
.nav a {
  text-decoration: none;
  color: #fff;
  display: block;
  transition: .3s background-color;
}
 
.nav a:hover {
  background-color: #196B6A;
}
 
.nav a.active {
  background-color: #fff;
  color: #444;
  cursor: default;
}
 
@media screen and (min-width: 600px) {
  .nav li {
    width: 120px;
    border-bottom: none;
    height: 50px;
    line-height: 50px;
    font-size: 1em;
  }
 
  /* Option 1 - Display Inline */
  .nav li {
    display: inline-block;
    margin-right: -4px;
  }
  .nav li {
    float: left;
  }
  .nav ul {
    overflow: auto;
    width: 600px;
    margin: 0 auto;
  }
</style>