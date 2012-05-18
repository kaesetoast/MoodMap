var Profile = {

    toHex:function (r, g, b) {
        var hex = [r.toString(16), g.toString(16), b.toString(16)];
        $.each(hex, function (index, value) {
            if (value.length === 1) {
                hex[index] = "0" + value;
            }
        });
        return hex.join("").toUpperCase();
    },

    updatePreview:function () {
        var red = $("#red").slider("value"),
            green = $("#green").slider("value"),
            blue = $("#blue").slider("value"),
            hex = Profile.toHex(red, green, blue);
        $("#preview").css("background-color", "#" + hex);
    },

    init:function () {
        $("#red, #green, #blue").slider({
            orientation:"horizontal",
            range:"min",
            max:255,
            value:127,
            slide:Profile.updatePreview(),
            change:Profile.updatePreview()
        });
        $("#red").slider("value", 255);
        $("#green").slider("value", 140);
        $("#blue").slider("value", 60);
    }
}

$(document).ready(function () {
    Profile.init();
});
