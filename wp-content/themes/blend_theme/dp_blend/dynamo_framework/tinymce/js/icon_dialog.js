function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertIcon() {
	
	var shortcodeText;
	var size = document.getElementById('dp_icon_boxes_size').value;
	var badge = document.getElementById('dp_icon_boxes_badge').value;
	var badgecolor = document.getElementById('badge_bg').value;
	var iconcolor = document.getElementById('icon_color').value;
	var icon =  document.getElementById('dp_icon_boxes_icon').value;
	if (icon == '') icon = 'icon-wordpress';
		shortcodeText = "[icon size='"+badge+"' color='"+iconcolor+"' icon='"+icon+"' ";
		shortcodeText = shortcodeText +"]";		
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	return;
}
