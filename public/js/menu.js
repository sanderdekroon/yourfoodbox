$(document).ready(function(){
	$("#city-selection").on("click", function(){
		$("#city-selection-overlay").removeClass("animated slideOutDown");
		$("#city-selection-overlay").addClass("animated slideInUp opened").css('visibility', 'visible');
	});

	$(".close-city-overlay").on("click", function(){
		$("#city-selection-overlay").removeClass("animated slideInUp opened");
		$("#city-selection-overlay").addClass("animated slideOutDown");
	});

	$("#total-meal").on("click", function(){
		$("#total-meal-overlay").removeClass("animated slideOutDown");
		$("#total-meal-overlay").addClass("animated slideInUp opened").css('visibility', 'visible');
	});

	$(".close-meal-overlay").on("click", function(){
		$("#total-meal-overlay").removeClass("animated slideInUp opened");
		$("#total-meal-overlay").addClass("animated slideOutDown");
	});

	$("#menu-button").on("click", function(){
		$("#main-menu").removeClass("animated slideOutRight");
		$("#main-menu").addClass("animated slideInRight opened").css('visibility', 'visible');
	})

	$(".close-menu").on("click", function(){
		$("#main-menu").removeClass("animated slideInRight opened");
		$("#main-menu").addClass("animated slideOutRight");
	})

	$(document).on("mouseup touchend", function (e){
		var container = $(".opened");
		if(container) {
			if (!container.is(e.target) 
			&& container.has(e.target).length === 0) {
				if((container).attr('id') == 'main-menu'){
					$(".close-menu").trigger("click");
				} else {
					$(container).removeClass("animated slideInUp opened");
					$(container).addClass("animated slideOutDown");
				}
						
			}
		}
	});



});