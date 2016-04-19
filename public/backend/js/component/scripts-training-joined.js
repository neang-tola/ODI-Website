
	$('body').on('click', 'ul.pagination a', function(ev){
		ev.preventDefault();

		var params	   = '';
		var training   = $('#trainingId').val();
		if(training != ''){
			params    = '&trnid='+ training; 
		}

		var active_val = $(this).html();
		var pagin_ul   = '';
		var pagin_li   = '';
		var total_li   = $('ul.pagination li').length - 2;
		var first_li   = '<li><a href="/internal-bkn/loading-training-joined-list?page=1'+ params +'">«</a></li>';
		var last_li    = '<li><a href="/internal-bkn/loading-training-joined-list?page='+ total_li + params +'" rel="next">»</a></li>';

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
						pagin_li += '<li><a href="/internal-bkn/loading-training-joined-list?page='+ k + params +'">'+ k +'</a></li>';
					}
				}else{
					pagin_li += '<li><a href="/internal-bkn/loading-training-joined-list?page='+ k + params +'">'+ k +'</a></li>';
				}

			}
		} // End total_li
			
		if(pagin_li != ""){
			pagin_ul = '<ul class="pagination">'+ first_li + pagin_li + last_li + '</ul>';
		}

		$.get('/internal-bkn/loading-training-joined-list?page='+ page + params, function(data){
			if(data != ""){
				$('#result_output tbody').html(data);
				$('#list-pagin').html(pagin_ul);
					
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
		});
	});

	$('#find_training_joined').on('submit', function(e){
		e.preventDefault();
		var pagin 	   = $('#list-pagin').html();
		var key_search = $('#key_word').val();
		var pagin_ul   = '';
		var pagin_li   = '';
		var params	   = '';

		$('#result_output tbody').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		var training   = $('#trainingId').val();
		if(training != ''){
			params    = '&trnid='+ training; 
		}

		if(pagin != ''){
			var total_li   = $('ul.pagination li').length - 2;
			var first_li   = '<li><a href="/internal-bkn/loading-training-joined-list?page=1'+ params +'">«</a></li>';
			var last_li    = '<li><a href="/internal-bkn/loading-training-joined-list?page='+ total_li + params +'" rel="next">»</a></li>';
			
			if(total_li > 0){
				for(var k=1; k<=total_li; k++){
					if(k == 1){
						pagin_li += '<li class="active"><a href="/internal-bkn/loading-training-joined-list?page='+ k + params +'">'+ k +'</a></li>';
					}else{
						pagin_li += '<li><a href="/internal-bkn/loading-training-joined-list?page='+ k + params +'">'+ k +'</a></li>';
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

	$('body').on('click', '.join-status', function(){
		var join_info = $(this).attr('id');
		var cur_place = $(this);

		if(typeof join_info !== 'undefined'){
			var join_status = join_info.split('-');
			
			$.get('/internal-bkn/status-training-joined?joinid='+ join_status[1] +'&status='+ join_status[2], function(result){
				if(result != ''){
					cur_place.parent().parent().parent().html(result);
				}
			});
		}
	});