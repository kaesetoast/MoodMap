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
                    Util.Alert.invoke(response.message, Util.Alert.ERROR_ALERT, true);
                }
            });
        }
	},

    Alert: {

        ERROR_ALERT: "alert-error",
        SUCCESS_ALERT: "alert-success",
        INFO_ALERT: "alert-info",

        invoke: function(message, type, modal) {
            if (type != Util.Alert.ERROR_ALERT && type != Util.Alert.SUCCESS_ALERT && Util.Alert.INFO_ALERT) {
                throw "unsupported alert type!";
            }
            if (modal != true) {
                var alertWindow = $("#" + type);
            } else {
                var alertWindow = $("#modal-alert");
                alertWindow.addClass(type);
            }
            var messageBox = $($(".alert-message", alertWindow)[0]);
            messageBox.text(message);
            alertWindow.show();
        }
    },

    getUserId: function() {
        return $('body').data('userid');
    }
};