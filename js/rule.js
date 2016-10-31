
$(function () {
	
	$("#rules").attr("action", "fetch/activaterule.php?item=" + getUrlParameter('item'));
	var days = ['mon','tue','wed','thu','fri','sat','sun'];
	$.getJSON('fetch/grab.php?item=' + getUrlParameter('item'), function (data) {
		var toggle = "ON";
		for (i=0; i<data.length; i++) {
			if (data[i][1]!=toggle) {
				addRule(days[data[i][0]],data[i][1],data[i][2]+":00");
				if (toggle=="ON") {
					toggle = "OFF";
				} else toggle = "ON";
			}
			
		}
		$(".loader").remove();
		$("#rule").css("visibility","visible");
    });
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function addRule(day, state, time) {
	$("#" + day).append('<div class="input-group"><div class="input-group-btn">'
		+ '<select class="selectpicker" data-width="70px" name="state_'+day+'[]">'
		+ '<option value="ON" '+selected(state,'ON')+'>ON</option>'
		+ '<option value="OFF" '+selected(state,'OFF')+'>OFF</option>'
		+ '</select></div>'
		+ '<input type="time" class="form-control" placeholder="0:00" aria-label="..." name="time_'
		+ day + '[]" value="' + time + '">'
		+ '<span class="input-group-btn">'
		+ '<button onclick="$(this).parent().parent().remove();" type="button" class="btn btn-default btn-sm">'
		+ '<span class="glyphicon glyphicon-minus" aria-hidden="true" style="font-size:16px;"></span></button>'
		+ '</span>'
		+	'</div>');
	$('.selectpicker').selectpicker('refresh');
}

function selected(state,match){
	if (state==match) {
		return 'selected="selected"';
	} else 	return "";
}



