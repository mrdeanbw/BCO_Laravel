var newsApp = angular.module('newsApp', []);

newsApp.config(['$interpolateProvider', function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}]);


newsApp.controller('newsAppController', ['$scope', '$http', function($scope, $http) {

		$scope.title = "Hello";
		$scope.feed = [];
		var yqlURL = "https://query.yahooapis.com/v1/public/yql?q=select * from rss(0,5) where url='http://americanshipper.com/feed.aspx?sn=ASDailyShippersLogistics'&format=json&callback=";
	   

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