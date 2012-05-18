var Profile = {

    init:function () {
        $("#preview").css("background-color", "rgb(127, 127, 127)");
        $("#red, #green, #blue").slider({
            orientation:"horizontal",
            range:"min",
            max:255,
            value:127,
            slide:Profile.updatePreview,
            change:Profile.updatePreview
        });
    },

    updatePreview:function (event, ui) {
        var red = $("#red").slider("value"),
            green = $("#green").slider("value"),
            blue = $("#blue").slider("value"),
            hex = Profile.toHex(red, green, blue);
        $("#preview").css("background-color", "#" + hex);
    },

    toHex:function (r, g, b) {
        var hex = [r.toString(16), g.toString(16), b.toString(16)];
        $.each(hex, function (index, value) {
            if (value.length === 1) {
                hex[index] = "0" + value;
            }
        });
        return hex.join("").toUpperCase();
    }
}

$(document).ready(function () {
    Profile.init();
});
