<?php
require_once 'core/init.php';

if ($user){
    header('Location:index.php');
}

$user_signin = $DB->escape_string(@$_POST['user_signin']);
$pass_signin = @md5($_POST['pass_signin']);

$show_alert = "<script>$('#formSignin .alert').removeClass('hidden');</script>";
$hide_alert = "<script>$('#formSignin .alert').addClass('hidden');</script>";
$success_alert = "<script>$('#formSignin .alert').attr('class', 'alert alert-success');</script>";

$sql_check_user = "SELECT username FROM users WHERE username = '$user_signin' ";

// check user tồn tại hay không
if ($DB->num_nows($sql_check_user)){

    $sql_check_login = "SELECT username FROM users WHERE username = '$user_signin' AND password = '$pass_signin'";

    // check password
    if ($DB->num_nows($sql_check_login)){

        $Session->send($user_signin);
        echo $show_alert.$success_alert." Đăng nhập thành công.
            <script>
                location.reload();
            </script>
        ";


    }else{

        echo $show_alert. " Mật khẩu không chính xác, xin mời nhập lại ";

    }

}else{
    echo $show_alert." Tên tài khoản không tồn tại, xin mời nhập lại";
}