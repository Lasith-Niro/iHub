<?php
require_once 'core/init.php';
$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
//    echo "exists";
    if(Token::check(Input::get('token'))) {
//        echo "token";
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'groupName' => array(
                'required' => true,
                'min' => 3,
                'max' => 20
            )
        ));
        if($validation->passed()){
            $grp = new Group();
            $AdID   = $user->data()->id;
            $gName = Input::get('groupName');
            $mID = $user->data()->id;
            $curDate  = date("Y-m-d");
            $curTime  = date("h:i:s");

            try{
//                $query = "INSERT INTO group VALUES ('$gName', '$AdID', '$mID', '$curDate','$curTime')";
//                mysql_query($query);
                $grp->createGroup(array(
                    'grpName' => $gName,
                    'AdminID' => $AdID,
                    'ModeratorID' => $mID,
                    'date' => $curDate,
                    'time' => $curTime
                ));
//                echo $gName . "   ";
//                echo $mID . "   ";
//                echo $AdID . "   ";
//                echo $curDate . "   ";
//                echo $curTime . "   ";
//                Session::flash('home', 'new group created');
                $user->update(array(
                    'levels' => 3
                ));
//                $_SESSION['grpName'] = $gName;
                Redirect::to('addMembers.php');


            }catch (Exception $e){
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $er) {
                echo $er, '<\ br>';
            }
        }
    }
}
?>

<form action="" method="post">
    <div>
        <input id="groupName" type="text" name="groupName" placeholder="Group Name" value="<?php echo escape(Input::get('groupName')); ?>">
        <input type="submit" value="Create">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>