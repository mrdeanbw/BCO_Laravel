//Hello
$(document).ready(function() {
	var ctx = document.getElementById("myChart");
	
	var myChart = new Chart(ctx, {
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
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)'
	            ],
	            borderColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)'
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	        	xAxes: [{
	                stacked: true
	        	}],
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true,
	                    min: 0,
	                    max: 60
	                },
	                stacked: true
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

	$('#btn-show-savings').click(function() {
		$('#myChart').height = 300;
		$('#myChart').width = 300;
		$('#savings-expander .container').animate({'height': '400px', 'padding': '30px'}, 200);
	});

	$('#btn-show-savings-close').click(function() {
		$('#savings-expander .container').animate({'height': 0, 'padding': '0px'}, 200);
	})
});

