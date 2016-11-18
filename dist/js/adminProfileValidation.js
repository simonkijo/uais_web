//admin validation
$('.btn_save_admin').click(function(){
	var fname = $('.i_fname').val();
	var mname = $('.i_mname').val();
	var sname = $('.i_sname').val();
	var phone_no = $('.i_phone_no').val();
	var email = $('.i_email').val();
	var nationality = $('.i_nationality').val();
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	var repwd = $('.i_repwd').val();
	
	if(fname == ''){
		$('.a_fname_error').addClass('has-error');
		$('.fname_error').text('First Name is required');
		return false;
	}else if(allLetter(fname) == false){
		$('.a_fname_error').addClass('has-error');
		$('.fname_error').text('Letters Only');
		return false;
	}
	if(mname == ''){
		$('.a_mname_error').addClass('has-error');
		$('.mname_error').text('Middle Name is required');
		return false;
	}else if(allLetter(mname) == false){
		$('.a_mname_error').addClass('has-error');
		$('.mname_error').text('Letters Only');
		return false;
	}
	if(sname == ''){
		$('.a_sname_error').addClass('has-error');
		$('.sname_error').text('Surname is required');
		return false;
	}else if(allLetter(sname) == false){
		$('.a_sname_error').addClass('has-error');
		$('.sname_error').text('Letters Only');
		return false;
	}
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
	if(nationality == ''){
		$('.a_nationality_error').addClass('has-error');
		$('.nationality_error').text('Nationality is required');
		return false;
	}else if(nationalityValidation(nationality) == false){
		$('.a_nationality_error').addClass('has-error');
		$('.nationality_error').text('Alphabetical Letters Only');
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
	var fname = $('.i_fname').val();
	var mname = $('.i_mname').val();
	var sname = $('.i_sname').val();
	var phone_no = $('.i_phone_no').val();
	var email = $('.i_email').val();
	var nationality = $('.i_nationality').val();
	var uname = $('.i_uname').val();
	var pwd = $('.i_pwd').val();
	var pwd_len = $('.i_pwd').val().length;
	var repwd = $('.i_repwd').val();
	
	if(e.which == 13){
		if(fname == ''){
			$('.a_fname_error').addClass('has-error');
			$('.fname_error').text('First Name is required');
			return false;
		}else if(allLetter(fname) == false){
			$('.a_fname_error').addClass('has-error');
			$('.fname_error').text('Letters Only');
			return false;
		}
		if(mname == ''){
			$('.a_mname_error').addClass('has-error');
			$('.mname_error').text('Middle Name is required');
			return false;
		}else if(allLetter(mname) == false){
			$('.a_mname_error').addClass('has-error');
			$('.mname_error').text('Letters Only');
			return false;
		}
		if(sname == ''){
			$('.a_sname_error').addClass('has-error');
			$('.sname_error').text('Surname is required');
			return false;
		}else if(allLetter(sname) == false){
			$('.a_sname_error').addClass('has-error');
			$('.sname_error').text('Letters Only');
			return false;
		}
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
		if(nationality == ''){
			$('.a_nationality_error').addClass('has-error');
			$('.nationality_error').text('Nationality is required');
			return false;
		}else if(nationalityValidation(nationality) == false){
			$('.a_nationality_error').addClass('has-error');
			$('.nationality_error').text('Alphabetical Letters Only');
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
//end of admin validation
$('.i_fname,.i_mname,.i_sname,.i_phone_no,.i_email,.i_nationality,.i_uname,.i_pwd,.i_repwd').keyup(function(){
	$('.a_fname_error,.a_mname_error,.a_sname_error,.a_phone_no_error,.a_email_error,.a_nationality_error,.a_uname_error,.a_pwd_error,.a_repwd_error').removeClass('has-error');
	$('.fname_error,.mname_error,.sname_error,.phone_no_error,.email_error,.nationality_error,.uname_error,.pwd_error,.repwd_error').text('');
});

//for checking characters only in names.
function allLetter(parameter){    
	var letters = /^[A-Za-z]+$/.test(parameter);
	if(letters == true){  
		return true;  
	}else{    
		return false;  
	}  
}
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