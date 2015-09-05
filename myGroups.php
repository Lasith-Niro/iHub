<?php
require_once 'core/init.php';

$user = new User();
$grp = new Group();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$myID = $user->data()->id;
$arr = $grp->getGroups(array(
    'GroupDetails', array('adminID', '=', $myID)
));
print_r($arr);


if(Input::exists()){
    if(Token::check(Input::get('token'))) {

    }
}
?>

<form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>