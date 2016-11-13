//Hello
$(document).ready(function() {

	Chart.defaults.global.maintainAspectRatio = true;
	
	Chart.defaults.global.defaultFontFamily = "'Raleway', sans-serif";
	var ctx = document.getElementById("myChart").getContext("2d");
	// ctx.canvas.width = 300;
	ctx.canvas.height = 300;


	$('#btn-save').click(function() {
		var span = $('#savings-expander');

		if(span.hasClass('exp-collapsed')) {
			
			$('#savings-expander .container').animate({height: '400px', padding: '25px'}, 200);			
			$('#savings-expander').removeClass("exp-collapsed");
			
			
		} 	
		$('html,body').animate({
			scrollTop: $("#savings-expander").offset().top
		});	
		
	});

	$('#btn-save-close').click(function() {
		var span = $('#savings-expander');

		if(!span.hasClass('exp-collapsed')) {					

			$('#savings-expander .container').animate({height: '0px', padding: '0px'}, 200, function() {
				$('#savings-expander .container').animate({padding: '0px'}, 200)
			});			
			span.addClass('exp-collapsed');
			
		}		
	});

	var createChart = function(ctx) {
		return new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Parcel", "LTL", "Air", "Drayage", "Ocean"],
				datasets: [
				{

					data: [16, 14,18,5,10],
					backgroundColor: 'rgba(255,255,255,0)'
				}, {	            
					data: [40-16, 50-14, 36-18, 10-5, 25-10],
					backgroundColor: [
					'#2CF5FF',
					'#1CA9E8',
					'#24CBD3',
					'#1CE8B8',
					'#1FFF8B'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)'
					],
					borderWidth: 0
				}]
			},
			options: {
				title: {
					display: false,
					text: 'Members Save Big'
				},
				scales: {
					xAxes: [{
						stacked: true,
						gridLines: {
							display: false
						}
					}],
					yAxes: [{
						ticks: {
							beginAtZero: true,
							min: 0,
							max: 60,
							callback: function(value) {
								return value + '%'; 
							}
						},
						stacked: true,
						gridLines: {
							display: false
						}
					}]
				}, 
				tooltips: {
					enabled: false
				},
				legend: {
					display: false
				}
			}

		});
	};

	var myChart = createChart(ctx);

});

