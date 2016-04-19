
  $('#userName').on('blur', function(){
    if($(this).val() == ''){
      $('#userName').css('border', '1px solid red');
      $('#err_name').text('User Name is required field.');
    }else{
      $('#userName').css('border', '1px solid #c7c7cc');
      $('#err_name').text('');
    }
  });

  $('#userEmail').on('blur',  function() {
      if($(this).val() == ""){
          $('#userEmail').css('border', '1px solid red');
          $('#err_email').text('Email is required field.');
      }else{
          if( !isValidEmailAddress( $('#userEmail').val() ) ){
              $('#userEmail').css('border', '1px solid red');
              $('#err_email').text('Your Email is incorrect format.');
          }else{
              $('#userEmail').css('border', '1px solid #c7c7cc');
              $('#err_email').text('');
          }
      }
  });

  $('#userRole').on('change', function() {
    if($(this).val() == ''){
      $('#userRole').css('border', '1px solid red');
      $('#err_role').text('Role is required field.');
    }else{
      $('#userRole').css('border', '1px solid #c7c7cc');
      $('#err_role').text('');
    }
  });

  $('#userPassword').on('blur',  function() {
      if($(this).val() == ''){
          $('#userPassword').css('border', '1px solid red');
          $('#err_new').text('Password is required field.');
      }else{
          if($(this).val().length < 6){
            $('#userPassword').css('border', '1px solid red');
            $('#err_password').text('Minimum charachtors length 6 for your new password.');
          }else{
            $('#userPassword').css('border', '1px solid #c7c7cc');
            $('#err_password').text('');
          }
      }
  });

  $('#resetPassword').on('blur', function() {
      if($(this).val() != ''){
          if($(this).val().length < 6){
            $('#resetPassword').css('border', '1px solid red');
            $('#err_password').text('Minimum charachtors length 6 for your new password.');
          }else{
            $('#resetPassword').css('border', '1px solid #c7c7cc');
            $('#err_password').text('');
          }
      }else{
            $('#resetPassword').css('border', '1px solid #c7c7cc');
            $('#err_password').text('');
      }
  });

  $('#userConfirmPassword').on('blur',  function() {
      if($(this).val() == ''){
          $('#userConfirmPassword').css('border', '1px solid red');
          $('#err_confirm').text('Confirm Password is required field.');
      }else{
          if($('#userPassword').val() != $('#userConfirmPassword').val()){
              $('#userConfirmPassword').css('border', '1px solid red');
              $('#err_confirm').text('Confirm Password is not match.');
          }else{
              $('#userConfirmPassword').css('border', '1px solid #c7c7cc');
              $('#err_confirm').text('');
          } 
      }
  });

  function isValidate_form_user()
  {
    var status    = true;

    if($('#userName').val() == ''){
      $('#userName').css('border', '1px solid red');
      $('#err_name').text('User Name is required field.');
      status = false;
    }

    if($('#userPassword').val() == ''){
      $('#userPassword').css('border', '1px solid red');
      $('#err_password').text('Password is required field.');
      status = false;
    }else{
        if($(this).val().length < 6){
            $('#userPassword').css('border', '1px solid red');
            $('#err_password').text('Minimum charachtors length 6 for your new password.');
            status = false;
        }
    }

    if($('#userConfirmPassword').val() == ''){
        $('#userConfirmPassword').css('border', '1px solid red');
        $('#err_confirm').text('Confirm Password is required field.');
          status = false;
    }else{
        if($('#userPassword').val() != $('#userConfirmPassword').val()){
          $('#userConfirmPassword').css('border', '1px solid red');
          $('#err_confirm').text('Confirm Password is not match.');
          status = false;
        }
    }

    if($('#userEmail').val() == ''){
        $('#userEmail').css('border', '1px solid red');
        $('#err_email').text('Email is required field.');
        status = false;
    }

    if($('#userRole').val() == ''){
        $('#userRole').css('border', '1px solid red');
        $('#err_role').text('Role is required field.');
        status = false;
    }

    return status;
  }

  function isValidate_update_user()
  {
    var status    = true;

    if($('#userName').val() == ''){
      $('#userName').css('border', '1px solid red');
      $('#err_name').text('User Name is required field.');
      status = false;
    }

    if($('#userEmail').val() == ''){
        $('#userEmail').css('border', '1px solid red');
        $('#err_email').text('Email is required field.');
        status = false;
    }

    if($('#resetPassword').val() != ''){
        if($('#resetPassword').val() != $('#confirmPassword').val()){
          $('#confirmPassword').css('border', '1px solid red');
          $('#err_conpassword').text('Confirm Password is not match to reset password');
          status = false;
        }
    }

    return status;
  }

  function isValidEmailAddress(emailAddress) {
      var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      return pattern.test(emailAddress);
  };