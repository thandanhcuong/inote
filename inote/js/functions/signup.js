$('#submit_signup').on('click', function() {

    var user_signup = $('#user_signup').val();
    var pass_signup = $('#pass_signup').val();
    var repass_signup = $('#repass_signup').val();


    // kt các biến dữ lêệu này có rỗng hay không
    if (user_signup == '' || pass_signup == '' || repass_signup == '') {
        $('#formSignup .alert').removeClass('hidden');
        $('#formSignup .alert').html('xin vui lòng nhập đầy đủ thông tin');

        // nếu không thì call ajax
    } else {

        $.ajax({
            url: 'signup.php',
            type: 'post',
            data: {
                user_signup: user_signup,
                pass_signup: pass_signup,
                repass_signup: repass_signup
            },
            success: function (result) {
                $('#formSignup .alert').html(result);
            }

        });


    }
});
