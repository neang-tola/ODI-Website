$(document).ready(function () {

	// home slider
	$('.home-sliders').slick({
		autoplay: true,
		autoplaySpeed: 5000,
		ltr: true,
		prevArrow: '',
		nextArrow: '',
	});

    $(".carousel-indicators-text li").click(function(e){
        e.preventDefault();
        slideIndex = $(this).index();
        $( ".home-sliders" ).slick('slickGoTo', parseInt(slideIndex));
    });
	
	$('.home-sliders').on('afterChange', function(event, slick, currentSlide, nextSlide){
		$(".carousel-indicators-text li.active").removeClass('active');
		$(".carousel-indicators-text li[data-slider="+currentSlide+"]").addClass('active');
		
	});

	// logo partner
	$('.logo-partner-slider').slick({
		slidesToShow: 6,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		variableWidth: true,
		prevArrow: '',
		nextArrow: '',
	});


});

// Touch slide

$('.fdi-Carousel .item').next().children(':first-child').bind('taphold', function() {
    console.log("bind");
    $('.fdi-Carousel .item').bind("change", function(event, ui) {
        console.log(this.value);
    });
});

$('.fdi-Carousel .item').next().children('a').bind('vmouseup', function() {
    console.log("unbind");
    $('.fdi-Carousel .item').unbind("change")
});

// menu
$('.box-menu li').on('mouseenter', function(){
	var img_val = $(this).find('img').attr('src');
	var new_img = img_val.split('/')[3];
	
	$(this).find('img').attr('src', '/public/menu_icons/a'+ new_img.slice(1, new_img.length));
});

$('.box-menu li').on('mouseleave', function(){
	var img_val = $(this).find('img').attr('src');
	var new_img = img_val.split('/')[3];
	
	$(this).find('img').attr('src', '/public/menu_icons/i'+ new_img.slice(1, new_img.length));
});

$('.down_resource').on('mouseenter', function(){
	var img_val = $(this).find('img').attr('src');
	var new_img = img_val.split('/')[3];
	
	$(this).find('img').attr('src', '/public/_images/i'+ new_img);
});

$('.down_resource').on('mouseleave', function(){
	var img_val = $(this).find('img').attr('src');
	var new_img = img_val.split('/')[3];
	
	$(this).find('img').attr('src', '/public/_images/'+ new_img.slice(1, new_img.length));
});

// box-menu
var width = $(window).width();

if ((width <= 768)) {

	 $('body').on('click', 'nav.nav-mobile', function(){
		$('ul.box-menu').slideToggle();
	})

    } else {

}


// $('ul.content-mobile li.mobile-body-list').on('click', function(event){
// 	$(this).find('.course').slideToggle();
// });

// Loop background list
function loop_background(){
	var list_loop = $('.content-table-list .list-body'),i;
	var colors = ["#FFF","#E1F4FD"];
	var i = 0;

	 for(var j=0;j<list_loop.length;j++) {
	     list_loopBG= list_loop[j];

	     if(!list_loopBG) return;

	     list_loop[j].style.background =colors[i];

	     if(i == colors.length -1){
	          i= 0;
	     }else{
	          i++;
	     }
	 }	
}

loop_background();

// Change form upload file
;(function($) {

		  // Browser supports HTML5 multiple file?
		  var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
		      isIE = /msie/i.test( navigator.userAgent );

		  $.fn.customFile = function() {

		    return this.each(function() {

		      var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
		          $wrap = $('<div class="file-upload-wrapper">'),
		          $input = $('<input type="text" class="file-upload-input" placeholder="No file select"/>'),
		          // Button that will be used in non-IE browsers
		          $button = $('<button type="button" class="file-upload-button">Browse...</button>'),
		          // Hack for IE
		          $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Browse...</label>');

		      // Hide by shifting to the left so we
		      // can still trigger events
		      $file.css({
		        position: 'absolute',
		        left: '-9999px'
		      });

		      $wrap.insertAfter( $file )
		        .append( $file, $input, ( isIE ? $label : $button ) );

		      // Prevent focus
		      $file.attr('tabIndex', -1);
		      $button.attr('tabIndex', -1);

		      $button.click(function () {
		        $file.focus().click(); // Open dialog
		      });

		      $file.change(function() {

		        var files = [], fileArr, filename;

		        // If multiple is supported then extract
		        // all filenames from the file array
		        if ( multipleSupport ) {
		          fileArr = $file[0].files;
		          for ( var i = 0, len = fileArr.length; i < len; i++ ) {
		            files.push( fileArr[i].name );
		          }
		          filename = files.join(', ');

		        // If not supported then just take the value
		        // and remove the path to just show the filename
		        } else {
		          filename = $file.val().split('\\').pop();
		        }

		        $input.val( filename ) // Set the value
		          .attr('title', filename) // Show filename in title tootlip
		          .focus(); // Regain focus

		      });

		      $input.on({
		        blur: function() { $file.trigger('blur'); },
		        keydown: function( e ) {
		          if ( e.which === 13 ) { // Enter
		            if ( !isIE ) { $file.trigger('click'); }
		          } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
		            // On some browsers the value is read-only
		            // with this trick we remove the old input and add
		            // a clean clone with all the original events attached
		            $file.replaceWith( $file = $file.clone( true ) );
		            $file.trigger('change');
		            $input.val('');
		          } else if ( e.which === 9 ){ // TAB
		            return;
		          } else { // All other keys
		            return false;
		          }
		        }
		      });

		    });

		  };

}(jQuery));

$('input[type=file]').customFile();


$('.carousel').carousel({
  interval: 10000
})