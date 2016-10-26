var stockQuoteApp = angular.module('stockQuoteApp', []);

stockQuoteApp.config(['$interpolateProvider', function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}]);

stockQuoteApp.controller('appController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout) {

	$scope.title = 'Stock Quotes';

	var url = 'http://query.yahooapis.com/v1/public/yql';
	var symbol = "'JBHT', 'EXPD', 'UPS', 'FDX', 'CHRW', 'MAERSK-B'";
	var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in (" +symbol+ ")");

	var str1 = url.concat("?q=",data);
	str1=str1.concat("&format=json&diagnostics=true&env=http://datatables.org/alltables.env");

	$scope.result = [];

	$scope.reload = function() {
		$scope.tempresult = [];

		$http.get(str1)

		.success(function(data, status, headers, config) {
	    	//console.log("success data, status="+ JSON.stringify(data) + status);
	    	if(data.query.results == null) {
	    		console.log("No Valid Results could be Returned!!")
	    	}
	    	else {

	    		$.each(data.query.results.quote, function() {
	    			
	    			$scope.tempresult.push({
	    				"ticker": this.Symbol,
	    				"name": this.Name,
	    				"currency": this.Currency,
	    				"bid": this.LastTradePriceOnly,
	    				"cap": this.MarketCapitalization,
	    				"change": this.PercentChange
	    			});

	    		});
	    		
	    		
	    		$scope.result = $scope.tempresult;
	    	}
	    })

		.error(function(data, status, headers, config) {
			var err = status + ", " + data;
			$scope.result = "Request failed: " + err;
		});

		$timeout(function() {
			$scope.reload();		
		}, 20000)
	};

	

	$scope.reload();
	

}]);