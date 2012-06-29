Moodword = {
    init:function () {
        $("#create").bind("click", function () {
            Moodword.save();
        });
        $(".controls > .color").ColorPicker({
            onSubmit:function (hsb, hex, rgb, element) {
                $(element).val(hex);
                $(element).ColorPickerHide();
            },
            onBeforeShow:function () {
                $(this).ColorPickerSetColor(this.value);
            }
        })
    },

    save:function () {
        var word = $("#word").val();

        var colors = Array();
        $(".controls > .color").each(function () {
            var color = $(this).val();
            colors.push(color);
        });

        $("#form").attr("action", "/admin/moodword/create/" + word + "/" + JSON.stringify(colors));
        $("#form").submit();
    }
};
$(document).ready(function (event) {
    Moodword.init();
});