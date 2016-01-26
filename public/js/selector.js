$(document).ready(function(e){
	$(".top-product").on("click", "button.add-products", function() {
		var product = $(this).closest(".top-product");
		$(product).find("#ingredients-list").slideUp("slow");
		$(product).find(".show-product").removeClass("disabled");
		$(product).find(".selector").slideDown("slow");
		$(this).addClass("disabled");
	});

	$(".top-product").on("click", "button.show-product", function() {
		var product = $(this).closest(".top-product");
		$(product).find("#ingredients-list").slideDown("slow");
		$(product).find(".add-products").removeClass("disabled");
		$(this).addClass("disabled");
		$("html, body").animate({
			scrollTop: $(product).offset().top
		}, 1000);
	});

	$(".top-product").on("click", "button.remove-product", function(){
		var product = $(this).closest(".top-product");
		$("body").addClass("animated bounce infinite");
		setTimeout(function(){$(product).find(".product-overview").addClass("animated hinge");}, 1000);
		setTimeout(function(){$(product).find(".selector").addClass("animated hinge");}, 1500);
		setTimeout(function(){$(".product-overview").addClass("animated hinge");}, 2000);
		setTimeout(function(){$("#footer-order-cta").addClass("animated hinge");}, 2500);
		setTimeout(function(){$("#footer-menu").addClass("animated hinge");}, 3000);
		setTimeout(function(){$("body").removeClass("animated bounce infinite").addClass("animated hinge");}, 3500);
	});

	$(".top-product").on("click", "button.edit-amount", function() {
		var product = $(this).closest(".top-product");
		$(product).find(".selector").removeClass("disabled");
		$(product).find(".selector .ribbon").hide("slow");
		$(product).find(".product-overview").slideDown("slow");
		$(product).find(".confirm-amount").show();
		$(product).find(".edit-amount").hide();
		$(product).find(".selector img" ).each(function() {
			$(this).addClass("svg");
		});
		$(product).find(".add-products").addClass("remove-product").html("Verwijderen").removeClass("add-products");
	});

	$(".top-product").on("click", "button.confirm-amount", function() {
		var product = $(this).closest(".top-product");
		$("body").css("cursor", "progress");
		$(product).find("#loading-icon").show();
		$(product).find(".confirm-amount").addClass("disabled");
		$(product).find(".price").addClass("disabled");
		$(product).find(".selector").addClass("disabled");

		$.ajax({
			url: 'bestelling',
			type: 'POST',
			beforeSend: function (xhr) {
				var token = $("meta[name='csrf-token']").attr("content");
				if (token) {
					return xhr.setRequestHeader("X-CSRF-TOKEN", token);
				}
			},
			data: $(product).find("form").serialize(),
			dataType: 'JSON',
			success: function (data) {
				var total_amount = 0;

				$("body").css("cursor", "auto");				
				$("input[name='amount']").each(function(){
					total_amount += parseInt($(this).val());
				});
				$(product).find("#loading-icon").hide();
				$(product).find(".product-overview").slideUp("slow");
				$(product).find(".selector .ribbon").show("slow");
				$(product).find(".selector .confirm-amount").removeClass("disabled").hide();
				$(product).find(".selector .price").removeClass("disabled");
				$(product).find(".selector .edit-amount").show();
				$(product).find(".selector .svg" ).each(function() {
					$(this).removeClass("svg");
				});
				$("#total-meal strong").html(total_amount);
				$("#total-meal").removeClass("animated fast pulse").addClass("animated fast pulse");
				$("#footer-order-cta .button").removeClass("disabled animated fast pulse").addClass("animated fast pulse");
				$(product).find(".add-products").addClass("remove-product").html("Verwijderen").removeClass("add-products disabled");
			}, error: function() {
				$("body").css("cursor", "auto");
				location.reload(true);
			}
		});				
	});

	$(".selector").on("click", ".svg", function(e) {
		var product = $(this).closest(".top-product");
		var amount = $(this).attr("id");
		amount = amount.replace("amount_", "");
		var i = 1;
		
		$(product).find("form input[name$='amount']").val(amount);

		$(product).find(".selector .svg" ).each(function() {
			$(this).removeClass("selected");
		});
		
		while(i <= amount){
			$(product).find(".selector #amount_"+i).addClass("selected");
			i++;
		}
	});
});