
  $('#alertFromCandidate').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#alertFromCandidate').css('border', '1px solid red');
      $('#err_candidate').text('Receive email of Candidate is required field.');
    }else{
      $('#alertFromCandidate').css('border', '1px solid #c7c7cc');
      $('#err_candidate').text('');
    }
  });

  $('#alertFromTrainer').on('blur', function(){
    var email_val = $(this).val();

    if(email_val == ''){
      $('#alertFromTrainer').css('border', '1px solid red');
      $('#err_trainer').text('Receive email of Candidate is required field.');
    }else{
      $('#alertFromTrainer').css('border', '1px solid #c7c7cc');
      $('#err_trainer').text('');
    }
  });

  function isValidate_email()
  {
    if($('#alertFromCandidate').val() == ''){
      $('#alertFromCandidate').css('border', '1px solid red');
      $('#err_candidate').text('Receive email of Candidate is required field.');
      return false;
    }

    if($('#alertFromTrainer').val() == ''){
      $('#alertFromTrainer').css('border', '1px solid red');
      $('#err_trainer').text('Receive email of Candidate is required field.');
      return false;
    }

    return true;
  }