<?php

require_once 'core/init.php';
require 'SMS/sms.php';
require 'Files/accessFile.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true
            )
        ));

    $uname = Input::get('name');
    if($validation->passed()){
        $user = new User();
        if($user->find($uname)){
//            echo "User exist";
        ?>
            <p> <a href="forgetpassCheckPoint.php"> <?php echo escape($user->data()->username); ?> </a> </p>
        <?php
            $_SESSION['phone'] = $user->data()->phone;
            $_SESSION['id'] = $user->data()->id;
        } else {
            echo "User Not Found";
        }
    } else {
        foreach ($validation->errors() as $er) {
            ?>
            <script type="text/javascript"> alert(" Sorry, process failed.")</script>
<?php
}
    }

    }
}
?>
<form action="" method="post">
    <div class="field">
        <label for="name">Enter your username </label>
        <input type="text" name="name" id="name">
    </div>
    <input type="submit" value="Search">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<!---->
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>Forgot Password</title>-->
<!--    <link rel="stylesheet" href="css/forget1CSS.css">-->
<!--</head>-->
<!--<body>-->
<!--<img id="ucscLogo" src="images/ucsc.png" />-->
<!--<img id="easypayLogo" src="images/logo.png" height="100px"/>-->
<!--<div id="mainWrapper">-->
<!---->
<!--    <div id="ForgotPassword">-->
<!--        <form action="" method="POST">-->
<!--            <div>-->
<!--                <input required id="verification" type="text" name="name" autocomplete="off" placeholder="Enter verification code" size="25" maxlength="20"/>-->
<!--            </div>-->
<!--            <input type="hidden" name="token" value="--><?php //echo Token::generate(); ?><!--">-->
<!--        </form>-->
<!--        <a href="register.php"><button id="nextButton">Next</button></a>-->
<!--    </div>-->
<!---->
<!--</div>-->
<!--</body>-->
<!--</html>-->