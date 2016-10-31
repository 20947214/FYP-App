
$(function () {
	var names = ["Front TV", "Stereo"];
	$.getJSON('fetch/items.php', function (data) {
		
		for (i=0; i < data.length; i++) {
			$("#items").append("<div class='itemrow'>" + '<button onclick="itemDirect(' + "'" + data[i] + "'" +');" type="button" class="btn btn-default btn-lg btn-block">'
			+ "<div class='item'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>"
			+ $("#item"+i).text() + "</div></button></div>");
	
		}
	});
	
	
});

function itemDirect(item) {
	window.location.href = "item?item=" + item;
}



/*
function turnOn() {
	
	
	
	$.ajax({
    type: "POST",
    url: "127.0.0.1:8080/basicui/rest/items/wemo_insight_Insight_1_0_221537K1200284_state",
    data: "off",
    headers: {
      "Content-Type": "text/plain"
    }
	});
	
	$("#test").text("hello");

}*/