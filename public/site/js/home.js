jQuery(document).ready(function(){

/*	$.get('/loading-partner', function(partner){
		if(partner != ''){
			$('.show-partner .container-fluid').html(partner);
		}
	});*/
});

	$('body').on('click', '#tmpTraining .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();

		var pagin_ul   = myPagination('.table-responsive tfoot td', '.table-responsive tfoot ul.pagination li', active_val, 'loading-training-course');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		$.getJSON('/loading-training-course?page='+ page, function(data){
			if(data['result'] != null){
				$('.content-mobile .mobile-body-list').remove();
				$('#result_output tbody').html(data['result']);
				$('.content-mobile .first').after(data['mobile']);
				$('.table-responsive tfoot ul').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpCustomize .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();

		var pagin_ul   = myPagination('.table-responsive tfoot td', '.table-responsive tfoot ul.pagination li', active_val, 'loading-customize-training');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		$.getJSON('/loading-customize-training?page='+ page, function(data){
			if(data['result'] != null){
				$('.content-mobile .mobile-body-list').remove();
				$('#result_output tbody').html(data['result']);
				$('.content-mobile .first').after(data['mobile']);
				$('.table-responsive tfoot ul').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpResource .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();
		
		var pagin_ul   = myPagination('.table-responsive tfoot td', '.table-responsive tfoot ul.pagination li', active_val, 'loading-resources');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		$.getJSON('/loading-resources?page='+ page, function(data){
			if(data['result'] != null){
				$('.content-mobile .mobile-body-list').remove();
				$('#result_output tbody').html(data['result']);
				
				$('.content-mobile .first').after(data['mobile']);
				$('.table-responsive tfoot ul').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpJob .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();
		var pagin_ul   = myPagination('.table-responsive tfoot td', '.table-responsive tfoot ul.pagination li', active_val, 'loading-job-vacancy');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		$.getJSON('/loading-job-vacancy?page='+ page, function(data){
			if(data['result'] != null){
				$('.content-mobile .mobile-body-list').remove();
				$('#result_output tbody').html(data['result']);
				$('.content-mobile .first').after(data['mobile']);
				$('.table-responsive tfoot ul').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.table-responsive .loading').fadeOut('fast');
			$('#result_output tbody').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('#searchJob').on('submit', function(e){
		e.preventDefault();
		var title = $('#job-title').val();

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

	    $.ajax({
	            type: "POST",
	            url: $(this).attr('action'),
	            dataType: "json",
	            data: $(this).serialize(),
				success: function(result){
					if(result['result'] != null){
						$('.content-mobile .mobile-body-list').remove();
						$('#result_output tbody').html(result['result']);
						$('.content-mobile .first').after(result['mobile']);

						if(title == ''){ $('.clear-result').text('');	}
						else { $('.clear-result').text('Clear Results');}
						
						$('.table-responsive tfoot .footer').hide();
						$('.mobile-footer').hide();
					}else{
						$('.content-mobile .mobile-body-list').remove();
						$('#result_output tbody').html('<tr><td colspan="5">Not Found Results</td></tr>');
						$('.table-responsive tfoot .footer').hide();
						$('.content-mobile .first').after('<li class="mobile-body-list mobile-notfound">Not Found Results</li>')
						$('.mobile-footer').hide();
					}
				}
		});

		$('.table-responsive .loading').fadeOut('fast');
		$('#result_output tbody').css('opacity', '1');
		$('.content-mobile .mobile-body-list').css('opacity', '1');
	});

	$('body').on('click', '.clear-result', function(){

		$('#result_output tbody').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.table-responsive .loading').fadeIn('fast');

		var pagin_ul = myPagination('.table-responsive tfoot td', '.table-responsive tfoot ul.pagination li', 1, 'loading-job-vacancy');

		$.getJSON('/clear-job-results', function(data){

			if(data['result'] != null){
				$('.content-mobile .mobile-body-list').remove();
				$('#result_output tbody').html(data['result']);
				$('.content-mobile .first').after(data['mobile']);

				$('.table-responsive tfoot .footer .pagination').replaceWith(pagin_ul);
				$('.mobile-footer .pagination').replaceWith(pagin_ul);
				$('.table-responsive tfoot .footer').show();
				$('.mobile-footer').show();
				$('.clear-result').text('');
			}
			$('#result_output tbody').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
			$('.table-responsive .loading').fadeOut('fast');
		});
	});

	$('body').on('click', '.down_res', function(){
		$(this).parent().attr('class', 'not_linked');
		$(this).attr('class', 'downloaded');
	});

	function myPagination(selector, selector_ul, active_val, url_link)
	{
		var pagin 	   = $(selector).html();
		var pagin_ul   = '';
		var pagin_li   = '';

		if(pagin != ''){
			var total_li   = $(selector_ul).length - 2;
			var first_li   = '<li><a href="/'+ url_link +'?page=1">«</a></li>';
			var last_li    = '<li><a href="/'+ url_link +'?page='+ total_li +'" rel="next">»</a></li>';
			
			if(total_li > 0){
				for(var k=1; k<=total_li; k++){

					if($.isNumeric(active_val) == true){
						if(parseInt(active_val) == 1){
							first_li = '<li class="disabled"><span>«</span></li>';
						}

						if(parseInt(active_val) == k){
							pagin_li += '<li class="active"><span>'+ k +'</span></li>';
						}else{
							pagin_li += '<li><a href="/'+ url_link +'?page='+ k +'">'+ k +'</a></li>';
						}
					}else{
						pagin_li += '<li><a href="/'+ url_link +'?page='+ k +'">'+ k +'</a></li>';
					}

				}
			} // End total_li
				
			if(pagin_li != ""){
				pagin_ul = '<ul class="pagination">'+ first_li + pagin_li + last_li + '</ul>';
			}
		}

		return pagin_ul;
	}