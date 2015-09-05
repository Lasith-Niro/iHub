<?php

require_once 'core/init.php';
$user = new User();
$grp = new Group();

$newID = $grp->getgID(array('GroupDetails','gID',''));

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
            try{
                $user2 = new User($uname);
                if($user2->exists()){
                    $id = $user2->data()->id;
                    $grp->addUser(array(
                        'gID' => $newID,
                        'userID' => $id
                    ));
                    echo $uname . " added to your group";
                } else {
                    echo "user not exists";
                }
            } catch (Exception $e) {
                echo "$e";
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
    <div class="field">
        <label for="name">Enter your username </label>
        <input type="text" name="name" id="name">
    </div>
    <input type="submit" value="Search">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
