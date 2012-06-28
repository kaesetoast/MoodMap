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

	search : function() {
        // calculate position off searchFieldWrapper and translate it to array-index
        var index = ($("#searchFieldWrapper").offset().top - 40) / 60 % 6;
        var keyword = $("#searchFieldInput").val();

        // colors[index] via post-call
        $.post("/getmapcolors", function(colors) {
            $("#searchForm").attr("action", "/map/search/" + colors[index] + "/" + keyword);
            $("#searchForm").submit();
        });
	}
};
$('#page').live('pagecreate',function(event){
	Map.init();
});