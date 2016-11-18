//student and lecturer validation
$('.btn_save').click(function(){
	var phone_no = $('.i_phone_no').val();
	var email = $('.i_email').val();
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	var repwd = $('.i_repwd').val();
	
	if(phone_no == ''){
		$('.a_phone_no_error').addClass('has-error');
		$('.phone_no_error').text('Phone Number is required');
		return false;
	}else if(phoneNoValidation(phone_no) == false){
		$('.a_phone_no_error').addClass('has-error');
		$('.phone_no_error').text('Valid format is, example +255-XXX-XXXXXX');
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
		$('.pwd_error').text('Password must be atleast 8 Characters');
		return false;
	}
	if(repwd == ''){
		$('.a_repwd_error').addClass('has-error');
		$('.repwd_error').text('Please retype password');
		return false;
	}else if(pwd != repwd){
		$('.a_repwd_error').addClass('has-error');
		$('.repwd_error').text('Passwords should match');
		return false;
	}
});
//for enter key validation
$(document).bind('keypress', function(e){
	var phone_no = $('.i_phone_no').val();
	var email = $('.i_email').val();
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	var repwd = $('.i_repwd').val();
	
	if(e.which == 13){
		if(phone_no == ''){
			$('.a_phone_no_error').addClass('has-error');
			$('.phone_no_error').text('Phone Number is required');
			return false;
		}else if(phoneNoValidation(phone_no) == false){
			$('.a_phone_no_error').addClass('has-error');
			$('.phone_no_error').text('Valid format is, example +255-XXX-XXXXXX');
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
			$('.pwd_error').text('Password must be atleast 8 Characters');
			return false;
		}
		if(repwd == ''){
			$('.a_repwd_error').addClass('has-error');
			$('.repwd_error').text('Please retype password');
			return false;
		}else if(pwd != repwd){
			$('.a_repwd_error').addClass('has-error');
			$('.repwd_error').text('Passwords should match');
			return false;
		}
	}
});
//end of enter key validation
//end of student and lecturer

$('.i_phone_no,.i_email,.i_uname,.i_pwd,.i_repwd').keyup(function(){
	$('.a_phone_no_error,.a_email_error,.a_uname_error,.a_pwd_error,.a_repwd_error').removeClass('has-error');
	$('.phone_no_error,.email_error,.uname_error,.pwd_error,.repwd_error').text('');
});

//for checking characters and space in nationality.
function nationalityValidation(parameter){    
	var letters = /^[A-Za-z ]+$/.test(parameter);
	if(letters == true){  
		return true;  
	}else{    
		return false;  
	}  
}
//for validating phone no
function phoneNoValidation(parameter){
	var numbers = /^\+?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{6})$/.test(parameter);
	if(numbers == true){  
		return true;  
	}else{    
		return false;  
	}
}
//for validating email
function emailValidation(parameter){
	var mailformat = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,3})+$/.test(parameter);
	if(mailformat == true){  
		return true;  
	}else{    
		return false;  
	}
}