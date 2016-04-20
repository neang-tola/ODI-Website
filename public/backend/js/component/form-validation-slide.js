
  $('#slideTitle').on('blur', function(){
    var title_val = $(this).val();

    if(title_val == ''){
      $('#slideTitle').css('border', '1px solid red');
      $('#err_title').text('Slideshow Title is required field.');
    }else{
      $('#trainingTitle').css('border', '1px solid #c7c7cc');
      $('#err_title').text('');
    }
  });

  $('#slideImage').on('change', function(){
      $('#showImage').val($(this).val());
        if($(this).val() != ''){
          var img_size = $("#slideImage")[0].files[0].size;
          var extension= $("#slideImage").val().split(".").pop();
          var msg = '';
          if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
          if(checkExtension(extension) == false){  msg = 'Allow only extension JPEG, JPG, GIF and PNG only.';   }

          if(msg != ''){
              $('#slideImage').val('');
              $('#showBanner').val('');
              $('#modal-message .modal-body p').text(msg);
              $('#modal-message').modal('show');
          }
        }
  });

  $('#leftImageCaption').on('change', function(){
      $('#captionImageLeft').val($(this).val());
        if($(this).val() != ''){
          $('#captionImageLeft').css('border', '1px solid #c7c7cc');
          $('#err_limage').text('');
          var img_size = $("#leftImageCaption")[0].files[0].size;
          var extension= $("#leftImageCaption").val().split(".").pop();
          var msg = '';
          if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
          if(checkExtension(extension) == false){  msg = 'Allow only extension JPEG, JPG, GIF and PNG only.';   }

          if(msg != ''){
              $('#leftImageCaption').val('');
              $('#captionImageLeft').val('');
              $('#modal-message .modal-body p').text(msg);
              $('#modal-message').modal('show');
          }
      }
  }); 

  $('#rightImageCaption').on('change', function(){
      $('#captionImageRight').val($(this).val());
        if($(this).val() != ''){
          $('#captionImageRight').css('border', '1px solid #c7c7cc');
          $('#err_rimage').text('');
          var img_size = $("#rightImageCaption")[0].files[0].size;
          var extension= $("#rightImageCaption").val().split(".").pop();
          var msg = '';
          if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
          if(checkExtension(extension) == false){  msg = 'Allow only extension JPEG, JPG, GIF and PNG only.';   }

          if(msg != ''){
              $('#rightImageCaption').val('');
              $('#captionImageRight').val('');
              $('#modal-message .modal-body p').text(msg);
              $('#modal-message').modal('show');
          }
      }
  }); 

  $('#leftCaption').on('change', function(){
    var left_val = $(this).val();
    if(left_val == 1){
      $('#leftText').hide();
      $('#captionImageLeft').css('border', '1px solid #c7c7cc');
      $('#err_limage').text('');
      $('#leftImage').show();
    }else if(left_val == 2){
      $('#leftImage').hide();
      $('#leftText').show();
    }else{
      $('#leftImage').hide();
      $('#leftText').hide();
      $('#err_lcaption').text('');
      $('#err_limage').text('');
    }
  });


  $('#rightCaption').on('change', function(){
    var left_val = $(this).val();
    if(left_val == 1){
      $('#rightText').hide();
      $('#err_rimage').text('');
      $('#captionImageRight').css('border', '1px solid #c7c7cc');
      $('#rightImage').show();
    }else if(left_val == 2){
      $('#rightImage').hide();
      $('#rightText').show();
    }else{
      $('#rightImage').hide();
      $('#rightText').hide();
      $('#err_rcaption').text('');
      $('#err_rimage').text('');
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

    if($('#slideId').val() == ''){
      if($('#leftCaption').val() == 1){
          if($('#leftImageCaption').val() == ''){
            $('#captionImageLeft').css('border', '1px solid red');
            $('#err_limage').text('Image for left block is required');
            status = false;
          }
      }

      if($('#leftCaption').val() == 2){
          if($('#leftTextCaption').val() == ''){
            $('#err_lcaption').text('Text for left block is required');
            status = false;
          }
      }

      if($('#rightCaption').val() == 1){
          if($('#rightImageCaption').val() == ''){
            $('#captionImageRight').css('border', '1px solid red');
            $('#err_rimage').text('Image for right block is required');
            status = false;
          }
      }

      if($('#rightCaption').val() == 2){
          if($('#rightTextCaption').val() == ''){
            $('#err_rcaption').text('Text for right block is required');
            status = false;
          }
      }
    }
    return status;
  }

  function captionText(fieldName)
  {
    var captionTxt  = '<div class="col-lg-12 col-md-12 col-sm-12">';
        captionTxt += '<textarea class="form-control my-editor" name="'+ fieldName +'" id=""><h1>hello</h1></textarea>';
        captionTxt += '</div>';

        return captionTxt;
  }

  function captionImage(fieldName)
  {
    var captionImg  = '<div class="btn-file-image col-lg-6 col-md-4 col-sm-4">';
        captionImg += '<span class="btn btn-default col-lg-2 col-md-4 col-sm-4">';
        captionImg += 'Browse <input type="file" class="upload" name="" id="" />';
        captionImg += '</span>';
        captionImg += '<span class="col-lg-10 col-md-8 col-sm-8 padding-none">';
        captionImg += '<input id="captionImageleft" class="form-control" placeholder="Choose a image side 400px X 300px" disabled="disabled" />';
        captionImg += '</span>';
        captionImg += '</div>';

        return captionImg;
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
