	
    $('body').on('click', '.edit-button', function(){
    	var current_plc = $(this).parent().parent();
    	$('.cancel-button').attr('class', 'edit-button');
    	$(this).attr('class', 'cancel-button');
    	// Reset controls
    	$('#control-title').remove();
    	$('.training-title').show();
    	// Hide label of title
    	current_plc.find('.training-title').hide();
    	var control = getControl(current_plc.find('.training-title').text());
    	current_plc.find('.training-title').after(control);
    	
    });

    $('body').on('click', '.cancel-button', function(){
    	$('#control-title').remove();
    	$('.training-title').show();

    	$(this).attr('class', 'edit-button');
    });

    $('body').on('click', '#new-button', function(){
    	$('#control-title').remove();
    	$('.training-title').show();

    	$(this).attr('class', 'btn btn-default');
    	$(this).attr('id', 'new-button-cancel').text('Cancel');
    	$('#result_output tbody tr:first').before(resourceRow());
    });

    $('body').on('click', '#new-button-cancel', function(){
    	$('#result_output tbody tr:first').remove();
    	$(this).attr('class', 'btn btn-primary');
    	$(this).attr('id', 'new-button').text('New Training Type');
    });

    $('body').on('keypress', '#control-title', function (event) {
    	var row_val = $(this).parent().parent().find('.del-button').attr('id');
    	
    	if(event.which === 13){
    		var title = $(this).val();
    		if(title != ''){
    			if(typeof row_val !== "undefined"){
    				var trc_id = row_val.split('-')[1];
    			}else{
    				var trc_id = 'none';
			    	$('#new-button-cancel').attr('class', 'btn btn-primary');
			    	$('#new-button-cancel').attr('id', 'new-button').text('New Training Type');
    			}

				$('#result_output tbody').css('opacity', '0.6');
				$('.table-responsive .loading').fadeIn('fast');
         		
         		$.get('/internal-bkn/insert-training-type?int_title='+ title +'&tid='+ trc_id, function(result){
         			if(result != ''){
         				$('#result_output tbody').html(result);
         			}
					$('.table-responsive .loading').fadeOut('fast');
					$('#result_output tbody').css('opacity', '1');         			
         		});

    		}else{
	    		$('#confirm-msg-delete .modal-title').text('Error user input');
	    		$('#confirm-msg-delete .modal-body p').text('Training Type Title is required field, cannot empty.');
	    		$('#confirm-msg-delete .modal-footer').find('#confirm-ok').hide();
	    		$('#confirm-msg-delete .modal-footer').find('.btn-default').text('Ok');
	    		$('#confirm-msg-delete').modal('show');
    		}
    	}
    });

	$('body').on('click', '.del-button', function(){
		$(this).parent().parent().attr('id', 'active-row-delete');
		var del_id = $(this).attr('id').split('-')[1];
		var del_title = $(this).parent().parent().find('.training-title').text();
		$('#confirm-msg-delete .modal-body p').attr('id', 'did-'+ del_id);
		$('#confirm-msg-delete .modal-body p').find('span').text(del_title);
		$('#confirm-msg-delete').modal('show');
	});
	
	$('body').on('hidden.bs.modal', '#confirm-msg-delete', function(){
		$('#active-row-delete').removeAttr('id');
	});
	
	$('body').on('click', '#confirm-ok', function(){
		var did = $('#confirm-msg-delete .modal-body p').attr('id').split('-')[1];
		
		$.get('/internal-bkn/delete-training-type?did='+ did, function(deleted){
			if(deleted == 'success'){
				$('#active-row-delete').remove();
			}
			$('#confirm-msg-delete').modal('hide');
		});
	});

	$('body').on('click', 'ul.pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();
		var pagin_ul   = '';
		var pagin_li   = '';
		var total_li   = $('ul.pagination li').length - 2;
		var first_li   = '<li><a href="/internal-bkn/loading-training-type-list?page=1">«</a></li>';
		var last_li    = '<li><a href="/internal-bkn/loading-training-type-list?page='+ total_li +'" rel="next">»</a></li>';

		var page 	   = $(this).attr('href').split('page=')[1];

		$('#result_output tbody').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		if(active_val == '«'){
			first_li  =  '<li class="active"><span>«</span></li>';
		}
		if(active_val == '»'){
			last_li   =  '<li class="active"><span>»</span></li>';
		}
			
		if(total_li > 0){
			for(var k=1; k<=total_li; k++){
				if($.isNumeric(active_val) == true){
					if(parseInt(active_val) == 1){
						first_li = '<li class="disabled"><span>«</span></li>';
					}

					if(parseInt(active_val) == k){
						pagin_li += '<li class="active"><span>'+ k +'</span></li>';
					}else{
						pagin_li += '<li><a href="/internal-bkn/loading-training-type-list?page='+ k +'">'+ k +'</a></li>';
					}
				}else{
					pagin_li += '<li><a href="/internal-bkn/loading-training-type-list?page='+ k +'">'+ k +'</a></li>';
				}

			}
		} // End total_li
			
		if(pagin_li != ""){
			pagin_ul = '<ul class="pagination">'+ first_li + pagin_li + last_li + '</ul>';
		}

		$.get('/internal-bkn/loading-training-type-list?page='+ page, function(data){
			if(data != ""){
		
				$('#result_output tbody').html(data);
				$('#list-pagin').html(pagin_ul);
					
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
		});
	});

	$('#find_training_type').on('submit', function(e){
		e.preventDefault();
		var pagin 	   = $('#list-pagin').html();
		var key_search = $('#key_word').val();
		var pagin_ul   = '';
		var pagin_li   = '';

		$('#result_output tbody').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		if(pagin != ''){
			var total_li   = $('ul.pagination li').length - 2;
			var first_li   = '<li><a href="/internal-bkn/loading-training-type-list?page=1">«</a></li>';
			var last_li    = '<li><a href="/internal-bkn/loading-training-type-list?page='+ total_li +'" rel="next">»</a></li>';
			
			if(total_li > 0){
				for(var k=1; k<=total_li; k++){
					if(k == 1){
						pagin_li += '<li class="active"><a href="/internal-bkn/loading-training-type-list?page='+ k +'">'+ k +'</a></li>';
					}else{
						pagin_li += '<li><a href="/internal-bkn/loading-training-type-list?page='+ k +'">'+ k +'</a></li>';
					}
				}
			} // End total_li
				
			if(pagin_li != ""){
				pagin_ul = '<ul class="pagination">'+ first_li + pagin_li + last_li + '</ul>';
			}
		}
		
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
			success: function(result){
				$('#result_output tbody').html(result);
				if(key_search == ''){
					if(pagin != ''){
						$('#list-pagin').html(pagin_ul).show();
					}
				}else{
					if(pagin != ''){
						$('#list-pagin').hide();
					}
				}

				$('.table-responsive .loading').fadeOut('fast');
				$('#result_output tbody').css('opacity', '1');
			}
		});
	});

	function getControl(keep_val=null)
    {
    	var ctrl   = '<input type="text" name="edit-title" class="form-control" id="control-title" value="'+ keep_val +'" />';
    	return ctrl;
    }

    function resourceRow()
    {
    	var row_resource = '<tr bgcolor="#fed189"><td>&nbsp;</td>';
    		row_resource += '<td><input type="text" name="edit-title" class="form-control" id="control-title" placeholder="Training Type Title"/></td>';
    		row_resource += '<td colspan=3>&nbsp;</td>';
    		row_resource += '</tr>';

    	return row_resource; 
    }