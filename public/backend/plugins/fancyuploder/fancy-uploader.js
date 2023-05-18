(function($) {
	//fancyfileuplod
	$('#images1').FancyFileUpload({
	params : {
		 action : 'fileuploader'
		},
		edit : false,
		maxfilesize : 1000000,
		startupload : function(SubmitUpload, e, data) {
			console.log("helll");
			$.ajax({
				'url' : 'gettoken.php',
				'dataType' : 'json',
				'success' : function(tokendata) {
					token = tokendata;

					SubmitUpload();
				}
			});
		},
	});
})(jQuery);