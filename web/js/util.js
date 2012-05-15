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
		},

        submit: function() {
            var url = $("form[name=modalform]").attr("action");
            var formData = $("form[name=modalform]").serializeArray();
            $.post(url, formData, function(response) {
                response = $.parseJSON(response);
                if (response.success) {
                    window.location = response.url;
                } else {
                    if (!$("#modal-alert").length > 0) {
                        $($(".modal-body")[0]).prepend("<div id='modal-alert' class='alert'>" +
                            "<button class='close' data-dismiss='alert'>×</button><div id='alert-message'></div></div>");
                    }
                    $("#modal-alert").addClass("alert-error");
                    $($("#alert-message")[0]).text(response.message);
                    $("#modal-alert").show();
                }
            });
        }
	}	
};