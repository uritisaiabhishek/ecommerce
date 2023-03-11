/*scrolling banner*/
(function ($) {
	"use strict";
	$(document).ready(function () {
		$("#main_carosel").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 3000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},

				600: {
					items: 1,
				},

				1024: {
					items: 1,
				},

				1366: {
					items: 1,
				},
			},
		});
	});

	$(document).ready(function () {
		$("#new_Arrivals").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 7000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},

				600: {
					items: 3,
				},

				1024: {
					items: 4,
				},

				1366: {
					items: 4,
				},
			},
		});
	});

	$(document).ready(function () {
		$("#carousel").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 7000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},

				600: {
					items: 3,
				},

				1024: {
					items: 4,
				},

				1366: {
					items: 4,
				},
			},
		});
	});
	$(document).ready(function () {
		$("#categories").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 7000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},

				600: {
					items: 3,
				},

				1024: {
					items: 4,
				},

				1366: {
					items: 4,
				},
			},
		});
	});
	$(document).ready(function () {
		$("#blog_carosel").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 7000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},

				600: {
					items: 3,
				},

				1024: {
					items: 4,
				},

				1366: {
					items: 4,
				},
			},
		});
	});
	$(document).ready(function () {
		$("#clients_carousel").owlCarousel({
			autoplay: true,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 3000,
			smartSpeed: 800,
			nav: false,
			responsive: {
				0: {
					items: 3,
				},

				600: {
					items: 4,
				},

				1024: {
					items: 6,
				},

				1366: {
					items: 6,
				},
			},
		});
	});
	$(document).ready(function () {
		$("#product_images_carosel").owlCarousel({
			autoplay: false,
			rewind: false /* use rewind if you don't want loop */,
			loop: true,
			margin: 20,
			responsiveClass: true,
			autoHeight: true,
			autoplayTimeout: 7000,
			smartSpeed: 800,
			nav: true,
			responsive: {
				0: {
					items: 4,
				},

				600: {
					items: 4,
				},

				1024: {
					items: 4,
				},

				1366: {
					items: 4,
				},
			},
		});
	});
})(jQuery);

function send_message() {
	var name = jQuery("#name").val();
	var email = jQuery("#email").val();
	var mobile = jQuery("#mobile").val();
	var subject = jQuery("#subject").val();
	var message = jQuery("#message").val();
	var is_error = "";

	if (name == "") {
		alert("Please enter name");
	} else if (email == "") {
		alert("Please enter email");
	} else if (mobile == "") {
		alert("Please enter mobile");
	} else if (subject == "") {
		alert("Please enter subject");
	} else if (message == "") {
		alert("Please enter message");
	} else {
		jQuery.ajax({
			url: "send_message.php",
			type: "post",
			data:
				"name=" +
				name +
				"&email=" +
				email +
				"&mobile=" +
				mobile +
				"&subject=" +
				subject +
				"&message=" +
				message,
			success: function (result) {
				alert(result);
			},
		});
	}
}

function get_in_touch() {
	var get_in_touch_product_id = jQuery("#get_in_touch_product_id").val();
	var get_in_touch_name = jQuery("#get_in_touch_name").val();
	var get_in_touch_mobile = jQuery("#get_in_touch_mobile").val();
	var get_in_touch_email = jQuery("#get_in_touch_email").val();
	var get_in_touch_location = jQuery("#get_in_touch_location").val();
	var get_in_touch_contact_via = jQuery("#get_in_touch_contact_via").val();
	var get_in_touch_message = jQuery("#get_in_touch_message").val();
	var is_error = "";

	if (get_in_touch_product_id == "") {
		alert("Please enter name");
	} else if (get_in_touch_name == "") {
		alert("Please enter name");
	} else if (get_in_touch_mobile == "") {
		alert("Please enter Mobile");
	} else if (get_in_touch_email == "") {
		alert("Please enter mobile");
	} else if (get_in_touch_location == "") {
		alert("Please enter location");
	} else if (get_in_touch_contact_via == "") {
		alert("please select");
	} else if (get_in_touch_message == "") {
		alert("Please enter message");
	} else {
		jQuery.ajax({
			url: "get_in_touch.php",
			type: "post",
			data:
				"get_in_touch_product_id=" +
				get_in_touch_product_id +
				"get_in_touch_name=" +
				get_in_touch_name +
				"&get_in_touch_mobile=" +
				get_in_touch_mobile +
				"&get_in_touch_email=" +
				get_in_touch_email +
				"&get_in_touch_location=" +
				get_in_touch_location +
				"&get_in_touch_contact_via=" +
				get_in_touch_contact_via +
				"&get_in_touch_message=" +
				get_in_touch_message,
			success: function (result) {
				window.location.href = "http://localhost/store/";
				// if (result == "getintouchalert") {
				// 	jQuery("#get_in_touch_alert").html(
				// 		"<div class='alert alert-warning alert-theme alert-dismissible fade show text-center d-none d-lg-block' role='alert'>Alerts about discounts or sales comes here<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"
				// 	);
				// }
			},
		});
	}
}

function user_register() {
	jQuery(".field_error").html("");
	var name = jQuery("#name").val();
	var email = jQuery("#email").val();
	var mobile = jQuery("#mobile").val();
	var password = jQuery("#password").val();
	var is_error = "";
	if (name == "") {
		jQuery("#name_error").html("Please enter name");
		is_error = "yes";
	}
	if (email == "") {
		jQuery("#email_error").html("Please enter email");
		is_error = "yes";
	}
	if (mobile == "") {
		jQuery("#mobile_error").html("Please enter mobile");
		is_error = "yes";
	}
	if (password == "") {
		jQuery("#password_error").html("Please enter password");
		is_error = "yes";
	}
	if (is_error == "") {
		jQuery.ajax({
			url: "register_submit.php",
			type: "post",
			data:
				"name=" +
				name +
				"&email=" +
				email +
				"&mobile=" +
				mobile +
				"&password=" +
				password,
			success: function (result) {
				// alert(result);
				if (result == "email_present") {
					jQuery("#email_error").html("email already exist");
				}
				if (result == "insert") {
					jQuery(".register_msg p").html("Thank you registration");
				}
			},
		});
	}
}

function user_login() {
	jQuery(".field_error").html("");
	var email = jQuery("#login_name").val();
	var password = jQuery("#login_password").val();
	var is_error = "";
	if (email == "") {
		jQuery("#login_name_error").html("Please enter email");
		is_error = "yes";
	}
	if (password == "") {
		jQuery("#login_paassword_error").html("Please enter password");
		is_error = "yes";
	}
	if (is_error == "") {
		jQuery.ajax({
			url: "login_submit.php",
			type: "post",
			data: "email=" + email + "&password=" + password,
			success: function (result) {
				// alert(result);
				if (result == "wrong") {
					jQuery(".login_msg p").html("Please enter valid login details hihi");
				}
				if (result == "deactive") {
					jQuery(".login_msg p").html("Please activate your account");
				}
				if (result == "valid") {
					window.location.href = "index.php";
				}
			},
		});
	}
}

function manage_cart(pid, type) {
	if (type == "update") {
		var qty = jQuery("#" + pid + "qty").val();
	} else {
		var qty = jQuery("#qty").val();
	}
	jQuery.ajax({
		url: "manage_cart.php",
		type: "post",
		data: "pid=" + pid + "&qty=" + qty + "&type=" + type,
		success: function (result) {
			if (type == "update" || type == "remove") {
				window.location.href = "cart.php";
			}
			jQuery(".navbar_cart_indicator").html(result);
		},
	});
}

function sort_product_drop_search(str_search, site_path) {
	var sort_product_id = jQuery("#sort_product_id").val();
	window.location.href =
		site_path + "search.php?str=" + str_search + "&sort=" + sort_product_id;
}

function sort_product_drop(cat_id, site_path) {
	var sort_product_id = jQuery("#sort_product_id").val();
	window.location.href =
		site_path + "category.php?id=" + cat_id + "&sort=" + sort_product_id;
}

function sort_product_drop_with_subcat(cat_id, sub_cat_id, site_path) {
	var sort_product_id = jQuery("#sort_product_id").val();
	window.location.href =
		site_path +
		"category.php?id=" +
		cat_id +
		"&sub_categories=" +
		sub_cat_id +
		"&sort=" +
		sort_product_id;
}

function wishlist_manage(pid, type) {
	jQuery.ajax({
		url: "wishlist_manage.php",
		type: "post",
		data: "pid=" + pid + "&type=" + type,
		success: function (result) {
			if (result == "not_login") {
				window.location.href = "login.php";
			} else {
				jQuery(".htc__wishlist").html(result);
			}
		},
	});
}

function update_profile() {
	jQuery(".field_error").html("");
	var name = jQuery("#name").val();
	if (name == "") {
		jQuery("#name_error").html("Please enter your name");
	} else {
		jQuery("#btn_submit").html("Please wait...");
		jQuery("#btn_submit").attr("disabled", true);
		jQuery.ajax({
			url: "update_profile.php",
			type: "post",
			data: "name=" + name,
			success: function (result) {
				jQuery("#name_error").html(result);
				jQuery("#btn_submit").html("Update");
				jQuery("#btn_submit").attr("disabled", false);
			},
		});
	}
}

function update_password() {
	jQuery(".field_error").html("");
	var current_password = jQuery("#current_password").val();
	var new_password = jQuery("#new_password").val();
	var confirm_new_password = jQuery("#confirm_new_password").val();
	var is_error = "";
	if (current_password == "") {
		jQuery("#current_password_error").html("Please enter password");
		is_error = "yes";
	}
	if (new_password == "") {
		jQuery("#new_password_error").html("Please enter password");
		is_error = "yes";
	}
	if (confirm_new_password == "") {
		jQuery("#confirm_new_password_error").html("Please enter password");
		is_error = "yes";
	}

	if (
		new_password != "" &&
		confirm_new_password != "" &&
		new_password != confirm_new_password
	) {
		jQuery("#confirm_new_password_error").html("Please enter same password");
		is_error = "yes";
	}

	if (is_error == "") {
		jQuery("#btn_update_password").html("Please wait...");
		jQuery("#btn_update_password").attr("disabled", true);
		jQuery.ajax({
			url: "update_password.php",
			type: "post",
			data:
				"current_password=" +
				current_password +
				"&new_password=" +
				new_password,
			success: function (result) {
				jQuery("#current_password_error").html(result);
				jQuery("#btn_update_password").html("Update");
				jQuery("#btn_update_password").attr("disabled", false);
				jQuery("#frmPassword")[0].reset();
			},
		});
	}
}
