<?php
require_once 'core/init.php';

$user = new User();
$grp = new Group();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $myID = $user->data()->id;

        $arr = $grp->getGroups($myID);

        foreach($arr as $i){
            echo $i;
        }


    }
}
?>

<!--<html>-->
<!--<head>-->
<!--    <body>-->
<!--        <input type="hidden" name="token" value="--><?php //echo Token::generate(); ?><!--"/>-->
<!--    </body>-->
<!--</head>-->
<!--</html>-->