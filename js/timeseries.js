$(function () {
	
	$('#day').text(getUrlParameter('date'));
	
	$.getJSON('fetch/facts.php?item=' + getUrlParameter('item') + '&date=' 
								+ getUrlParameter('date'), function (data) {
		if (data[1] != -1) {
		$("#facts").append('<div class="fact">' + data[1] +
							' power consumed than an average ' + data[0] + '</div>');
		}
		$("#facts").append('<div class="fact">Cost approximately $' 
							+ data[2] + '</div>');
    });
	
    $.getJSON('fetch/time.php?item=' + getUrlParameter('item') + '&date=' + getUrlParameter('date'), function (data) {
        // Create the chart
        $('#visual').highcharts('StockChart', {
            rangeSelector: {
                selected: 3,
				buttons: [{
					type: 'hour',
					count: 1,
					text: '1H'
				}, {
					type: 'hour',
					count: 6,
					text: '6H'
				}, {
					type: 'hour',
					count: 12,
					text: '12H'
				}, {
					type: 'all',
					text: 'All'
				}],
				buttonTheme: {
					width: 50
				},
				inputEnabled: false,
			},	
			credits: {
				enabled: false
			},

            title: {
                text: 'Power Usage'
            },
            series: [{
                name: 'Power (W)',
                data: data,
                tooltip: {
                    valueDecimals: 0
                }
            }]
        });
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

/*
function prevDay() {
	var date = getUrlParameter('date').split("-");
	if (getUrlParameter('month') != 1) {
		prevM = getUrlParameter('month') - 1;
		yr = getUrlParameter('year');
	} else {
		prevM = 12;
		yr = getUrlParameter('year') - 1;
	}
	
	window.location.replace("timeseries?item=" + getUrlParameter('item') + "&date=" + yr + "-" + mo + "-" + da);
}

function nextDay() {
	if (getUrlParameter('month') != 12) {
		nextM = parseInt(getUrlParameter('month')) + 1;
		yr = getUrlParameter('year');
	} else {
		nextM = 1;
		yr = parseInt(getUrlParameter('year')) + 1;
	}
	
	window.location.replace("timeseries?item=" + getUrlParameter('item') + "&date=" + yr + "-" + mo + "-" + da);
}
*/