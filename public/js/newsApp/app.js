var newsApp = angular.module('newsApp', []);

newsApp.config(['$interpolateProvider', function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}]);


newsApp.controller('newsAppController', ['$scope', '$http', function($scope, $http) {

		$scope.title = "Hello";
		$scope.feed = [];
		var yqlURL = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20rss(0%2C5)%20where%20url%3D'http%3A%2F%2Famericanshipper.com%2Ffeed.aspx%3Fsn%3DASDaily'&format=json&callback=";
	   

		$http.get(yqlURL)

		.success(function(data, status, headers, config) {
	    	//console.log("success data, status="+ JSON.stringify(data) + status);
	    	if(data.query.results == null) {
	    		console.log("No Valid Results could be Returned!!")
	    	}
	    	else {

	    		$.each(data.query.results.item, function() {
	    			console.log(this);
	    			$scope.feed.push(this);

	    		});	   
	    	}
	    })

		.error(function(data, status, headers, config) {
			var err = status + ", " + data;
			$scope.result = "Request failed: " + err;
		});
		
	}]);