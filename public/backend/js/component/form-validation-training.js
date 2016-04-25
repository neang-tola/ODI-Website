
  $('#trainingTitle').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#trainingTitle').css('border', '1px solid red');
      $('#err_title').text('Training course title is required field.');
    }else{
      $('#trainingTitle').css('border', '1px solid #c7c7cc');
      $('#err_title').text('');
    }
  });
  
  $('#trainingPrice').on('blur', function(){
    var price = $(this).val();

    if(price == ''){
      $('#trainingPrice').css('border', '1px solid red');
      $('#err_price').text('Fee of course is required field.');
    }else{
      if($.isNumeric(price) == false){
        $('#trainingPrice').css('border', '1px solid red');
        $('#err_price').text('Fee of course allow only number input.');
      }else{
        $('#trainingPrice').css('border', '1px solid #c7c7cc');
        $('#err_price').text('');
      }
    }
  });

  $('#trainingBanner').on('change', function(){
      $('#showBanner').val($(this).val());
        if($(this).val() != ''){
          var img_size = $("#trainingBanner")[0].files[0].size;
          var extension= $("#trainingBanner").val().split(".").pop();
          var msg = '';
          if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
          if(checkExtension(extension) == false){  msg = 'Allow only extension JPEG, JPG, GIF and PNG only.';   }

          if(msg != ''){
                $('#trainingBanner').val('');
            $('#showBanner').val('');
                $('#modal-message .modal-body p').text(msg);
            $('#modal-message').modal('show');
          }
        }
  });

  $('#trainingFrom').on('change', function(){
      var from_val = $(this).val();
      if(from_val != ''){
        $('#trainingDuration').val('1 day');
      }
  });

  $('#trainingTo').on('change', function(){
      var to_val = $(this).val();
      if(to_val != ''){
        if(isDate(to_val) == false){
          $('#trainingTo').css('border', '1px solid red');
          $('#err_to').text('Format of Date To (dd-mm-yyyy).');
        }else{
          var duration = calculateDay($('#trainingFrom').val(), $('#trainingTo').val());
    
          $('#trainingFrom').css('border', '1px solid #c7c7cc');
          $('#trainingDuration').val(duration);
          $('#err_to').text('');
        }
      }
  });

  $('.btn-sample').on('click', function(){
    var sample_html = getWholeSample();
    $('#trainingDescription').val(sample_html);
  });

  $('.btn-clear').on('click', function(){
    $('#trainingDescription').val('');
  });

	function isValidate_form_training()
	{
		var status    = true;

		if($('#trainingTitle').val() == ''){
		  $('#trainingTitle').css('border', '1px solid red');
		  $('#err_title').text('Training Title is required field.');
		  status = false;
		} 

		if($('#trainingFrom').val() == ''){
      $('#trainingFrom').css('border', '1px solid red');
		  $('#err_from').text('Start From is required field.');
		  status = false;
		}else{
      if(isDate($('#trainingFrom').val()) == false){
        $('#trainingFrom').css('border', '1px solid red');
        $('#err_from').text('Format of Date From (dd-mm-yyyy).');
        status = false;
      }
    }

    if($('#trainingTo').val() != ''){
      if(isDate($('#trainingTo').val()) == false){
        $('#trainingTo').css('border', '1px solid red');
        $('#err_from').text('Format of Date To (dd-mm-yyyy).');
        status = false;
      }
    }

    if($('#trainingType').val() == ''){
        $('#trainingType').parent().find('.chosen-container-single').css('border', '1px solid red');
        $('#trainingType').parent().find('.chosen-container-single').css('border-radius', '4px');
        $('#err_type').text('Training type is the field required.');
        status = false;
    }

    if($('#trainingPrice').val() == ''){
      $('#trainingPrice').css('border', '1px solid red');
      $('#err_price').text('Fee of course is required field.');
      status = false;
    }else{
      if($.isNumeric($('#trainingPrice').val()) == false){
        $('#trainingPrice').css('border', '1px solid red');
        $('#err_price').text('Fee of course allow only Number input.');
        status = false;
      }
    }

    if($('#trainingDescription').val() == ''){
      $('#err_des').text('Description of course is requred field.');
      status = false;
    }

    if($('#trainingDuration').val() == ''){
      $('#trainingDuration').css('border', '1px solid red');
      $('#err_duration').text('Duration is required field.')
      status = false;
    }

		return status;
    
	}

  $('body').on('change', '.trainingCustomize', function(){
      var custom_val = $(this).val();

      if(custom_val == 0){
        $('.optional').fadeIn('fast');
        $('#form_training').attr('onsubmit', 'return isValidate_form_training()');
      }else{
        $('.optional').fadeOut('fast');
        $('#form_training').attr('onsubmit', 'return isValidate_training()');
      }
  });

  function isValidate_training()
  {
    var status    = true;

    if($('#trainingTitle').val() == ''){
      $('#trainingTitle').css('border', '1px solid red');
      $('#err_title').text('Training Title is required field.');
      status = false;
    } 

    if($('#trainingDescription').val() == ''){
      $('#err_des').text('Description of course is requred field.');
      status = false;
    }

    return status;
  }

  function isDate(txtDate)
  {
        var currVal = txtDate;
        if(currVal == ''){   return false; }
        
        var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
        var dtArray = currVal.match(rxDatePattern); // is format OK?

        if (dtArray == null){   return false;  }

        //Checks for dd/mm/yyyy format.
        dtMonth = dtArray[3];
        dtDay   = dtArray[1];
        dtYear  = dtArray[5];        

        if (dtMonth < 1 || dtMonth > 12){
            return false;
        }
        if (dtDay < 1 || dtDay> 31){
            return false;
        }
        if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31){
            return false;
        }
        if (dtMonth == 2){
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay> 29 || (dtDay ==29 && !isleap)){   return false;   }
        }

        return true;
  }

  function checkExtension(extension)
  {
      if(extension == "jpg" || extension == "jpeg" || extension == "gif" || extension == "png" || extension == "JPG" || extension == "JPEG" || extension == "GIF" || extension == "PNG")
      {
        return true;
      }else{
        return false;
      }
  }

  function calculateDay(day_first, day_second)
  {
     if(day_first != ''){
        var day_one = day_first.split('-')[0];
        var day_two = day_second.split('-')[0];
        var result  = parseInt(day_two) - parseInt(day_one);

        if(result <= 1){
          return '1 day';
        }else{
          return result + ' days';
        }
     }
  }

  function getWholeSample()
  {
    var my_sample = '<div style="width:50%;float:left;display:block;">';
        my_sample += '<h3 style="color:#00ADEF;font-size:24px;font-wight:bold;">Course Overview</h3>';
        my_sample += '<p>This training course will strengthen your knowledge and practices in the Cambodian Labour Law and working';
        my_sample += 'conditions in HR/employee management. Understand how the Cambodian Labour Law works in relation to ';
        my_sample += 'your company or organization to ensure you meet the minimum requirements.</p>';
  
        my_sample += '<h3 style="color:#00ADEF;font-size:24px;font-wight:bold;">Course Objectives</h3>';
        my_sample += '<ul style="list-style:none;padding-left:0;margin-left:0;">';
        my_sample += '<li>Be fully competent in practices of Labour Law and Working Conditions in HR/Employee Management</li>';
        my_sample += '<li>Design an internal Labour Law Auditing Tool, and conduct internal audit on your internal mechanisms</li>';
        my_sample += '<li>Implement the Cambodian Labour Law to ensure your company meets the minimum requirements</li>';
        my_sample += '<li>Improve employee management to solve issues using the Labour Law</li>';
        my_sample += '<li>Get answers to your questions in a pro-active environment</li>';
        my_sample += '</ul>';
  
        my_sample += '<h3 style="color:#00ADEF;font-size:24px;font-wight:bold;">Who should attend?</h3>';
        my_sample += '<p>Business owners, business managers, directors, finance and accounting professional and ';
        my_sample += 'those whose works deal with taxation</p>';
  
        my_sample += '<h3 style="color:#00ADEF;font-size:24px;font-wight:bold;">Sepcial Features</h3>';
        my_sample += '<p>ODI Asia training approach is highly practical, participatory and often fun! ';
        my_sample += 'We focus on real issues and help participants to use the tools covered. ';
        my_sample += 'We train in small groups to meet the needs of individual participants and use a ';
        my_sample += 'variety of learning methods to stimulate interest and meet different learning styles.';
        my_sample += 'Courses are supported by extensive materials for participants to take away and apply ';
        my_sample += 'after the course, including a detailed course manual.  We also offer a free follow-up ';
        my_sample += 'service by email or phone to all trainees.</p>';
        my_sample += '</div>';

        my_sample += '<div style="width:48%;float:right;display:block;">';
        my_sample += '<h3 style="color:#00ADEF;font-size:24px;font-wight:bold;">Course Content</h3>';
        my_sample += '<ul style="list-style:none;padding-left:0;margin-left:0;">';
        my_sample += '<li style="padding-left:0;margin-left:0;width:18%;display:inline-block;margin-right:5px;vertical-align:top;">Module 1:</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:80%;display:inline-block;vertical-align:top;">';
        my_sample += '<ul style="padding-left:0;margin-left:0;list-style:none;">';
        my_sample += '<li>Introduction to Labour Law</li>';
        my_sample += '<li>Scope of Application Employers and Employee</li>';
        my_sample += '<li>Connection between Labour Law, Work Condition, and  Human Resource Management</li>';
        my_sample += '<li>Staff recruitment</li>';
        my_sample += '<li>Application for Enterprise Establishment</li>';
        my_sample += '</ul>';
        my_sample += '</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:18%;display:inline-block;margin-right:5px;vertical-align:top;">Module 2:</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:80%;display:inline-block;vertical-align:top;">';
        my_sample += '<ul style="padding-left:0;margin-left:0;list-style:none;">';
        my_sample += '<li>Labour Contract and Labour Contract Termination</li>';
        my_sample += '<li>Written Labour Contract</li>';
        my_sample += '<li>Verbal Labour Contract</li>';
        my_sample += '<li>Other types of Labour Contract</li>';
        my_sample += '<li>Labour Contract Termination</li>';
        my_sample += '</ul>';
        my_sample += '</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:18%;display:inline-block;margin-right:5px;vertical-align:top;">Module 3:</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:80%;display:inline-block;vertical-align:top">';
        my_sample += 'Rights and Working Conditions';
        my_sample += '<ol>';
        my_sample += '<li>Salaries and Wages</li>';
        my_sample += '<li>Working Hour </li>';
        my_sample += '<li>OverTime</li>';
        my_sample += '<li>Paid Holiday</li>';
        my_sample += '<li>Annual Leave</li>';
        my_sample += '<li>Special Leave</li>';
        my_sample += '<li>Sick Leave</li>';
        my_sample += '<li>Women Labor</li>';
        my_sample += '<li>Work related accident </li>';
        my_sample += '</ol>';
        my_sample += '</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:18%;display:inline-block;margin-right:5px;vertical-align:top;">Module 4:</li>';
        my_sample += '<li style="padding-left:0;margin-left:0;width:80%;display:inline-block;vertical-align:top">';
        my_sample += '<ul style="padding-left:0;margin-left:0;list-style:none;">';
        my_sample += '<li>Conflict Resolution Labour Conflict</li>';
        my_sample += '<li>Types of Labour Conflict </li>';
        my_sample += '<li>Definition of Labour Conflict </li>';
        my_sample += '<li>Process of Labour Conflict Resolution </li>';
        my_sample += '</ul>';
        my_sample += '</li>';
        my_sample += '</ul>';
  
        my_sample += '<h3 style="color:#00ADEF;font-size:16px;font-wight:bold;">Trainer</h3>';
        my_sample += '<p>Our trainer is an expert in Cambodia Labour Law, having worked for ';
        my_sample += 'Ministry of Labour for more than ten years. He has conducted may training ';
        my_sample += 'related to labour law to thousand workers and employees as well as employers. ';
        my_sample += 'He is an expert with in-depth understanding of Cambodia Labour Law and ';
        my_sample += 'practices at different companies and organizations.</p>';
        my_sample += '</div>';

    return my_sample;
  }