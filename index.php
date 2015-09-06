<?php
require_once 'core/init.php';


if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
if($user->isLoggedIn()) {
    $_SESSION['user_name'] = $user->data()->username;

    ?>
    
<!--    <p>Hello <a href="profile.php?user=--><?php //echo escape($user->data()->username); ?><!--"> --><?php //echo escape($user->data()->username); ?><!-- </a> ! </p>-->
    <html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/css.css"/>
</head>
<body>
    <div id="top-menu">
    <ul>
        <li><a href="update.php">Update details</a></li>
        <li><a href="myGroups.php">Fourm</a>
            <ul>
                <li><a href="createGroup.php">Create group</a></li>
                <li><a href="#">Group Settings</a></li>
                <li><a href="create_topic.php">Create Topics</a></li>
                <li><a href="main_forum.php">View Topics</a></li>
            </ul>
        </li>
        <li><a href="#">contact us</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Profile</a>
            <ul>
                <li><a href="changepassword.php">Change password</a></li>
                <li><a href="changephonenumber.php">Change Phone Number</a> </li>
                <li><a href="logout.php">Log out </a></li>
            </ul>
        </li>
    </ul>
    </div>
    <div id="container">
        <div class="sidebar">
            <ul id="nav">
                <li><a class="selected" href="#">Dashboad</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
    <div class="content">

        <h1>Dashboard</h1>
            <p>Wellcome <?php echo escape($user->data()->username) ?></p>
           <div id="box">
                <div class="box-top">News</div>
                <div class="box-panel">
                    This is some simple pages
    }
                </div>
            </div>
    </div>
    
</body>
</html>
<?php

    //echo $user->data()->levels;

    if( $user->data()->levels == 1) {
        echo "standed user";
    } elseif ( $user->data()->levels == 2) {
        echo '<p> You are an moderator</p>';
    } elseif ( $user->data()->levels == 3) {
        echo '<p> You are an Admin</p>';
    }

//    if  ( $user->userLevel('mod')) {
//        echo '<p> You are an moderator</p>';
//    }
//    elseif ($user->userLevel('admin')) {
//        echo '<p>You are a Administrator </p>';
//    }


} else {
    echo '
<!DOCTYPE html>
<html>
<head>

<!-- your webpage info goes here -->

    <title>My First Website</title>
    
    <meta name="author" content="your name" />
    <meta name="description" content="" />

<!-- you should always add your stylesheet (css) in the head tag so that it starts loading before the page html is being displayed -->  
    <link rel="stylesheet" href="style.css" type="text/css" />
    
</head>
<body>

<!-- webpage content goes here in the body -->

    <div id="page">
        <div id="logo">
            <h1><a href="/" id="logoLink">IHub</a></h1>
        </div>
        <div id="nav">
            <ul>
                <li><a href="login.php">Login in here</a></li>
                <li><a href="register.php">Register in here</a></li>
            </ul>   
        </div>
        <div id="content">
            <h2>Hi..</h2>
            <p>
                there you can create group and share their nots/tasks/documents with other members!
            </p>
            <h2></h2>
            <p> 
                here you will find others with similar interests who are willing to share their experience on questions or comments you may have. Please read our Discussion Forum Terms of Use.
            </p>
        </div>
        <div id="footer">
            <p>
                Made by Cyblnnovators
            </p>
        </div>
    </div>
</body>
</html>
    ';
}

?>

<?php include('css/style.css');?>
