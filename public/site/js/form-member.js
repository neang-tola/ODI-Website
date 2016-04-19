$('body').on('blur', '#fullName', function(){
	var fullname = $(this).val();
	if(fullname == ''){
		var error = 'Full Name is required field'; 
		$('#fullName').css('border', '1px solid red');
		$('#fullName').attr('title', error);
		$('#fullName').attr('data-original-title', error);
		$('#fullName').tooltip('show');
	}else{
		$('#fullName').removeAttr('style');
		$('#fullName').attr('title', '');
		$('#fullName').attr('data-original-title', '');
	}
});

$('body').on('blur', '#organization', function(){
	var organ = $(this).val();
	if(organ == ''){
		var error = 'Organization is required field'; 
		$('#organization').css('border', '1px solid red');
		$('#organization').attr('title', error);
		$('#organization').attr('data-original-title', error);
		$('#organization').tooltip('show');
	}else{
		$('#organization').removeAttr('style');
		$('#organization').attr('title', '');
		$('#organization').attr('data-original-title', '');
	}
});

$('body').on('blur', '#position', function(){
	var post = $(this).val();
	if(post == ''){
		var error = 'Position is required field'; 
		$('#position').css('border', '1px solid red');
		$('#position').attr('title', error);
		$('#position').attr('data-original-title', error);
		$('#position').tooltip('show');
	}else{
		$('#position').removeAttr('style');
		$('#position').attr('title', '');
		$('#position').attr('data-original-title', '');
	}
});

$('body').on('blur', '#email', function(){
	var email_add = $(this).val();
	if(email_add == ''){
		var error = 'Email is required field';
		$('#email').css('border', '1px solid red');
		$('#email').attr('title', error);
		$('#email').attr('data-original-title', error);
		$('#email').tooltip('show');
	}else{
		if(!isValidEmailAddress(email_add)){
			$('#email').css('border', '1px solid red');
			$('#email').attr('title', 'Email is not valid format');
			$('#email').attr('data-original-title', 'Email is not valid format');
			$('#email').tooltip('show');
		}else{
			$('#email').removeAttr('style');
			$('#email').attr('title', '');
			$('#email').attr('data-original-title', '');
		}
	}
});

$('body').on('blur', '#contactNumber', function(){
	var con_num = $(this).val();
	if(con_num == ''){
		var error = 'Contact Num. is required field'; 
		$('#contactNumber').css('border', '1px solid red');
		$('#contactNumber').attr('title', error);
		$('#contactNumber').attr('data-original-title', error);
		$('#contactNumber').tooltip('show');
	}else{
		$('#contactNumber').removeAttr('style');
		$('#contactNumber').attr('title', '');
		$('#contactNumber').attr('data-original-title', '');
	}
});

$('body').on('change', '#trainingTitle', function(){
	var title = $(this).val();
	if(title == ''){
		var error = 'Course Title is required field';
		$('#trainingTitle').parent().find('.chosen-container-single').css('border', '1px solid red');
		$('#err_title').attr('title', error);
		$('#err_title').attr('data-original-title', error);
		$('#err_title').tooltip('show');
	}else{
		$('#trainingTitle').parent().find('.chosen-container-single').css('border', '1px solid #9FD545');
		$('#err_title').attr('title', '');
		$('#err_title').attr('data-original-title', '').tooltip('hide');
	}
});

$('body').on('blur', '#numberPaticipant', function(){
	var paticipant = $(this).val();
	if(paticipant == ""){
		var error = 'Paticipant Num. is required field';
		$('#numberPaticipant').css('border', '1px solid red');
		$('#numberPaticipant').attr('title', error);
		$('#numberPaticipant').attr('data-original-title', error);
		$('#numberPaticipant').tooltip('show');	
	}else{
		$('#numberPaticipant').removeAttr('style');
		$('#numberPaticipant').attr('title', '');
		$('#numberPaticipant').attr('data-original-title', '');
	}
});

$('body').on('blur', '#phoneNumber', function(){
	var phone = $(this).val();
	if(phone == ''){
		var error = 'Phone Number is required field';
		$('#phoneNumber').css('border', '1px solid red');
		$('#phoneNumber').attr('title', error);
		$('#phoneNumber').attr('data-original-title', error);
		$('#phoneNumber').tooltip('show');
	}else{
		$('#phoneNumber').removeAttr('style');
		$('#phoneNumber').attr('title', '');
		$('#phoneNumber').attr('data-original-title', '');
	}
});

$('body').on('change', '#gender', function(){
	var gender = $(this).val();
	if(gender == ''){
		var error = 'Gender is required field';
		$('#gender').css('border', '1px solid red');
		$('#gender').attr('title', error);
		$('#gender').attr('data-original-title', error);
		$('#gender').tooltip('show');
	}else{
		$('#gender').removeAttr('style');
		$('#gender').attr('title', '');
		$('#gender').attr('data-original-title', '');
	}
});

$('body').on('blur', '#applyFor', function(){
	var apply = $(this).val();
	if(apply == ''){
		var error = 'Apply for is required field';
		$('#applyFor').css('border', '1px solid red');
		$('#applyFor').attr('title', error);
		$('#applyFor').attr('data-original-title', error);
		$('#applyFor').tooltip('show');
	}else{
		$('#applyFor').removeAttr('style');
		$('#applyFor').attr('title', '');
		$('#applyFor').attr('data-original-title', '');
	}
});

$('body').on('blur', '#salaryExpect', function(){
	var salary = $(this).val();
	if(salary == ''){
		var error = 'Salary expect is required field';
		$('#salaryExpect').css('border', '1px solid red');
		$('#salaryExpect').attr('title', error);
		$('#salaryExpect').attr('data-original-title', error);
		$('#salaryExpect').tooltip('show');
	}else{
		$('#salaryExpect').removeAttr('style');
		$('#salaryExpect').attr('title', '');
		$('#salaryExpect').attr('data-original-title', '');
	}
});

$('body').on('change', '#file', function(){
	var doc = $(this).val();
	if(doc == ''){
        $('.file-upload-input').css('border', '1px solid red');
		$('.custom-file-upload').attr('title', 'CV is required field');
		$('.custom-file-upload').attr('data-original-title', 'CV is required field');
		$('.custom-file-upload').tooltip('show');
	}else{
        var img_size = $("#file")[0].files[0].size;
        var extension= $("#file").val().split(".").pop();
        var msg = '';
        if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
        if(checkExtension(extension) == false){  msg = 'Allow only extension doc, docx, and pdf';   }
		
		if(msg == ''){
			$('.custom-file-upload').removeAttr('style');
			$('.custom-file-upload').attr('title', '');
			$('.custom-file-upload').attr('data-original-title', '');
		}else{
			$('.custom-file-upload').attr('title', msg);
			$('.custom-file-upload').attr('data-original-title', msg);
			$('.custom-file-upload').tooltip('show');
		}
	}
});

function valid_submitcv_form()
{
    if($('#fullName').val() == ""){ 
		var error = 'Full Name is required field'; 
		$('#fullName').css('border', '1px solid red');
		$('#fullName').attr('title', error).tooltip('show');
		return false;
    }
	
	if($('#position').val() == ""){
		var error = 'Position is required field';
		$('#position').css('border', '1px solid red');
		$('#position').attr('title', error).tooltip('show');
		return false;
	}

	if($('#email').val() == ""){
		var error = 'Email is required field';
		$('#email').css('border', '1px solid red');
		$('#email').attr('title', error).tooltip('show');
		return false;
	}else{
		if(!isValidEmailAddress(email_add)){
			$('#email').css('border', '1px solid red');
			$('#email').attr('title', 'Email is not valid format');
			$('#email').tooltip('show');
			return false;
		}
	}
	
	if($('#phoneNumber').val() == ""){
		var error = 'Phone Number is required field';
		$('#phoneNumber').css('border', '1px solid red');
		$('#phoneNumber').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#gender').val() == ""){
		alert($('#gender').val());
		var error = 'Gender is required field';
		$('#gender').css('border', '1px solid red');
		$('#gender').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#applyFor').val() == ""){
		var error = 'Apply for is required field';
		$('#applyFor').css('border', '1px solid red');
		$('#applyFor').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#salaryExpect').val() == ""){
		var error = 'Salary Expect is required field';
		$('#salaryExpect').css('border', '1px solid red');
		$('#salaryExpect').attr('title', error).tooltip('show');
		return false;
	}

	if($('#file').val() == ''){
        $('.file-upload-input').css('border', '1px solid red');
		$('.custom-file-upload').attr('title', 'CV is required field');
		$('.custom-file-upload').attr('data-original-title', 'CV is required field');
		$('.custom-file-upload').tooltip('show');
		return false;
	}else{
        var img_size = $("#file")[0].files[0].size;
        var extension= $("#file").val().split(".").pop();
        var msg = '';
        if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
        if(checkExtension(extension) == false){  msg = 'Allow only extension doc, docx, and pdf';   }
		
		if(msg != ''){
			$('.custom-file-upload').attr('title', msg);
			$('.custom-file-upload').attr('data-original-title', msg);
			$('.custom-file-upload').tooltip('show');
			return false;
		}
	}
	
	return true;
}

function valid_register_form()
{
	
	if($('#trainingTitle').val() == ''){
		var error = 'Course Title is required field';
		$('#trainingTitle').parent().find('.chosen-container-single').css('border', '1px solid red');
		$('#err_title').attr('title', error).tooltip('show');
		return false;
	}
	
    if($('#fullName').val() == ""){ 
		var error = 'Full Name is required field'; 
		$('#fullName').css('border', '1px solid red');
		$('#fullName').attr('title', error).tooltip('show');
		return false;
    }
	
	if($('#organization').val() == ""){
		var error = 'Organization is required field';
		$('#organization').css('border', '1px solid red');
		$('#organization').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#position').val() == ""){
		var error = 'Position is required field';
		$('#position').css('border', '1px solid red');
		$('#position').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#email').val() == ""){
		var error = 'Email is required field';
		$('#email').css('border', '1px solid red');
		$('#email').attr('title', error).tooltip('show');
		return false;
	}else{
		if(!isValidEmailAddress(email_add)){
			$('#email').css('border', '1px solid red');
			$('#email').attr('title', 'Email is not valid format');
			$('#email').tooltip('show');
			return false;
		}
	}
	
	if($('#contactNumber').val() == ""){
		var error = 'Contact Number is required field';
		$('#contactNumber').css('border', '1px solid red');
		$('#contactNumber').attr('title', error).tooltip('show');
		return false;
	}
	
	if($('#numberPaticipant').val() == ""){
		var error = 'Paticipant Num. is required field';
		$('#numberPaticipant').css('border', '1px solid red');
		$('#numberPaticipant').attr('title', error).tooltip('show');
		return false;
	}

	return true;
}

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
	
	function checkExtension(extension)
	{
		if(extension == "doc" || extension == "docx" || extension == "pdf")
		{
			return true;
		}else{
			return false;
		}
	}	