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

		var pagin_ul   = myPagination('.list-footer .pull-left', '.list-footer ul.pagination li', active_val, 'loading-training-course');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('ul#itemContainer .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

		$.getJSON('/loading-training-course?page='+ page, function(data){
			if(data['result'] != null){
				$('#itemContainer .list-body').remove();
				$('.content-mobile .mobile-body-list').remove();
				$('#itemContainer .list-header').after(data['result']);
				loop_background();
				$('.content-mobile .first').after(data['mobile']);
				$('.list-footer ul.pagination').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.blog-table .loading').fadeOut('fast');
			$('#itemContainer .list-body').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpCustomize .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();

		var pagin_ul   = myPagination('.list-footer .text-center', '.list-footer ul.pagination li', active_val, 'loading-customize-training');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('ul#customize_training .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

		$.getJSON('/loading-customize-training?page='+ page, function(data){
			if(data['result'] != null){
				$('#customize_training .list-body').remove();
				$('.content-mobile .mobile-body-list').remove();
				$('#customize_training .list-header').after(data['result']);
				loop_background();
				$('.content-mobile .first').after(data['mobile']);
				$('.list-footer ul.pagination').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.blog-table .loading').fadeOut('fast');
			$('#customize_training .list-body').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpResource .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();
		
		var pagin_ul   = myPagination('.list-footer .text-center', '.list-footer ul.pagination li', active_val, 'loading-resources');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('ul#free_resource .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

		$.getJSON('/loading-resources?page='+ page, function(data){
			if(data['result'] != null){
				$('#free_resource .list-body').remove();
				$('.content-mobile .mobile-body-list').remove();
				$('#free_resource .list-header').after(data['result']);
				loop_background();
				$('.content-mobile .first').after(data['mobile']);
				$('.list-footer ul.pagination').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.blog-table .loading').fadeOut('fast');
			$('#free_resource .list-body').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('body').on('click', '#tmpJob .pagination a', function(ev){
		ev.preventDefault();
		var active_val = $(this).html();
		var pagin_ul   = myPagination('.list-footer .text-center', '.list-footer ul.pagination li', active_val, 'loading-job-vacancy');
		var page 	   = $(this).attr('href').split('page=')[1];

		$('#tmpJob .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

		$.getJSON('/loading-job-vacancy?page='+ page, function(data){
			if(data['result'] != null){
				$('#itemContainer .list-body').remove();
				$('.content-mobile .mobile-body-list').remove();
				$('#itemContainer .list-header').after(data['result']);
				loop_background();
				$('.content-mobile .first').after(data['mobile']);
				$('.list-footer ul.pagination').html(pagin_ul);
				$('.mobile-footer ul.pagination').html(pagin_ul);
					
			}
			$('.blog-table .loading').fadeOut('fast');
			$('#tmpJob .list-body').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
		});
	});

	$('#searchJob').on('submit', function(e){
		e.preventDefault();
		var title = $('#job-title').val();

		$('#tmpJob .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

	    $.ajax({
	            type: "POST",
	            url: $(this).attr('action'),
	            dataType: "json",
	            data: $(this).serialize(),
				success: function(result){
					if(result['result'] != null){
						$('#itemContainer .list-body').remove();
						$('.content-mobile .mobile-body-list').remove();
						$('#itemContainer .list-header').after(result['result']);
						loop_background();
						$('.content-mobile .first').after(result['mobile']);

						$('.clear-result').text('Clear Results');
						$('.list-footer .text-center').hide();
						$('.mobile-footer').hide();
					}else{
						$('#itemContainer .list-body').remove();
						$('.content-mobile .mobile-body-list').remove();
						$('#itemContainer .list-header').after('<li class="list-body notfound">Not Found Results</li>');
						$('.list-footer .text-center').hide();
						$('.content-mobile .first').after('<li class="mobile-body-list mobile-notfound">Not Found Results</li>')
						$('.mobile-footer').hide();
					}
				}
		});

		$('#tmpJob .loading').fadeOut('fast');
		$('#itemContainer .list-body').css('opacity', '1');
		$('.content-mobile .mobile-body-list').css('opacity', '1');
	});

	$('body').on('click', '.clear-result', function(){

		$('#tmpJob .list-body').css('opacity', '0.6');
		$('.content-mobile .mobile-body-list').css('opacity', '0.6');
		$('.blog-table .loading').fadeIn('fast');

		var pagin_ul = myPagination('.list-footer .text-center', '.list-footer ul.pagination li', 1, 'loading-job-vacancy');

		$.getJSON('/clear-job-results', function(data){
			if(data['result'] != null){
				$('#itemContainer .list-body').remove();
				$('.content-mobile .mobile-body-list').remove();
				$('#itemContainer .list-header').after(data['result']);
				loop_background();
				$('.content-mobile .first').after(data['mobile']);
				$('.list-footer .text-center .pagination').replaceWith(pagin_ul);
				$('.mobile-footer .pagination').replaceWith(pagin_ul);
				$('.list-footer .text-center').show();
				$('.mobile-footer').show();
				$('.clear-result').text('');
			}
			$('#tmpJob .list-body').css('opacity', '1');
			$('.content-mobile .mobile-body-list').css('opacity', '1');
			$('.blog-table .loading').fadeOut('fast');
		});
	});

	$('body').on('click', '.down_res', function(){
		$(this).addClass('focus');
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