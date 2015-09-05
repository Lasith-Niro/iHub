<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'userName' => array(
                'required' => true
            )
        ));

        $uname = Input::get('userName');
        if($validation->passed()){
            $user = new User();
            if($user->find($uname)){
//            echo "User exist";
                ?>
                <p> <a href="#"> <?php echo escape($user->data()->username); ?> </a> </p>
                <?php
                $_SESSION['phone'] = $user->data()->phone;
            } else {
                echo "User Not Found";
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
        <label for="Password_current">Enter user name</label>
        <input type="text" name="userName" id="userName">
    </div>
    <input type="submit" value="search">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>