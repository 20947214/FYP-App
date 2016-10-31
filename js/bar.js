$(function () {
	
	$('#day').text("Power Consumption of Similar TVs");
	
    $.getJSON('fetch/bar.php?item=' + getUrlParameter('item') + '&size=' + getUrlParameter('size'), function (data) {
        
		var categories = [];
		var bardata = [];
		var size = [];
		var screen = [];
		var j = 0;
		var added = 0;
		var k = 7;
		if (Math.floor(data.length)<7) {
			k = Math.floor(data.length);
		}
		
		for (i=0; i<Math.floor((k-1)*data.length/k); i=i+Math.floor(data.length/k)) {
			
			if (data[data.length-1][4]<data[i][4] && added == 0) {
				categories[j] = data[data.length-1][0] + " " + data[data.length-1][1];
				bardata[j] = data[data.length-1][4];
				size[j] = data[data.length-1][2];
				screen[j] = data[data.length-1][3];
				j++;
				added = 1;
			}
			categories[j] = data[i][0] + " " + data[i][1];
			bardata[j] = data[i][4];
			size[j] = data[i][2];
			screen[j] = data[i][3];
			j++;
		}
		if (data[data.length-1][4]<data[data.length-2][4] && added == 0) {
			categories[j] = data[data.length-1][0] + " " + data[data.length-1][1];
			bardata[j] = data[data.length-1][4];
			size[j] = data[data.length-1][2];
			screen[j] = data[data.length-1][3];
			j++;
			categories[j] = data[data.length-2][0] + " " + data[data.length-2][1];
			bardata[j] = data[data.length-2][4];
			size[j] = data[data.length-2][2];
			screen[j] = data[data.length-2][3];
			added = 1;
		} else {
			categories[j] = data[data.length-2][0] + " " + data[data.length-2][1];
			bardata[j] = data[data.length-2][4];
			size[j] = data[data.length-2][2];
			screen[j] = data[data.length-2][3];
			j++;
			if (added == 0) {
				categories[j] = data[data.length-1][0] + " " + data[data.length-1][1];
				bardata[j] = data[data.length-1][4];
				size[j] = data[data.length-1][2];
				screen[j] = data[data.length-1][3];
			}
		}
		
		
		
        $('#visual').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: null
        },

        xAxis: {
            categories: categories,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            labels: {
                overflow: 'justify'
            },
			title: {
                text: null
            }
        },
        tooltip: {
            valueSuffix: ' W',
			formatter: function () {
					return categories[this.point.index] + '<br>' +
					'Screen Size: <b>' + size[this.point.index] + ' </b>cm<br>' +
					'Screen Type: <b>' + screen[this.point.index] + ' </b><br>' +
					'Power Consumption: <b>' +	bardata[this.point.index] + '</b> W<br>';
			}
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },

        credits: {
            enabled: true,
			href: "http://reg.energyrating.gov.au/comparator/product_types/",
			text:"Data from energyrating.gov.au"
        },
        series: [{
            name: 'Power consumption',
            data: bardata
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

