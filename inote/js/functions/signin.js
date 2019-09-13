$('#submit_signin').on('click', function(){
    var user_signin = $('#user_signin').val();
    var pass_signin = $('#pass_signin').val();

    if (user_signin == '' || pass_signin == ''){

        $('#formSignin .alert').removeClass('hidden');
        $('#formSignin .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');

    }else{

        $.ajax({
           url : 'signin.php',
            type : 'post',
            data : {
                user_signin : user_signin,
                pass_signin : pass_signin
            },
            success : function(result){
                $('#formSignin .alert').html(result);
            }
        });

    }


});