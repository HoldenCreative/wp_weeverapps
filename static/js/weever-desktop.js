jQuery(document).ready(function($) {
	
	$('body').append('<div id="weever-view-app" style="background-color: #000;color:#FFF;position:fixed;bottom:0;width:100%;z-index:100001;height:41px;font-family:Arial;text-align:center;><a href="' + WDesktop.url + '">Click here to view mobile version</a></div>');

	$('#weever-view-app').click(function(){
		alert('here now: '+WDesktop.url);
	});
	
});