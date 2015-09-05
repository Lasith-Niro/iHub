<?php
require_once 'core/init.php';


if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
if($user->isLoggedIn()) {
    $_SESSION['user_name'] = $user->data()->username;

    ?>
    <p>Wellcome <?php echo escape($user->data()->username) ?></p>
<!--    <p>Hello <a href="profile.php?user=--><?php //echo escape($user->data()->username); ?><!--"> --><?php //echo escape($user->data()->username); ?><!-- </a> ! </p>-->
    <ul>
<!--        <li><a href="profile.php">My profile </a> </li>-->
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Change password</a></li>
        <li><a href="changephonenumber.php">Change Phone Number</a> </li>
        <li><a href="logout.php">Log out </a></li>
    </ul>
    <div class="row-fluid">
        <div class="col-md-5 col-md-offset-1">
            <h4><span id=tick2>
				</span>&nbsp;|
                <script>
                    function show2(){
                        if (!document.all&&!document.getElementById)
                            return
                        thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
                        var Digital=new Date()
                        var hours=Digital.getHours()
                        var minutes=Digital.getMinutes()
                        var seconds=Digital.getSeconds()
                        var dn="PM"
                        if (hours<12)
                            dn="AM"
                        if (hours>12)
                            hours=hours-12
                        if (hours==0)
                            hours=12
                        if (minutes<=9)
                            minutes="0"+minutes
                        if (seconds<=9)
                            seconds="0"+seconds
                        var ctime=hours+":"+minutes+":"+seconds+" "+dn
                        thelement.innerHTML=ctime
                        setTimeout("show2()",1000)
                    }
                    window.onload=show2
                    //-->
                </script>
                <?php
                $date = new DateTime();
                echo $date->format('l, F jS, Y');
                ?><h4>
        </div>
    </div>
<?php

    if ($user->userLevel('admin')) {
        echo '<p> You are an administrator</p>';
    } elseif ( $user->userLevel('mod')) {
        echo '<p>You are a moderator </p>';
    } else {
       echo '<p> hi </p>';
    }


} else {
    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}
//$userInsert = DB::getInstance()->update('users', 9, array(
//    'fname' => 'updated'
//));
//
//if($userInsert){
//    echo 'ok';
//}