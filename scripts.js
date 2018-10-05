function toggle(...ids) {
	for (var id of ids) {
		var style = document.getElementById(id).style;
		if (style.display !== "none") {
			style.display = "none";
		} else {
			style.display = "inline-block";
		}
	}
}