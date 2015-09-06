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
            $_SESSION['phone']    = Input::get('phoneNo');
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
<body class="news">
    <header>
        <div class="nav">
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
h1{ font-size:28px;}
h2{ font-size:26px;}
h3{ font-size:18px;}
h4{ font-size:16px;}
h5{ font-size:14px;}
h6{ font-size:12px;}
h1,h2,h3,h4,h5,h6{ color:#563D64;}
small{ font-size:10px;}
b, strong{ font-weight:bold;}
a{ text-decoration: none; }
a:hover{ text-decoration: underline; }
.left { float:left; }
.right { float:right; }
.alignleft { float: left; margin-right: 15px; }
.alignright { float: right; margin-left: 15px; }
.clearfix:after,
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
    background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
    -webkit-box-shadow: 0 1px 0 #fff inset;
    -moz-box-shadow: 0 1px 0 #fff inset;
    -ms-box-shadow: 0 1px 0 #fff inset;
    -o-box-shadow: 0 1px 0 #fff inset;
    box-shadow: 0 1px 0 #fff inset;
    border: 1px solid #c4c6ca;
    margin: 0 auto;
    padding: 25px 0 0;
    position: relative;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    width: 400px;
}

#content h1 {
    color: #7E7E7E;
    font: bold 25px Helvetica, Arial, sans-serif;
    letter-spacing: -0.05em;
    line-height: 20px;
    margin: 10px 0 30px;
}
#content h1:before,
#content h1:after {
    content: "";
    height: 1px;
    position: absolute;
    top: 10px;
    width: 27%;
}
#content h1:after {
    background: rgb(126,126,126);
    background: -moz-linear-gradient(left,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: -o-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: -ms-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    right: 0;
}
#content h1:before {
    background: rgb(126,126,126);
    background: -moz-linear-gradient(right,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: -o-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: -ms-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    background: linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    left: 0;
}
#content:after,
#content:before {
    background: #f9f9f9;
    background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
    border: 1px solid #c4c6ca;
    content: "";
    display: block;
    height: 100%;
    left: -1px;
    position: absolute;
    width: 100%;
}
#content:after {
    -webkit-transform: rotate(2deg);
    -moz-transform: rotate(2deg);
    -ms-transform: rotate(2deg);
    -o-transform: rotate(2deg);
    transform: rotate(2deg);
    top: 0;
    z-index: -1;
}
#content:before {
    -webkit-transform: rotate(-3deg);
    -moz-transform: rotate(-3deg);
    -ms-transform: rotate(-3deg);
    -o-transform: rotate(-3deg);
    transform: rotate(-3deg);
    top: 0;
    z-index: -2;
}
#content form { margin: 0 20px; position: relative }
#content form input[type="text"],
#content form input[type="password"],
#content form input[type="email"],
#content form input[type="number"]{
    -webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
    -moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
    -ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
    -o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
    box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -ms-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
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
    background: -moz-linear-gradient(top,  rgba(254,231,154,1) 0%, rgba(254,193,81,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
    background: -o-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
    background: -ms-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
    background: linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
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
  background-color: #e67e22;
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
  background-color: #d35400;
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