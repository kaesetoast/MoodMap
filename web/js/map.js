Map = {
	init : function() {
		$("#searchFieldWrapper").draggable({
			grid : [ 60, 60 ]
		});
        $("#searchSubmit").bind("click", function(){
            Map.search();
        });
        $("#grid").css("background-image", "url(/images/map/users/" + Util.getUserId() + ".png)");
	},

	colors : [ "violet", "red", "orange", "yellow", "green", "blue" ],

	getColor : function() {
		var offset = $("#searchFieldWrapper").offset().top + 3;
		return Map.colors[offset / 60];
	},

	search : function() {
		var keyword = $("#searchFieldInput").val();
        $("#searchForm").attr("action", "/map/search/" + Map.getColor() + "/" + keyword);
        $("#searchForm").submit();
	}
};
$('#page').live('pagecreate',function(event){
	Map.init();
});