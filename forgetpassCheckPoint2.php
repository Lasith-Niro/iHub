<?php
require_once 'core/init.php';


$user = new User();
$id = $_SESSION['id'];
//if(!$user->isLoggedIn()){
//    Redirect::to('index.php');
//}
echo $id;
if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_new' => array(
                'required' => true,
                'min' => 6,
                'regexPassword' => 'password'
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            )
        ));

        if($validation->passed()){
            $user->update(array('password' => Hash::make(Input::get('password_new'))), $id
                );
            Session::flash('home', 'Your password has been changed.');
            Redirect::to('index.php');
            }

        } else {
            foreach ($validation->errors() as $error) {
                ?>
                <script type="text/javascript"> alert(" Sorry, process failed.")</script>
            <?php
            }
        }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="Password_new">New password</label>
        <input type="password" name="password_new" id="password_new">
    </div>
    <div class="field">
        <label for="Password_new_again">New password again</label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>
    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>