
  $('#slideTitle').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#slideTitle').css('border', '1px solid red');
      $('#err_title').text('Slideshow Title is required field.');
    }else{
      $('#slideTitle').css('border', '1px solid #c7c7cc');
      $('#err_title').text('');
    }
  });

  $('#slideImage').on('change', function(){
      $('#showImage').val($(this).val());
        if($(this).val() != ''){
          $('#showImage').css('border', '1px solid #c7c7cc');
          $('#err_image').text('');
          var img_size = $("#slideImage")[0].files[0].size;
          var extension= $("#slideImage").val().split(".").pop();
          var msg = '';
          if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
          if(checkExtension(extension) == false){  msg = 'Allow only extension JPEG, JPG, GIF and PNG only.';   }

          if(msg != ''){
              $('#slideImage').val('');
              $('#showImage').val('');
              $('#modal-message .modal-body p').text(msg);
              $('#modal-message').modal('show');
          }
      }
  });

  $('#slidePosition').on('change', function(){
    var post_val = $(this).val();
    if(post_val != ''){
      $('#slidePosition').css('border', '1px solid #c7c7cc');
      $('#err_position').text('');
    }
  });

  function isValidate_slideshow()
  {
    var status    = true;

    if($('#slideTitle').val() == ''){
      $('#slideTitle').css('border', '1px solid red');
      $('#err_title').text('Slideshow Title is required field.');
      status = false;
    } 

    if($('#slideImage').val() == ''){
      $('#showImage').css('border', '1px solid red');
      $('#err_image').text('Image Slideshow is required field.');
      status = false;
    }

    if($('#slideCaption').val() != ''){
      if($('#slidePosition').val() == ''){
        $('#slidePosition').css('border', '1px solid red');
        $('#err_position').text('Please choose position for slideshow caption.');
        status = false;
      }
    }

    return status;
  }

  function isValidate_update_slideshow()
  {
    var status    = true;

    if($('#slideTitle').val() == ''){
      $('#slideTitle').css('border', '1px solid red');
      $('#err_title').text('Slideshow Title is required field.');
      status = false;
    } 

    if($('#slideCaption').val() != ''){
      if($('#slidePosition').val() == ''){
        $('#slidePosition').css('border', '1px solid red');
        $('#err_position').text('Please choose position for slideshow caption.');
        status = false;
      }
    }

    return status;
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
