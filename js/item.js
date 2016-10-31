
var dd, mm, yyyy, today;

$(function () {
	
	var todayDate = new Date();
	dd = todayDate.getDate();
	mm = todayDate.getMonth()+1;
	yyyy = todayDate.getFullYear();
	
	if(dd<10){
		dd='0'+dd
	} 
	if(mm<10){
		mm='0'+mm
	} 
	today = yyyy+'-'+mm+'-'+dd;
	
	$.getJSON('fetch/settings.php?item=' + getUrlParameter('item'), function (data) {
		$("#stats iframe").attr("src","http://raspberrypi:8080/basicui/app?w="+data[0][0]+"&sitemap=_default");
		//$("#stats iframe").attr("src","http://raspberrypi:8080/basicui/app?w="+"0000"+"&sitemap=_default");

		$("#itemtitle").text(data[0][1]);
		
    });
	
	$("#updatename").attr("action","fetch/updatename.php?item="+getUrlParameter('item'));
	
	$("#compareItem").attr("value",getUrlParameter('item'));
	
	$(".container").append('<button onclick="compute();" type="button" class="btn btn-default btn-lg btn-block">'
			+ "<div class='item'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>Compute Rules</div></button>");
	
	$(".container").append('<button onclick="heatDirect();" type="button" class="btn btn-default btn-lg btn-block">'
			+ "<div class='item'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>Power Usage Calendar</div></button>");
	
	$(".container").append('<button onclick="dayDirect();" type="button" class="btn btn-default btn-lg btn-block">'
			+ "<div class='item'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>Today's Power Usage</div></button>");
			
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

function heatDirect() {
	window.location.href = "heat?item=" + getUrlParameter('item') + "&year=" + yyyy + "&month=" + mm;
}

function dayDirect() {
	window.location.href = "timeseries?item=" + getUrlParameter('item') + "&date=" + today;
}

function compute() {
	window.location.href = "rule?item=" + getUrlParameter('item');
}

function refresh() {
	window.location.href = "http://raspberrypi/app/item?item=wemo_insight_Insight_1_0_221537K1200284";
}