(function( $ ) {
 
    "use strict";
	
	$(".toplevel_page_mail-it .wp-submenu > li:nth-child(3)").addClass(' proSpan');
	$(".toplevel_page_mail-it .wp-submenu > li:nth-child(4)").addClass(' proSpan');
	$(".toplevel_page_mail-it .wp-submenu > li:nth-child(3)").addClass('mailItModalpRO proSpan');
	$(".toplevel_page_mail-it .wp-submenu > li:nth-child(4)").addClass('mailItModalpRO proSpan');	
		$(".mailItModalpRO").click(function(e){
			e.preventDefault();
			$("#mailItModal").slideDown();
	});
	
	$("#mailItModal .close").click(function(e){
		e.preventDefault();
		$("#mailItModal").fadeOut();
	});		

		var mailItModal = document.getElementById('mailItModal');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == mailItModal) {
				mailItModal.style.display = "none";
			}
		}
		
	
    $(function() {
        $('.mailIt_wrap .color').wpColorPicker();
    });
	
    $(".mailIt_wrap #tabs").tabs();
	$(".mailIt_wrap .subtabs").tabs();	 
    $(".mailIt_wrap #accordion" ).accordion();
    
	$(".mailIt_wrap #tabs a").on('click', function() {
		if( $(this).hasClass('mailIt_hideSubmit')){
			$(".mailIt_wrap #mailItint_form .submit").hide();
		}else $(".mailIt_wrap #mailItint_form .submit").show();     
    });
	 
    $('.mailIt_wrap .color').wpColorPicker();

     $(".mailIt_yes").on('click', function() {
        if($(this).is(':checked')){

            if($(".mailIt_mail").val() !=='') {
                alert(mailIt.noticeOk+ " " + $(".mailIt_mail").val() );
            }else alert(mailIt.noticeNotOk );
            
        }       
        
     });



	function triggerGeneralTab(){
		$('.mailIt_generalTab').trigger('click');
	}
	function triggerSendTab(){
		$('.mailIt_send').trigger('click');
	}	
	
	$(".mailIt_wrap #mailIt_now").on("click", function () {
		if ($(this).is(':checked')) {
				if (confirm(mailIt.sendNow) ) {
					$(".mailIt_wrap #mailItint_form").submit();
				}else $('.mailIt_wrap #mailIt_now').prop('checked', false); // Uncheck				
		}
	});
	
	
	$(".mailIt_wrap .mailIt_preview").on("click", function () {
		
		$(".mailIt_wrap #htmlTemplate .firstCol").toggleClass("sendmail_hidden");
		$(".mailIt_wrap #htmlTemplate .secCol").toggleClass("sendmail_fullWidth");
		
		if($(this).text()=== mailIt.showMore ){
			$(this).text(mailIt.showLess);
		}else  $(this).text(mailIt.showMore);
	
		localStorage.setItem("previewNeeded", "yes");
		if ($(".mailIt_wrap #mailIt_now").is(':checked')) {
			$('.mailIt_wrap #mailIt_now').prop('checked', false); // Uncheck
		}
	
	});

	
	function mailItForm(){
			$(".mailIt_wrap #mailItint_form").on("submit", function (e) {		
				e.preventDefault();
				var sendEmailData = $(this).serialize();
					$.ajax({
						url: $(this).attr('action'),
						data:  sendEmailData,
						type: 'POST',
						beforeSend: function() {								
							$('.mailIt_wrap').addClass('loading');
						},						
						success: function(response){
							$(".mailIt_wrap .sendMailResult").slideDown().html($(response).find(".sendMailResult").html());
							$('.mailIt_wrap').removeClass('loading');
							$('.mailIt_wrap #mailIt_now').prop('checked', false);
							
							if(localStorage.getItem("previewNeeded") ==='yes' ){
								localStorage.removeItem("previewNeeded");
							}
						}
					});				
			});
	}
	mailItForm();


	function mailItPreview(){

		$(".mailIt_wrap #mailIt_header_background").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();
			
			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'background', theColor, 'important' );
			});
		  } 
		});	
		$(".mailIt_wrap #mailIt_header_color").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();
			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'color', theColor, 'important' );
			});			
		  } 
		});	

		$(".mailIt_wrap #mailIt_header_alignment").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'text-align', thisVal, 'important' );
			});	
		});	
		
		$(".mailIt_wrap #mailIt_header_size").on("change", function () {
			var thisVal;
			thisVal = $(this).val();

			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});		
			$( ".mailIt_wrap .mailItHeader > * ").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});			
		});	
		
		$(".mailIt_wrap #mailIt_header_padding").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'padding', thisVal+"px", 'important' );
			});				
		});
		
		$(".mailIt_wrap #mailIt_header_font").on("change", function () {
			var thisVal;
			thisVal = $(this).val();

			$( ".mailIt_wrap .mailItHeader").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});		
			$( ".mailIt_wrap .mailItHeader > * ").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});	
			
		});		
			
		$(".mailIt_wrap #mailIt_header").on("keyup", function () {
			var thisVal;
			thisVal = $(this).val();
			setTimeout(function(){ 	
				$(".mailIt_wrap .mailItHeader").html(thisVal);
			}, 300);	
		});

		
		$(".mailIt_wrap #mailIt_content_background").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();

			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'background', theColor, 'important' );
			});			
			
		  } 
		});	
		$(".mailIt_wrap #mailIt_content_color").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();
			
			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'color', theColor, 'important' );
			});				
			
		  } 
		});
		$(".mailIt_wrap #mailIt_content_alignment").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'text-align', thisVal, 'important' );
			});					
			
		});	
		
		$(".mailIt_wrap #mailIt_content_size").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});		
			$( ".mailIt_wrap .mailItContent > * ").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});				
			
		});	
		
		$(".mailIt_wrap #mailIt_content_padding").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'padding', thisVal+"px", 'important' );
			});			
			
		});
		
		$(".mailIt_wrap #mailIt_content_font").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			$( ".mailIt_wrap .mailItContent").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});		
			$( ".mailIt_wrap .mailItContent > * ").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});	
		});			

		$(".mailIt_wrap #mailIt_content").on("keyup", function () {
			var thisVal;
			thisVal = $(this).val();
			setTimeout(function(){ 
				$(".mailIt_wrap .mailItContent").html(thisVal);
			}, 300);
		});

		
		$(".mailIt_wrap #mailIt_footer_background").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();

			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'background', theColor, 'important' );
			});			
			
		  } 
		});	
		$(".mailIt_wrap #mailIt_footer_color").wpColorPicker({
		  change: function(event, ui){
			var theColor = ui.color.toString();
			
			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'color', theColor, 'important' );
			});				
			
		  } 
		});
		$(".mailIt_wrap #mailIt_footer_alignment").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'text-align', thisVal, 'important' );
			});					
			
		});	
		
		$(".mailIt_wrap #mailIt_footer_size").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});		
			$( ".mailIt_wrap .mailItFooter > * ").each(function () {
				this.style.setProperty( 'font-size', thisVal+"px", 'important' );
			});				
			
		});	
		
		$(".mailIt_wrap #mailIt_footer_padding").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			
			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'padding', thisVal+"px", 'important' );
			});			
			
		});
		
		$(".mailIt_wrap #mailIt_footer_font").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			$( ".mailIt_wrap .mailItFooter").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});		
			$( ".mailIt_wrap .mailItFooter > * ").each(function () {
				this.style.setProperty( 'font-family', thisVal, 'important' );
			});	
		});					
	
		$(".mailIt_wrap #mailIt_footer").on("keyup", function () {
			var thisVal;
			thisVal = $(this).val();
			setTimeout(function(){ 
				$(".mailIt_wrap .mailItFooter").html(thisVal);
			}, 300);
		});
		
		$(".mailIt_wrap #mailIt_css").on("change", function () {
			var thisVal;
			thisVal = $(this).val();
			$(".mailItWrapper").prepend("<style>"+thisVal+"</style>");
		});	
		
		
	}
	mailItPreview();
	
})(jQuery);