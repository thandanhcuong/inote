<?php

//includes Files
require_once 'core/init.php';

//includes Header
require_once 'includes/header.php';

// LAYOUT
// Nếu tồn tại $user

if ($user) {

    // Kiểm tra hành động
    if (isset($_GET['ac'])) {

        // xử lý chuỗi $ac
        $ac = addslashes(trim(htmlentities($_GET['ac'])));

        //nếu $ac == create_note thì includes file create-note-form.php
        if ($ac == 'create_note') {

            require_once 'templates/create-note-form.php';

            //nếu  $ac = edit_note thì includes file create-note-form.php
        } elseif ($ac == 'edit_note') {

            // kt xem có ID truyền vào hay không
            if (isset($_GET['id'])) {

                // xử lý ID truyền vào
                $get_id = addslashes(trim(htmlentities($_GET['id'])));

                // kt Id not null
                if (!empty($get_id)) {

                    // Lệnh truy vấn kiểm tra sự tồn tại và quyền sở hữu note
                    $sql_check = "SELECT id_note, user_id FROM notes WHERE user_id = '$data_user[id_user]' AND id_note='$get_id' ";

                    // nếu tồn tại và thuộc quyền sở hữu
                    if ($DB->num_nows($sql_check)) {

                        // include templates edit
                        require_once 'templates/edit-note-form.php';

                    } else {
                        // Hiển thị thông báo lỗi
                        echo '
                            <div class="container">
                                <div class="alert alert-danger">
                                    Note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.
                                </div>
                            </div>
                        ';
                    }

                    // nếu không có id truyền vào
                }

            } else {
                header("Location:index.php");
            }


        }//nếu  $ac = change_password thì includes file change-pass-form.php
        elseif ($ac == "change_password") {

            //includes templates change_password
            require_once 'templates/change-pass-form.php';

        }

    }else { // không thực hiện hành động nào cả

        //includes templates list note
        require_once 'templates/list-note.php';

    }
} // Ngược lại không tồn tại $user
else{
    // Include template form đăng nhập, đăng ký
    require_once 'templates/signin-up-form.php';
}



//includes Footer
require_once 'includes/footer.php';