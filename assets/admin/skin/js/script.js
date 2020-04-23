 // event pada saat link di klik
$('.page-scroll').on('click', function(e){

	// ambil isi href
	var tujuan = $(this).attr('href');
	// tangkap alemen ybs
	var elemenTujuan = $(tujuan);
	
	//pindahkan scroll

	$('html,body').animate({
		scrollTop: elemenTujuan.offset().top -40
	}, 1250, 'easeInOutExpo');

	e.preventDefault();
});

// about

$(window).on('load', function() {
	$('.pLeft').addClass('pShow');
	$('.pRight').addClass('pShow');
});

// parallax
$(window).scroll(function() {
	var wScroll = $(this).scrollTop();

	//jumbotron
	$('.jumbotron img').css({
		'transform' : 'translate(0px, '+ wScroll/4 +'%)'
	});

	$('.jumbotron h1').css({
		'transform' : 'translate(0px, '+ wScroll/2 +'%)'
	});

	$('.jumbotron p').css({
		'transform' : 'translate(0px, '+ wScroll/1.2 +'%)'
	});


	// program
	if( wScroll > $('.program').offset().top - 350) {
		$('.program .thumbnail').each(function(i) {
			setTimeout(function() {
				$('.program .thumbnail').eq(i).addClass('show');
			}, 300 * (i+1));
		});	
	}
});







