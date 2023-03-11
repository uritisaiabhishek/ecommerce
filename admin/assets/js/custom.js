var total_image = 1;
function add_more_images() {
	total_image++;
	var html =
		'<div id="add_image_box_' +
		total_image +
		'"><input type="file" name="product_images[]" class="form-select"><button type="button" onclick=remove_image("' +
		total_image +
		'")>remove</button></div>';
	jQuery("#image_box").after(html);
}

function remove_image(id) {
	jQuery("#add_image_box_" + id).remove();
}
