var Util = {
	Modal: {

        ContentLookup: {
            LOGIN: "/login"
        },

		invoke:function(headline, modalContent, submitButtonText) {
            $.post(modalContent, function(message) {
                $("#modal-headline", "#modal-wrapper").text(headline);

                $($(".modal-body", "#modal-wrapper")[0]).html(message);
                $("#modal-submit", "#modal-wrapper").text(submitButtonText);

                $("#modal-wrapper").modal("show");
            });
		}
	}	
};