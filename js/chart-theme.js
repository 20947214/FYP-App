

Highcharts.theme = {
	colors: ['#2b908f', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
    chart: {
        backgroundColor: null,
    },
    title: {
        style: {
            color: '#E0E0E3',
            font: '16px "Hind", Verdana, sans-serif'
        }
    },
    subtitle: {
        style: {
            color: '#E0E0E3',
            font: 'bold 12px "Hind", Verdana, sans-serif'
        }
    },
	xAxis: {
		labels:{
			style: {
				color: '#E0E0E3',
				font: '12px "Hind", Verdana, sans-serif'
			}
		}
	},

    legend: {
        itemStyle: {
            font: '9pt "Hind", Verdana, sans-serif',
            color: '#E0E0E3'
        },
        itemHoverStyle:{
            color: '#E0E0E3'
        },
		itemHiddenStyle: {
			color: 'red'
		}
    }
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);
