<?php
require_once 'core/init.php';

$user = new User();
$grp = new Group();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$myID = $user->data()->id;
//$arr = $grp->getGroups($myID)->data()->grpName;
$result = mysql_query("SELECT grpName FROM GroupDetails");
$storeArr = array();

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    $storeArr[] = $row['grpName'];
}

print_r($storeArr);


if(Input::exists()){
    if(Token::check(Input::get('token'))) {

    }
}
?>

<form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>