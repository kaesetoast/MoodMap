var Profile = {

    MapColorSquares:{
        init:function () {
            $("#map-colors > .selectable").selectable({
                filter:"div",
                selected:Profile.MapColorSquares.selectedListener
            });

            // Farben aus der DB
            $.post("/getmapcolors", function (mapColors) {
                $.each(mapColors, function (index, value) {
                    $("#preview" + index).css("background-color", "#" + value);
                })
            });

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
            var values = Profile.MapColorPicker.parseRGBAString(bgColor);

            Profile.MapColorPicker.updateSlider(values["red"], values["green"], values["blue"]);
        }
    },

    MapColorPicker:{
        init:function () {
            $("#red, #green, #blue").bind("change", Profile.MapColorPicker.updatePreview);
        },

        updateSlider:function (red, green, blue) {
            $("#red").attr("value", red);
            $("#green").attr("value", green);
            $("#blue").attr("value", blue);

            $("#red, #green, #blue").unbind("change");
            $("#red, #green, #blue").slider("refresh");
            $("#red, #green, #blue").bind("change", Profile.MapColorPicker.updatePreview);
        },

        updatePreview:function (event, ui) {
            var red = $("#red").attr("value"),
                green = $("#green").attr("value"),
                blue = $("#blue").attr("value"),
                hex = Profile.MapColorPicker.toHex(red, green, blue);

            $(".ui-selected").css("background-color", "#" + hex);
        },

        toHex:function (red, green, blue) {
            var hex = [parseInt(red).toString(16),
                parseInt(green).toString(16),
                parseInt(blue).toString(16)];

            $.each(hex, function (index, value) {
                if (value.length === 1) {
                    hex[index] = "0" + value;
                }
            });
            return hex.join("").toUpperCase();
        },

        parseRGBAString:function (rgba) {
            var res = new Array();

            var values = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(rgba);

            res["red"] = parseInt(values[2]);
            res["green"] = parseInt(values[3]);
            res["blue"] = parseInt(values[4]);

            return res;
        }
    },

    setMapColors:function () {
        var mapColors = new Array();

        //TODO: hart?
        for (var i = 0; i < 6; i++) {
            var bgColor = $("#preview" + i).css("background-color");
            var values = Profile.MapColorPicker.parseRGBAString(bgColor);

            mapColors.push(Profile.MapColorPicker.toHex(values["red"], values["green"], values["blue"]));
        }

        $.post("/updatemapcolors", {mapcolors:mapColors}, function (data) {
            console.log(data);
        });
    }
}

$(document).ready(function () {
    Profile.MapColorSquares.init();
    Profile.MapColorPicker.init();
});
