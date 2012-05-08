var Util = {
	Modal: {
		invoke:function(headline, message, submitButtonText) {
			$("#modal-headline", "#modal-wrapper").text(headline);
			$($(".modal-body", "#modal-wrapper")[0]).html(message);
			$("#modal-submit", "#modal-wrapper").text(submitButtonText);
			
			$("#modal-wrapper").modal("show");
		}
	}	
};