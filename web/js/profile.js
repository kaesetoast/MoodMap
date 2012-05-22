var Profile = {

    MapColorSquares:{
        init:function () {
            $("#map-colors > .selectable").selectable({
                filter:"div",
                selected:Profile.MapColorSquares.selectedListener
            });

            // Farben aus der DB
            $.post("/getmapcolors", function (mapColors) {
                console.log(mapColors);

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
            $("#red > .ui-slider-handle",
                "#green > .ui-slider-handle",
                "#blue > .ui-slider-handle").bind("touchmove", Profile.MapColorPicker.updateSliderHandle);
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

        /* iPad-Optimierung
         * @author Lars Ebert
         * http://www.advitum.de/blog/2011/09/nutzeroberflachen-furs-ipad-jquery-ui-slider/ [Stand 21.05.2012]
         * TODO: Testen!!
         */
        updateSliderHandle:function (event, ui) {
            // x- und y-Position des Fingers, jQuery unterstützt diese Eigenschaft noch nicht, deshalb brauchen wir das Original-Event
            var e = event.originalEvent;

            // Position des Sliders
            var left = $(ui).parent().offset().left;
            var right = left + $(ui).parent().width();

            // Minimaler und maximaler Wert des Sliders
            var min = $(ui).parent().slider('option', 'min');
            var max = $(ui).parent().slider('option', 'max');

            // Mithilfe von einfachem Dreisatz können wir berechnen, welchen Wert die neue Position ergibt
            var newvalue = min + (e.touches.item(0).clientX - left) / (right - left) * (max - min);

            // Jetzt setzen wir den neuen Wert
            $(ui).parent().slider('value', newvalue);
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
    },

    setMapColors:function () {
        var mapColors = new Array();

        //TODO: hart?
        for (var i = 0; i < 6; i++) {
            var bgColor = $("#preview" + i).css("background-color");

            var values = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(bgColor);
            var red = parseInt(values[2]);
            var green = parseInt(values[3]);
            var blue = parseInt(values[4]);

            mapColors.push(Profile.MapColorPicker.toHex(red, green, blue));
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
