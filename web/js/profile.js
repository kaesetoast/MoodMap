var Profile = {

    Selectable:{
        init:function () {
            $(".selectable", "#map-colors").selectable({
                filter:"div"
            });
        }
    },

    ColorPicker:{
        init:function () {
            /*
             * TODO: Diese Werte müssen aus der DB kommen
             */
            $(".ui-selectee").css("background-color", "rgb(127, 127, 127)");
            $("#red, #green, #blue").slider({
                orientation:"horizontal",
                range:"min",
                max:255,
                value:127,
                slide:Profile.ColorPicker.updatePreview,
                change:Profile.ColorPicker.updatePreview
            });
        },

        updatePreview:function (event, ui) {
            var red = $("#red").slider("value"),
                green = $("#green").slider("value"),
                blue = $("#blue").slider("value"),
                hex = Profile.ColorPicker.toHex(red, green, blue);
            $(".ui-selected").css("background-color", "#" + hex);
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
}

$(document).ready(function () {
    Profile.Selectable.init();
    Profile.ColorPicker.init();
});
