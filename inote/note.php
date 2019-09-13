<?php

require_once 'core/init.php';

// user k ton tai return index
if (!$user){
    header('location:index.php');
}

if (isset($_POST['ac'])){
    $ac = $_POST['ac'];

    if ($ac == 'create'){ // $ac == create note

        $data['title'] = $DB->escape_string(@$_POST['title_create_note']);
        $data['body'] = $DB->escape_string(@$_POST['body_create_note']);

        $data['user_id'] = $data_user['id_user'];
        $data['title'] = trim(htmlentities($data['title']));
        $data['body'] = htmlentities($data['body']);
        $data['date_created'] = date('Y-m-d H:i:s');

        $show_alert = "<script>$('#formCreateNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#formCreateNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#formCreateNote .alert').attr('class', 'alert alert-success');</script>";

        $DB->insert('notes', $data);

        echo $show_alert.$success_alert." Tạo note thành công
            <script>
                location.href = 'index.php';
            </script>
        ";

    }elseif($ac == 'edit'){ // $ac == edit

        // process data
        $data['title'] = $DB->escape_string(@$_POST['title_edit_note']);
        $data['body'] = $DB->escape_string(@$_POST['body_edit_note']);
        $id_note_edit = $DB->escape_string(@$_POST['id_edit_note']);

        $data['title'] = trim(htmlentities($data['title']));
        $data['body'] = htmlentities($data['body']);
        $id_note_edit = trim(htmlentities($id_note_edit));
        $data['date_created'] = date('Y-m-d H:i:s');

        $show_alert = "<script>$('#formEditNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#formEditNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#formEditNote .alert').attr('class', 'alert alert-success');</script>";

        $sql_check_edit = "SELECT id_note, user_id FROM notes WHERE id_note = '$id_note_edit' AND user_id = '$data_user[id_user]'";


        // kt note ton tai hay khong
        if ($DB->num_nows($sql_check_edit)){

            $DB->update('notes', $data, "WHERE user_id = '$data_user[id_user]' AND id_note = '$id_note_edit'");

            echo $show_alert.$success_alert." Đã chỉnh sửa note
                <script>
                    location.href = 'index.php';
                </script>
            ";


        }else{ // khong thi
            // Hiển thị thông báo lỗi
            echo $show_alert.'Bạn đã cố tình sửa chữa ID note, nhưng rất tiếc ID note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.';
        }

    } //
    else if ($ac == 'delete')
    {
        // Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
        $id_edit_note = $DB->escape_string(@$_POST['id_edit_note']);
        $id_edit_note = trim(htmlentities($id_edit_note));

        // Các biến chứa code JS về thông báo
        $show_alert = "<script>$('#modalDeleteNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#modalDeleteNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#modalDeleteNote .alert').attr('class', 'alert alert-success');</script>";

        // Lệnh SQL kiểm tra có tồn tại ID note và thuộc quyền sở hữu
        $sql_check_id_exist = "SELECT id_note, user_id FROM notes WHERE user_id = '$data_user[id_user]' AND id_note = '$id_edit_note'";

        // Nếu có
        if ($DB->num_nows($sql_check_id_exist))
        {
            // Thực thi truy vấn
            $DB->delete("id_note = '$id_edit_note'");

            // Hiển thị thông báo và trở về trang chủ
            echo $show_alert.$success_alert." Xoá note thành công.
            <script>
                location.href = 'index.php';
            </script>
        ";
        }
        // Ngược lại không
        else
        {
            // Hiển thị thông báo lỗi
            echo $show_alert.'Bạn đã cố tình sửa chữa ID note, nhưng rất tiếc ID note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.';
        }
    }




}