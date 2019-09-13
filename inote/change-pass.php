<?php

require_once 'core/init.php';

if (!$user){
    header('Location:index.php');
}

$old_pass = md5($_POST['old_pass']);
$data['password'] = @$_POST['new_pass'];
$re_new_pass = @$_POST['re_new_pass'];


// Các biến chứa code JS về thông báo
$show_alert = "<script>$('#formChangePass .alert').removeClass('hidden');</script>";
$hide_alert = "<script>$('#formChangePass .alert').addClass('hidden');</script>";
$success_alert = "<script>$('#formChangePass .alert').attr('class', 'alert alert-success');</script>";

if ($old_pass != $data_user['password']){
    echo $show_alert.'Mật khẩu cũ nhập không chính xác, đảm bảo đã tắt caps lock.';
}else if (strlen($data['password']) < 6) {
    echo $show_alert.'Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn.';
}elseif($data['password'] != $re_new_pass){
    echo $show_alert.'Nhập lại mật khẩu mới không khớp, đảm bảo đã tắt caps lock.';
}else{

    $data['password'] = md5($data['password']);

    $DB->update('users', $data, "WHERE id_user = '$data_user[id_user]'");

    echo $show_alert.$success_alert.'Đổi mật khẩu thành công.
        <script>
            location.reload();
        </script>
    ';

}

