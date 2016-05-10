jQuery(document).ready(function($) {		
	"use strict";		
	

	
	//FONT FIX FOR CHROME	
		var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;	
		if(is_chrome){	
			$('h1, h2, h3, h4, h5, h6, .cta.style1 p, .tp-cta.style1 p a, .woocommerce ul.products li.product a, .woocommerce-page ul.products li.product a,h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, a.button').css('font-weight','normal');
		}
	
	
	//RESPONSIVE MENU
		var responsiveMenu = 'closed';		
		$(document).on('click','#responsive-menu',function(){
			if(responsiveMenu == 'closed'){
				$('i',this).removeClass('fa-bars').addClass('fa-times');
				$('#page-content,footer').css('opacity','0.2');
				$('#respo-menu-holder').slideToggle();
				
				responsiveMenu = 'opened';			
			}else{
				$('i',this).removeClass('fa-times').addClass('fa-bars');
				$('#page-content,footer').css('opacity','1');
				$('#respo-menu-holder').slideToggle();
				
				responsiveMenu = 'closed';
			}
		});
	
	
	
});

