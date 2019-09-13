<?php

// Include database, session, general info
require_once 'core/init.php';

if ($user){
    header("Locaion:index.php");
}

<<<<<<< HEAD
$data['username'] = isset($_POST['user_signup']) ? $DB->escape_string($_POST['user_signup']) : false;
$data['password'] = isset($_POST['pass_signup']) ? $_POST['pass_signup'] : false;
$repass_signup = isset($_POST['repass_signup']) ? $_POST['repass_signup'] : false;

if (!$data['username'] || !$data['password'] || !$repass_signup){
=======
$user_signup = isset($_POST['user_signup']) ? $DB->real_escape_string($_POST['user_signup']) : false;
$pass_signup = isset($_POST['pass_signup']) ? $_POST['pass_signup'] : false;
$repass_signup = isset($_POST['repass_signup']) ? $_POST['repass_signup'] : false;

if (!$user_signup || !$pass_signup || !$repass_signup){
>>>>>>> inote day1-1
    die('values dose not exist');
}

// Các biến chứa code JS về thông báo
$show_alert = "<script>$('#formSignup .alert').removeClass('hidden');</script>";
$hide_alert = "<script>$('#formSignup .alert').addClass('hidden');</script>";
$success_alert = "<script>$('#formSignup .alert').attr('class', 'alert alert-success');</script>";


<<<<<<< HEAD
$sql_check = "SELECT username FROM users WHERE username = '" .$data['username']. "'";

if (strlen($data['username']) < 6 || strlen($data['username']) > 24){

    echo $show_alert .'Tên đăng nhập phải nằm trong khoảng 6-24 ký tự.';

}elseif (preg_match('/\W/', $data['username'])){

    echo $show_alert.'Tên đăng nhập không được chứa ký tự đặc biệt và khoảng trắng.';

}elseif($DB->num_nows($sql_check)){

    echo $show_alert.'Tên đăng nhập đã tồn tại, vui lòng sử dụng tên khác.';

}elseif(strlen($data['password']) < 6){

    echo $show_alert.'Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn.';

}elseif ($data['password'] != $repass_signup){
    echo $show_alert.'Mật khẩu nhập lại không khớp, đảm bảo đã tắt caps lock.';
}else{

    // ma hoa pass
    $data['password'] = md5($data['password']);

    // set time zone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date_current = '';
    $date_current = date("Y-m-d H:i:sa");

    $data[$date_current];
    $DB->insert('users', $data);

    $Session->send($data['username']);

    echo $show_alert.$success_alert." Đăng ký tài khoản thành công.
        <script>
            location.reload();
        </script>
    ";

}

=======
$sql_check = "SELECT username FROM users WHERE username = '$user_signup'";

if (strlen($user_signup) < 6 || strlen($user_signup) > 24){
    $show_alert .'Tên đăng nhập phải nằm trong khoảng 6-24 ký tự.';
}
>>>>>>> inote day1-1
