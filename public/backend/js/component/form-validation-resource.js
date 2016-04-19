
    $('#resourceDoc').on('change', function(){
    	$('#uploadFile').val($(this).val());

        if($(this).val() != ''){
        	var img_size = $("#resourceDoc")[0].files[0].size;
        	var extension= $("#resourceDoc").val().split(".").pop();
        	var msg = '';
        	if(img_size > 10485760){	msg = 'Maximum image upload size 10MB.';	}
        	if(checkExtension(extension) == false){  msg = 'Docuementation allow only extension DOC, DOCX, XLS, XLSX, PPT, PPTX, PPTM and PDF, with maximum file size 10MB.'; 	}

        	if(msg != ''){
                $('#resourceDoc').val('');
        		$('#uploadFile').val('');
                $('#modal-message .modal-body p').text(msg);
        		$('#modal-message').modal('show');
        	}
        }
    });

  $('#resourceTitle').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#resourceTitle').css('border', '1px solid red');
      $('#err_title').text('Resource Title is required field.');
    }else{
      $('#resourceTitle').css('border', '1px solid #c7c7cc');
      $('#err_title').text('');
    }
  });

  $('body').on('click', '.preview-resource', function(){
    var preview_doc = $(this).attr('id');
    var base_url  = window.location.protocol + "//" + window.location.host;
    var frame_url   = 'http://docs.google.com/gview?url='+ base_url +'/public/files/'+ preview_doc +'&embedded=true';

    $('#previewModal').attr('src', frame_url);
    $('#view-document').modal('show');
  });
  
	function isValidate_form_resource()
	{
		var status    = true;

		if($('#resourceTitle').val() == ''){
		  $('#resourceTitle').css('border', '1px solid red');
		  $('#err_title').text('Resource Title is required field.');
		  status = false;
		} 

		if($('#resourceDoc').val() == ''){
      $('#uploadFile').css('border', '1px solid red');
		  $('#err_doc').text('Docuementation is required field.');
		  status = false;
		}

    if($('#resourceType').val() == ''){
          $('#resourceType').parent().find('.chosen-container-single').css('border', '1px solid red');
          $('#resourceType').parent().find('.chosen-container-single').css('border-radius', '4px');
          $('#err_type').text('Resource type is the field required.');
          status = false;
        }

		return status;
	}

  function isValidate_update_resource()
  {
    var status    = true;

    if($('#resourceTitle').val() == ''){
      $('#resourceTitle').css('border', '1px solid red');
      $('#err_title').text('Resource Title is required field.');
      status = false;
    } 

    return status;
  }

  function checkExtension(extension)
  {
    	if(extension == "doc" || extension == "docx" || extension == "xls" || extension == "xlsx" || extension == "ppt" || extension == "ppt" || extension == "pptm" || extension == "pdf")
    	{
    		return true;
    	}else{
    		return false;
    	}
  }