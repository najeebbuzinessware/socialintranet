<?php //$this->renderpartial('application.views.common._websitemenu'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="/css/gsFileManager.css" />
		<script type="text/javascript" src="/js/functions.js"></script>
		<script type="text/javascript" src="/js/mfupload.js"></script>
		<script type="text/javascript">
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
	</script>
		
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<!-- <div id="content"> -->
    <h3 class="m-t-0"><i class="icon-folder-close-alt m-r-10"></i>File Manager</h3>
    <!--<div id="fileTreeDemo_1" class="demoto">-->
    <?php $this->widget('common.widgets.gsfilemanager.GSFileManager'); ?>
<!-- </div> -->

    
    
<div class="clearfix"></div>
</div></div>