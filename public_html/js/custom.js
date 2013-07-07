
	var goTagIt = "false";	

		$(document).ready(
			function(){

				//Bootstrap powered Device Detector
				deviceChecker();
				$(window).resize(
					function(){
						deviceChecker();
					}
				);
				function deviceChecker(){
						var vDesktop = $('.deviceDetector .vDesktop').css('display').toLowerCase();
						var vTablet = $('.deviceDetector .vTablet').css('display').toLowerCase();
						var vPhone = $('.deviceDetector .vPhone').css('display').toLowerCase();

						if (vDesktop == "block") {
							$('body').addClass('vDesktop');
							$('body').removeClass('vTablet');
							$('body').removeClass('vPhone');
						} else if ( vTablet == "block" ) {
							$('body').removeClass('vDesktop');
							$('body').addClass('vTablet');
							$('body').removeClass('vPhone');							
						} else {
							$('body').removeClass('vDesktop');
							$('body').removeClass('vTablet');
							$('body').addClass('vPhone');								
						}
				}
				//***************//

				//Alter Select Input
				//$(".postViewer").select2({ tags:["red", "green", "blue"] });



				//Carousel Initialisation
				$('#newsSliderHolder').carousel();

				postBoxEfx();
				function postBoxEfx(){


					//Show Items
					$('.postBoxEfxBtn01').click(
						function(){
							//alert('hi');
							$('.postBoxEfxBtn01').css('display','none');
							$('.mfboxTop .txtboxHolder textarea').slideDown('fast');
							$('.mfboxTop .mfboxControls').css('display','block');
							$('.mfBox .postBtnbox').fadeIn('slow');
							 $('.mfboxTop .txtboxHolder textarea').focus();
						}
					);

					//Hide Items
					$('.postBoxEfxBtn02').click(
						function(){
							//alert('hi');
							$('.mfboxTop .txtboxHolder textarea').css('display','none');
							$('.mfboxTop .mfboxControls').css('display','none');
							$('.mfBox .postBtnbox').css('display','none');
							$('.postBoxEfxBtn01').css('display','block');
						}
					);					
				}


				tagsuggestionV2();
				function tagsuggestionV2(){
					$().click(
						function(){
							
						}
					);
				}
				
				
				
				//TagInputBox Initialisation
				//$('.tagInputBox').tagsInput({width:'auto'});
				
				//tagsuggestion();
				//TagSuggestion Dropdown
				function tagsuggestion(){

					$(".tagInput .tagsinput input").focus( function(){
						$(".tagSuggestionHolder").css('display','block');
						$('.tagSuggestionHolder .tagLists').css('display','block');
						$('.tagSuggestionHolder .tagError').css('display','none');	
						$(".tagInput .tagsinput input").val("");						
					});

					var clickedTableData = "false";
					$(".tagInput .tagsinput input").focusout( function(){
						focusOutEdit();
					});
						function focusOutEdit(){
							if ( clickedTableData == "false" ) {
								$(".tagSuggestionHolder").css('display','none');
								$('.tagSuggestionHolder .tagLists').css('display','block');
								$('table.tagResults tr td').css('display','block');
								$('.tagSuggestionHolder .tagError').css('display','none');	
							}							
						}
					
					
					$('.tagSuggestionHolder .tagResults').hover( function(){
						clickedTableData = "true";

					}, function(){  
						clickedTableData = "false";
					});	

						$('.tagSuggestionHolder .tagResults td').click( function(){
							//console.log( $(this).text() );
							$(".tagInput .tagsinput input").val( $(this).text() );
							clickedTableData = "false";
							focusOutEdit();
							//$(".tagInput .tagsinput input").focusout();
							goTagIt = "true" ;
							if ($('.tagInputBox').tagExist( $(".tagInput .tagsinput input").val() )) {
								$(".tagInput .tagsinput input").val('');
							} else {
								$('.tagInputBox').addTag( $(".tagInput .tagsinput input").val() );
							}
								
						});

						$('.tagSuggestionHolder .tagResultsHead th').click( function(){
							console.log( $(this).text() );
						});

					var i, j, getStr, temp, none;
					$(".tagInput .tagsinput input").keyup(function(){
	
						i = $('table.tagResults tr').length;
						j=0;
						getStr = $('.tagInput .tagsinput input').val();
						//console.log( getStr );
						temp = '';
						none = "true";

						$('.tagSuggestionHolder .tagLists').css('display','block');
						$('.tagSuggestionHolder .tagError').css('display','none');	

					   	$('table.tagResults tr td').css('display','none');

					   	goTagIt = "false" ;

					   	if ( getStr != '' ) {

						    for (j=0; j<i; j++){
						    	//temp = $('table.tagResults tr:eq(' + j + ') td' ).attr('class');
						    	temp = $('table.tagResults tr:eq(' + j + ') td' ).text();
						    	//console.log( temp.search(getStr) );

						    	if ( temp.search(getStr) > -1 ){
						    		//console.log('Yes');
						    		$('table.tagResults tr:eq(' + j + ') td' ).css('display','block');

						    		if ( $('table.tagResults').find("td:visible").length == 1 ) {
						    			if ( getStr == temp ) {
						    				goTagIt = "true" ;
						    			}
						    		} else {	
						    			goTagIt = "false" ;
						    		}

						    		none = "false";
						    	} else {
						    		//console.log('No');
						    	}
						    }

						    //if ( goTagIt == "true" ) { $('.tagInput .tagsinput input').val( temp ); }

						    if ( none == "true" ) {
					    		$('.tagSuggestionHolder .tagLists').css('display','none');
					    		$('.tagSuggestionHolder .tagError').css('display','block');	
					    		goTagIt = "false" ;					    	
						    }


						 } else {
						 	$('table.tagResults tr td' ).css('display','block');
						 }


					  });						
				}








			});









