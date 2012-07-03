var Recommendation = {
	init: function() {
		Recommendation.replaceTagInput();
	},

	replaceTagInput: function() {
		var dropDown = $("#moodmap_mapbundle_recommendationtype_tags");
		dropDown.hide();
		dropDown.after('<input type="text" id="tag-input"><div id="tag-list"></div>');
		var input = $("#tag-input");
		$(input).keyup(function(event){
			if (event.keyCode == 188) {
				var tag = $(input).val();
				tag = tag.substr(0, tag.length - 1)
				$("#tag-list").append('<span style="margin-right: 3px" class="label label-info">' + tag + '</span>');
				$(input).val("");
				$.post("/admin/tagtoid/" + tag, function(data) {
					if (data.isNew) {
						$(dropDown).append('<option selected="selected" value="' + data.id + '">' + data.name + '</option>');
					} else {
						$("option[value='" + data.id + "']").attr("selected", "selected");
					}
				});
			}
		});
	}
}
$(document).ready(function(){
	Recommendation.init();
});