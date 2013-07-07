$(document).ready(function(){
    //read variables from dom
    var url = $('#yii-feeds-widget-url').val();
    var limit = $('#yii-feeds-widget-limit').val();
    var widgetActionUrl = $('#yii-feeds-widget-action-url').val();
    //send ajax request
    $.get(widgetActionUrl,{url:url,limit:limit},function(html){
        //replace contents of widget div with returned items
        $('#yii-feed-container').html(html);
    });
	
	var url1 = $('#yii-feeds-widget-url1').val();
    var limit1 = $('#yii-feeds-widget-limit1').val();
    var widgetActionUrl1 = $('#yii-feeds-widget-action-url1').val();
    //send ajax request
    $.get(widgetActionUrl1,{url:url1,limit:limit1},function(html){
        //replace contents of widget div with returned items
        $('#yii-feed-container1').html(html);
    });
	
	var url2 = $('#yii-feeds-widget-url2').val();
    var limit2 = $('#yii-feeds-widget-limit2').val();
    var widgetActionUrl2 = $('#yii-feeds-widget-action-url2').val();
    //send ajax request
    $.get(widgetActionUrl2,{url:url2,limit:limit2},function(html){
        //replace contents of widget div with returned items
        $('#yii-feed-container2').html(html);
    });
	
});