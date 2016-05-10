jQuery(document).ready(function($) {		
	"use strict";		
	
	var curri = 0;
	var galimgs = new Array();
	
	
	//custom photo viewer
		$('.tp-imageviewer,a.tp-image').click(function(e){
			e.preventDefault();
			
			$('#tp-pv-next,#tp-pv-prev').css('display','none');
			
			var imgurl = $(this).attr('href');
			
			$('#tp-photo-viewer').fadeIn(600,function(){
				$('#tp-pv-img').css('background-image','url('+imgurl+')');
			});		
		});
		
		$('img.tp-image').click(function(e){
			e.preventDefault();
			
			$('#tp-pv-next,#tp-pv-prev').css('display','none');
			
			var imgurl = $(this).closest('a').attr('href');
			
			$('#tp-photo-viewer').fadeIn(600,function(){
				$('#tp-pv-img').css('background-image','url('+imgurl+')');
			});		
		});
		
		$('.gallery-item a').click(function(e){
			e.preventDefault();
			
			$('#tp-pv-next,#tp-pv-prev').css('display','block');
			
			var currimg = $(this).attr('href');			
			
			//put all image urls to array
			var galdiv = $(this).closest('.gallery');
			
			
			var actr = 0;
			$('.gallery-item a',galdiv).each(function(){
				if($(this).attr('href') == currimg){
					curri = actr;
				}
				galimgs.push($(this).attr('href'));
				actr++;
			});
						
			
			//open viewer
			$('#tp-photo-viewer').fadeIn(600,function(){
				$('#tp-pv-img').css('background-image','url('+currimg+')');
			});	
		});
		
	//close	
		$('#tp-pv-close').click(function(){
			$('#tp-photo-viewer').fadeOut(100,function(){
				$('#tp-pv-img').css('background-image','none');
			});			
		});
		$(document).keyup(function(e) {
			if(e.keyCode == 27){ 
				$('#tp-photo-viewer').fadeOut(100,function(){
					$('#tp-pv-img').css('background-image','none');
				});	
			} 
		});
		
		
	//next
		$('#tp-pv-next').click(function(){
			var nexti = curri + 1;
			if(galimgs[nexti]){
				$('#tp-pv-img').css('background-image','none');
				$('#tp-pv-img').css('background-image','url('+galimgs[nexti]+')');
				curri = nexti;
			}			
		});
		$(document).keyup(function(e) {
			if(e.keyCode == 39){ 
				var nexti = curri + 1;
				if(galimgs[nexti]){
					$('#tp-pv-img').css('background-image','none');
					$('#tp-pv-img').css('background-image','url('+galimgs[nexti]+')');
					curri = nexti;
				}
			} 
		});
	
		
	//prev
		$('#tp-pv-prev').click(function(){
			var previ = curri - 1;
			if(galimgs[previ]){
				$('#tp-pv-img').css('background-image','none');
				$('#tp-pv-img').css('background-image','url('+galimgs[previ]+')');
				curri = previ;
			}			
		});
		$(document).keyup(function(e) {
			if(e.keyCode == 37){ 
				var previ = curri - 1;
				if(galimgs[previ]){
					$('#tp-pv-img').css('background-image','none');
					$('#tp-pv-img').css('background-image','url('+galimgs[previ]+')');
					curri = previ;
				}	
			} 
		});
		
		
});