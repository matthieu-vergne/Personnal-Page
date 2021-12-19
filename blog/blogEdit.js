function resolveEntryTags(){
	Array.from(document.getElementsByTagName("entry")).forEach(entry => {
		const link = document.createElement('a');
		link.href = "entry:"+entry.id;
		link.innerHTML = entry.innerHTML != "" ? entry.innerHTML : "&lt;Title of entry "+entry.id+"&gt;";
		link.title = "Link to entry "+entry.id
		entry.parentNode.replaceChild(link, entry);
	});
}
function resolveIncludeTags(){
	Array.from(document.getElementsByTagName("include")).forEach(entry => {
		const element = document.createElement('span');
		element.innerText = "<include "+entry.getAttribute("src")+">";
		// Auto-closing tags are not well supported (treated as opening tag)
		// Insert the text before the tag to still make something visibly correct
		entry.parentNode.insertBefore(element, entry);
	});
}

document.addEventListener("DOMContentLoaded", resolveEntryTags);
document.addEventListener("DOMContentLoaded", resolveIncludeTags);
