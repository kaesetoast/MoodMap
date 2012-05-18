var Profile = {

    MapColorSquares:{
        init:function () {
            $(".selectable", "#map-colors").selectable({
                filter:"div",
                selected:Profile.MapColorSquares.selectedListener
            });

            //TODO: Diese Werte müssen aus der DB kommen
            $(".ui-selectee").css("background-color", "rgb(127, 127, 127)");

            // hover-effect for Squares
            $(".ui-selectee").mouseenter(
                function () {
                    $(this).addClass("map-colors-hover");
                }).mouseleave(function () {
                    $(this).removeClass("map-colors-hover");
                });
        },

        selectedListener:function (event, ui) {
            var bgColor = $("#" + ui.selected.id).css("background-color");

            var values = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(bgColor);
            var red = parseInt(values[2]);
            var green = parseInt(values[3]);
            var blue = parseInt(values[4]);

            Profile.MapColorPicker.updateSlider(red, green, blue);
        }
    },

    MapColorPicker:{
        init:function () {
            $("#red, #green, #blue").slider({
                orientation:"horizontal",
                range:"min",
                max:255,
                value:127,
                slide:Profile.MapColorPicker.updatePreview,
                change:Profile.MapColorPicker.updatePreview
            });
        },

        updateSlider:function (red, green, blue) {
            $("#red").slider("value", red);
            $("#green").slider("value", green);
            $("#blue").slider("value", blue);
        },

        updatePreview:function (event, ui) {
            var red = $("#red").slider("value"),
                green = $("#green").slider("value"),
                blue = $("#blue").slider("value"),
                hex = Profile.MapColorPicker.toHex(red, green, blue);
            $(".ui-selected").css("background-color", "#" + hex);
        },

        toHex:function (red, green, blue) {
            var hex = [red.toString(16), green.toString(16), blue.toString(16)];
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
    Profile.MapColorSquares.init();
    Profile.MapColorPicker.init();
});
