$(document).ready(function(e){
	$("button.add-products").on("click", function() {
		var product = $(this).closest('.top-product').attr('id');
		$("div#"+product+" .selector").slideDown("slow");
		$(this).addClass('disabled');
	});

	$("button.confirm-amount").on("click", function() {
		var product = $(this).closest('.top-product').attr('id');
		

		$("body").css('cursor', 'progress');
		$("#"+product+" #loading-icon").show();
		$("#"+product+" .selector .confirm-amount").addClass("disabled");
		$("#"+product+" .selector .price").addClass("disabled");
		$("#"+product+" .selector").addClass("disabled");

		$.ajax({
			url: 'bestelling',
			type: 'POST',
			beforeSend: function (xhr) {
				var token = $('meta[name="csrf-token"]').attr('content');
				if (token) {
					return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				}
			},
			data: $('#'+product+' form').serialize(),
			dataType: 'JSON',
			success: function (data) {
				$("body").css('cursor', 'auto');

				var total_amount = 0;
				$("input[name='amount']").each(function(){
					total_amount += parseInt($(this).val());
				});
				$("#"+product+" #loading-icon").hide();
				$("#total-meal strong").html(total_amount);
				$("#total-meal").addClass("animated fast pulse");
				$("#"+product+" .product-overview").slideUp("slow");
				$("#"+product+" .selector .ribbon").show("slow");
				$("#"+product+" .selector .confirm-amount").removeClass("disabled").hide();
				$("#"+product+" .selector .price").removeClass("disabled");
				$("#"+product+" .selector .edit-amount").show();
				$( "#"+product+" .selector .svg" ).each(function() {
					$(this).removeClass("svg");
				});
				$("#footer-order-cta .button").removeClass("disabled animated fast pulse").addClass("animated fast pulse");
			}, error: function() {
				$("body").css('cursor', 'auto');
				location.reload(true);
			}
		});				
	});

	$(".selector").on("click", "button.edit-amount", function() {
		var product = $(this).closest('.top-product').attr('id');
		$("#"+product+" .selector").removeClass("disabled");
		$("#"+product+" .selector .ribbon").hide("slow");
		$("#"+product+" .product-overview").slideDown("slow");
		$("#"+product+" .selector .confirm-amount").show();
		$("#"+product+" .selector .edit-amount").hide();
		$("#"+product+" .selector img" ).each(function() {
			$(this).addClass("svg");
		});
		$("#total-meal").removeClass("animated fast pulse");
	});

	$(".selector").on("click", ".svg", function(e) {
		var product = $(this).closest('.top-product').attr('id');
		var amount = $(this).attr('id');
		amount = amount.replace("amount_", "");
		var i = 1;
		
		$('#'+product+' form input[name$="amount"]').val(amount);

		$( "#"+product+" .selector .svg" ).each(function() {
			$(this).removeClass("selected");
		});
		
		while(i <= amount){
			$("#"+product+" .selector #amount_"+i).addClass("selected");
			i++;
		}
	});
});