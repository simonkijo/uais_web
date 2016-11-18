$('.btn_recover').click(function(){
	var uname = $('.i_uname').val();
	var email = $('.i_email').val();
	
	if(uname == ''){
		$('.a_uname_error').addClass('has-error');
		$('.uname_error').text('Username is required');
		return false;
	}
	if(email == ''){
		$('.a_email_error').addClass('has-error');
		$('.email_error').text('E-mail is required');
		return false;
	}else if(emailValidation(email) == false){
		$('.a_email_error').addClass('has-error');
		$('.email_error').text('Valid E-mail format is example@gmail.com');
		return false;
	}
});
//for enter key validation
$(document).bind('keypress', function(e){
	var uname = $('.i_uname').val();
	var email = $('.i_email').val();
	
	if(e.which == 13){
		if(uname == ''){
			$('.a_uname_error').addClass('has-error');
			$('.uname_error').text('Username is required');
			return false;
		}
		if(email == ''){
			$('.a_email_error').addClass('has-error');
			$('.email_error').text('E-mail is required');
			return false;
		}else if(emailValidation(email) == false){
			$('.a_email_error').addClass('has-error');
			$('.email_error').text('Valid E-mail format is example@gmail.com');
			return false;
		}
	}
});
//end of enter key validation
$('.i_uname,.i_email').keyup(function(){
	$('.a_uname_error,.a_email_error').removeClass('has-error');
	$('.uname_error,.email_error').text('');
});

//for validating email
function emailValidation(parameter){
	var mailformat = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,3})+$/.test(parameter);
	if(mailformat == true){  
		return true;  
	}else{    
		return false;  
	}
}