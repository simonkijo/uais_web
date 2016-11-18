$('.btn_sign_in').click(function(){
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	
	if(uname == ''){
		$('.a_uname_error').addClass('has-error');
		$('.uname_error').text('Username is required');
		return false;
	}
	if(pwd == ''){
		$('.a_pwd_error').addClass('has-error');
		$('.pwd_error').text('Password is required');
		return false;
	}else if(pwd_len < 8){
		$('.a_pwd_error').addClass('has-error');
		$('.pwd_error').text('Password must be atleast 8 characters');
		return false;
	}
});
//for enter key validation
$(document).bind('keypress', function(e){
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	
	if(e.which == 13){
		if(uname == ''){
			$('.a_uname_error').addClass('has-error');
			$('.uname_error').text('Username is required');
			return false;
		}
		if(pwd == ''){
			$('.a_pwd_error').addClass('has-error');
			$('.pwd_error').text('Password is required');
			return false;
		}else if(pwd_len < 8){
			$('.a_pwd_error').addClass('has-error');
			$('.pwd_error').text('Password must be atleast 8 characters');
			return false;
		}
	}
});
//end of enter key validation
$('.i_uname,.i_pwd').keyup(function(){
	$('.a_uname_error,.a_pwd_error').removeClass('has-error');
	$('.uname_error,.pwd_error').text('');
});