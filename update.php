 <?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'name' => array(
               'required' => true,
               'min' => 2,
               'max' => 50
           ),
           'fname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
           'lname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
           'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 100,
                'regexEmail' => 'email'
            )
        ));
        if($validation->passed()){
            try{
                $user->update(array(
                    'username' => Input::get('name'),
                    'fname' => Input::get('fname'),
                    'lname' => Input::get('lname'),
//                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                ));
                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch(Exception $err) {
                die($err->getMessage());
            }
        } else {
            foreach ($validation->errors() as $er) {
//                echo $er, '<br />';
                ?>
                <script type="text/javascript"> alert(" Sorry, Update failed. <?php echo $er ,'<br />';?>")</script>
 <?php
            }
        }
    }
}
?>

 <form action="" method="post">
    <div class="field">
        <label for="name">User Name</label>
        <input type="text" name="name" value="<?php echo escape($user->data()->username); ?>"/>
    </div>
    <div class="field">
        <label for="fname">First Name</label>
        <input type="text" name="fname" value="<?php echo escape($user->data()->fname); ?>">
    </div>
    <div class="field">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" value="<?php echo escape($user->data()->lname); ?>">
    </div>
    <div class="field">
        <label for="email">E-mail</label>
        <input type="text" name="email" value="<?php echo escape($user->data()->email); ?>">
    </div>
<!--    <div class="field">-->
<!--        <label for="nic">Phone number</label>-->
<!--        <input type="text" name="phone" value="--><?php //echo escape($user->data()->phone);?><!--">-->
<!--    </div>-->
    <input type="submit" value="Update">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>