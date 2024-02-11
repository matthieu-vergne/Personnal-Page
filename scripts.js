const toggleMap = new Map();
function toggle(...ids) {
	for (var id of ids) {
		var style = document.getElementById(id).style;
		if (style.display !== "none") {
			toggleMap.set(id, style.display);
			style.display = "none";
		} else {
			style.display = toggleMap.get(id);
		}
	}
}