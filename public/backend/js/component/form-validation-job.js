
  $('#jobTitle').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#jobTitle').css('border', '1px solid red');
      $('#err_title').text('Job Title is required field.');
    }else{
      $('#jobTitle').css('border', '1px solid #c7c7cc');
      $('#err_title').text('');
    }
  });

  $('#closeDate').on('blur', function(){
    var date_val = $(this).val();

    if(date_val == ''){
      $('#closeDate').css('border', '1px solid red');
      $('#err_close_date').text('Close Date is required field.');
    }else{
      $('#closeDate').css('border', '1px solid #c7c7cc');
      $('#err_close_date').text('');
    }
  });

  $('.btn-sample-des').on('click', function(){
    var html_des = getSampleDes();
    $('#jobDescription').val(html_des);
  });

  $('.btn-sample-req').on('click', function(){
    var html_req = getSampleReq();
    $('#jobRequirement').val(html_req);
  });

  $('.btn-sample-apply').on('click', function(){
    var close_date = $('#closeDate').val();

    if(close_date != ''){
      var dateFormat = close_date.split('-');
      var monthIndex = parseInt(dateFormat[1]) - 1;
      var mydate     = dateFormat[0] +' '+ convertMonth(monthIndex) +', '+ dateFormat[2];
      var html_apply = getSampleApply(mydate);
    }else{
      var html_apply = getSampleApply();
    }
    
    $('#jobApplyText').val(html_apply);
  });

  $('.btn-clear').on('click', function(){
    $(this).parent().parent().parent().find('.editor').val('');
  });

	function isValidate_form_job()
	{
		var status    = true;

		if($('#jobTitle').val() == ''){
		  $('#jobTitle').css('border', '1px solid red');
		  $('#err_title').text('Category Title is required field.');
		  status = false;
		} 

		if($('#jobCategory').val() == ''){
      $('#jobCategory').parent().find('.chosen-container-single').css('border', '1px solid red');
      $('#jobCategory').parent().find('.chosen-container-single').css('border-radius', '4px');
		  $('#err_category').text('Job Category is required field.');
		  status = false;
		}

    if($('#jobLocation').val() == ''){
      $('#jobLocation').parent().find('.chosen-container-single').css('border', '1px solid red');
      $('#jobLocation').parent().find('.chosen-container-single').css('border-radius', '4px');
      $('#err_location').text('Job Location is required field.');
      status = false;
    }

    if($('#closeDate').val() == ''){
      $('#closeDate').css('border', '1px solid red');
      $('#err_close_date').text('Close Date is required field.');
      status = false;
    }

    if($('#jobDescription').val() == ''){
      $('#jobDescription').css('border', '1px solid red');
      $('#err_des').text('Job Description is required field.');
      status = false;
    }

    if($('#jobRequirement').val() == ''){
      $('#jobRequirement').css('border', '1px solid red');
      $('#err_required').text('Job Requirement is required field.');
      status = false;
    }
		return status;
	}
  
  function getSampleDes()
  {
    var des_sample = '<div class="listdown-odi">';
        des_sample += '<ul>';
        des_sample += '<li>Serve clients in terms of marketing and advertising supports in order to build clients’ brands in the market successfully</li>';
        des_sample += '<li>Co-operate both internal and external parties to complete services</li>';
        des_sample += '<li>Follow up job progress and control time schedule</li>';
        des_sample += '<li>Present effective marketing and advertising support activities to clients</li>';
        des_sample += '<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>';
        des_sample += '<li>Report current situation/ performance quarterly to Client’s Top executives</li>';
        des_sample += '<li>Arrange meeting with clients outside/inside the office</li>';
        des_sample += '<li>Maintain good relationship with clients</li>';
        des_sample += '</ul>';
        des_sample += '</div>';

    return des_sample;
  }

  function getSampleReq()
  {
    var req_sample = '<div class="listdown-odi">';
        req_sample += '<ul>';
        req_sample += '<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>';
        req_sample += '<li>Advertising or other related fields</li>';
        req_sample += '<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>';
        req_sample += '<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>';
        req_sample += '<li>Good command of reading, writing and speaking English</li>';
        req_sample += '<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>';
        req_sample += '<li>Excellent communication skills</li>';
        req_sample += '<li>Energetic able to work under pressure</li>';
        req_sample += '<li>Pleasant personality and service mind</li>';
        req_sample += '<li>Strong communication and presentation skills</li>';
        req_sample += '<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>';
        req_sample += '</ul>';
        req_sample += '</div>';

    return req_sample;
  }

  function getSampleApply(closedate=null)
  {
    var apl_sample = 'Interested applicants meeting the above requirements should send their CV ';
        apl_sample += 'and cover letter to <strong style="color:#00ADEF;">recruitment@odi-asia.com </strong>';
        apl_sample += 'with the expected salary before <strong>'+ closedate +'</strong>. Please kindly state.';

    return apl_sample;
  }

function convertMonth(num_month)
{
  var monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];

  return monthNames[num_month];

}