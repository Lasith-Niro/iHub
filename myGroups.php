<?php
require_once 'core/init.php';

$user = new User();
$grp = new Group();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$myID = $user->data()->id;
$arr = $grp->getGroups(array(
    'GroupDetails', array('AdminID', '=', $myID)
));
//print_r($arr);

while($row = mysql_fetch_object(array(
    'GroupDetails', array('AdminID', '=', $myID)))) {
    echo $row->grpName;
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {

    }
}
?>

<form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>