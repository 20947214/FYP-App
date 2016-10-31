
$(function () {
	

	$('#month').text(getMonth(getUrlParameter('month')) + ' ' + getUrlParameter('year'));
	
    $.getJSON('fetch/heat.php?item=' + getUrlParameter('item') + '&year=' + getUrlParameter('year') + '&month=' + getUrlParameter('month'), function (data) {
        // Create the chart
        var chart = Highcharts.chart('visual',{

			chart: {
				type: 'heatmap',
				marginTop: 40,
				marginBottom: 80,
				plotBorderWidth: 1
			},


			title: {
				text: 'Power Consumption'
			},

			xAxis: {
				categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
			},

			yAxis: {
				categories: ['','','','','','','','',''],
				title: null,
				reversed: true
			},

			colorAxis: {
				min: 0,
				minColor: '#FFFFFF',
				maxColor: Highcharts.getOptions().colors[0]
			},
			
			credits: {
				enabled: false
			},

			legend: {
				align: 'center',
				margin: 0,
				verticalAlign: 'bottom',
				y: 20,
				symbolHeight: 15,
				symbolWidth: 250
			},

			tooltip: {
				formatter: function () {
					return "<b>" + data[this.point.index][3] + '</b><br><b>' +
						this.point.value + '</b> Wh Consumed<br>';
				}
			},
			
			plotOptions:{
                series:{
                    allowPointSelect: true,
					cursor: 'pointer',
                    point: {
                        events:{
                            click: function(e) {
								$(location).attr('href', 'timeseries?item=' + getUrlParameter('item') + '&date=' + data[e.point.index][3])
                            }
                        }
                    }
                }
            },
			
			series: [{
				name: 'Sales per employee',
				borderWidth: 1,
				data: data,
				dataLabels: {
					enabled: true,
					color: '#000000'
				}
			}],

			
			responsive: {
				rules: [{
					condition: {
						minWidth: 768
					},
					// Make the labels less space demanding on mobile
					chartOptions: {
						xAxis: {
							categories: ['Sunday', 'Monday', 'Tuesday',
							'Wednesday', 'Thursday', 'Friday', 'Saturday']
						}
					}
				}]
			}
			
		});
		

		
    });


	
});

function getMonth(month){
	var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
	return months[month-1];
}

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

function prevMonth() {
	if (getUrlParameter('month') != 1) {
		prevM = getUrlParameter('month') - 1;
		yr = getUrlParameter('year');
	} else {
		prevM = 12;
		yr = getUrlParameter('year') - 1;
	}
	
	window.location.replace("heat?item=" + getUrlParameter('item') + "&year=" + yr + "&month=" + prevM);
}

function nextMonth() {
	if (getUrlParameter('month') != 12) {
		nextM = parseInt(getUrlParameter('month')) + 1;
		yr = getUrlParameter('year');
	} else {
		nextM = 1;
		yr = parseInt(getUrlParameter('year')) + 1;
	}
	
	window.location.replace("heat?item=" + getUrlParameter('item') + "&year=" + yr + "&month=" + nextM);
}
