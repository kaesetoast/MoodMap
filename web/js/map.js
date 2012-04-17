Map = {
	init : function() {
		$("#searchFieldWrapper").draggable({
			grid : [ 60, 60 ],
			stop : function(event, ui) {
				Map.search();
			}
		});
	},

	colors : [ "violet", "red", "orange", "yellow", "green", "blue" ],

	getColor : function() {
		var offset = $("#searchFieldWrapper").offset().top + 3;
		return Map.colors[offset / 60];
	},

	search : function() {
		var keyword = $("#searchFieldInput").val();
		$.post("/map/search/" + Map.getColor() + "/" + keyword, function (result) {
			console.log(result);
		});
	}
};
$(document).ready(function() {
	Map.init();
});