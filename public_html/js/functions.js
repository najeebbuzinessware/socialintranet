function showcommentBox(val,id)
{
	//alert(val);
	if(val=='commentLink'){	
		$('#commentdiv_'+ id).show();
		$('#commentbtn_'+ id).hide();
	}else if(val=='commentbtn'){
		 $('#commentdiv_'+ id).hide();
		 $('#commentbtn_'+ id).show();
	}
}


$(document).ready(function() {
	//function AjaxUpload($posturl,fieldname,formname){
		var errors="";
		//alert($("div.uploadaction").html());
		$('#upload').mfupload({
			
			type		: '',	//all types
			maxsize		: 20,
			post_upload	: $("div.uploadaction").html(),
			folder		: "./",
			ini_text	: "<div class='halfmargin'></div><span>Click / Drag your logo file here</span>",
			over_text	: "<div class='halfmargin'></div><span class='drop'>Drop Here</span>",
			over_col	: 'white',
			over_bkcol	: 'green',
		
			init		: function(){		
				$("#uploaded").empty();
			},
			
			start		: function(result){		
				$("#uploaded").append("<div id='FILE"+result.fileno+"' class='files'>"+result.filename+"<div id='PRO"+result.fileno+"' class='progrez_img'><img src='/images/ajax-loader.gif' /></div></div>");	
			},
	
			loaded		: function(result){
				$("#PRO"+result.fileno).remove();
				$("#FILE"+result.fileno).html("<div class='smallpadding'>Uploaded: "+result.filename+" ("+result.size+")<input type='hidden' name='hdnfilename[]' value='"+result.filename+"' /></div>");				},
	
			progress	: function(result){
				$("#PRO"+result.fileno).css("width", result.perc+"%");
			},
	
			error		: function(error){
				errors += error.filename+": "+error.err_des+"\n";
			},
	
			completed	: function(){
				if (errors != "") {
					alert(errors);
					errors = "";
				}
			}
		});
		
	})