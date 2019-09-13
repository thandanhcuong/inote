$('#submit_create_note').on('click', function(){

    var title_create_note = $('#title_create_note').val();
    var body_create_note = $('#body_create_note').val();
    var ac = 'create';

    if (title_create_note == '' || body_create_note == ''){
        $('#formCreateNote .alert').removeClass('hidden');
        $('#formCreateNote .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');
    }else{

        $.ajax({
            url : 'note.php',
            type : 'post',
            data : {
                title_create_note : title_create_note,
                body_create_note : body_create_note,
                ac : ac
            },
            success : function(result){
                $('#formCreateNote .alert').removeClass('hidden');
                $('#formCreateNote .alert').html(result);
            }
        });

    }

});


$('#submit_edit_note').on('click', function(){

    var title_edit_note = $('#title_edit_note').val();
    var body_edit_note = $('#body_edit_note').val();
    var id_edit_note = $('#id_edit_note').val();
    var ac = 'edit';

    if (title_edit_note == '' || body_edit_note == ''){

        // Hiển thị thông báo lỗi
        $('#formEditNote .alert').removeClass('hidden');
        $('#formEditNote .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');

    }else if(id_edit_note == ''){

        $('#formEditNote .alert').removeClass('hidden');
        $('#formEditNote .alert').html('Lỗi cấu hình, không tìm thấy ID note cần sửa.');

    }else{

        $.ajax({
            url : 'note.php',
            type : 'post',
            data : {
                title_edit_note : title_edit_note,
                body_edit_note : body_edit_note,
                ac : ac,
                id_edit_note : id_edit_note
            },
            success : function(result){
                $('#formEditNote .alert').html(result);
            }

        });

    }

});

// Bắt sự kiện khi click vào nút Xoá
$('#submit_delete_note').on('click', function() {
    $ac = 'delete'; // Hành động
    $id_edit_note = $('#id_edit_note').val(); // Lấy ID trong field ẩn

    // Thực thi gửi dữ liệu bằng Ajax
    $.ajax({
        url : 'note.php', // Đường dẫn file nhận dữ liệu
        type : 'POST', // Phương thức gửi dữ liệu
        // Các dữ liệu
        data : {
            ac : $ac,
            id_edit_note : $id_edit_note
            // Thực thi khi gửi dữ liệu thành công
        }, success : function(data) {
            $('#modalDeleteNote .alert').html(data);
        }
    });
});