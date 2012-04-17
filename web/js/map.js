Map = {
	init : function() {
		$("#searchFieldWrapper").draggable({
			grid : [ 60, 60 ],
			stop: function(event, ui) {
				Map.getColor();
			}
		});
	},
	
	colors: ["violet", "red", "orange", "yellow", "green", "blue"],
	
	getColor: function() {
		var offset = $("#searchFieldWrapper").offset().top + 3;
		return Map.colors[offset/60];
	}
};
$(document).ready(function() {
	Map.init();
});