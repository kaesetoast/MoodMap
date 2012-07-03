var Moodword = {
    init:function () {
        $("#create").bind("click", function () {
            Moodword.save();
        });
        $("#edit").bind("click", function () {
            Moodword.edit();
        });
        $("#moodwordform > fieldset > .control-group > .controls > .color").colorpicker();
    },

    save:function () {
        var word = $("#word").val();

        var colors = Array();
        $(".color > input").each(function () {
            var color = $(this).val();
            colors.push(color.substring(1, 7));
        });

        $("#moodwordform").attr("action", "/admin/moodword/create/" + word + "/" + JSON.stringify(colors));
        $("#moodwordform").submit();
    },

    edit:function () {
        var word = $("#word").val();

        var colors = Array();
        $(".color > input").each(function () {
            var color = $(this).val();
            colors.push(color.substring(1, 7));
        });

        var id = $("#entitydata").data("entityid");

        $("#moodwordform").attr("action", "/admin/moodword/" + id + "/update/" + word + "/" + JSON.stringify(colors));
        $("#moodwordform").submit();
    }
};
$(document).ready(function (event) {
    Moodword.init();
});