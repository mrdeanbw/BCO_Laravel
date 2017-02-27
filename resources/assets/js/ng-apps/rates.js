var ratesApp = angular.module('ratesApp', ['ngMaterial']);

ratesApp.config(['$interpolateProvider', function($interpolateProvider) {

	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');

}]);

ratesApp.config(function ($mdThemingProvider) {
    var customPrimary = {
        '50': '#8be7eb',
        '100': '#75e2e8',
        '200': '#60dee4',
        '300': '#4ad9e0',
        '400': '#34d5dc',
        '500': '#24CBD3',
        '600': '#20b6bd',
        '700': '#1da1a7',
        '800': '#198c92',
        '900': '#15777c',
        'A100': '#a1ebef',
        'A200': '#b7f0f3',
        'A400': '#cdf4f6',
        'A700': '#116266'
    };
    $mdThemingProvider
        .definePalette('customPrimary', 
                        customPrimary);

    var customAccent = {
        '50': '#0b0c0c',
        '100': '#171919',
        '200': '#232627',
        '300': '#2f3334',
        '400': '#3c4041',
        '500': '#484d4f',
        '600': '#606769',
        '700': '#6c7477',
        '800': '#788184',
        '900': '#868e90',
        'A100': '#606769',
        'A200': '#545a5c',
        'A400': '#484d4f',
        'A700': '#939a9c'
    };
    $mdThemingProvider
        .definePalette('customAccent', 
                        customAccent);

    var customWarn = {
        '50': '#ffb280',
        '100': '#ffa266',
        '200': '#ff934d',
        '300': '#ff8333',
        '400': '#ff741a',
        '500': '#ff6400',
        '600': '#e65a00',
        '700': '#cc5000',
        '800': '#b34600',
        '900': '#993c00',
        'A100': '#ffc199',
        'A200': '#ffd1b3',
        'A400': '#ffe0cc',
        'A700': '#803200'
    };
    $mdThemingProvider
        .definePalette('customWarn', 
                        customWarn);

    var customBackground = {
		'50': '#ffffff',
		'100': '#ffffff',
		'200': '#ffffff',
		'300': '#ffffff',
		'400': '#ffffff',
		'500': '#000000',
		'600': '#f2f2f2',
		'700': '#e6e6e6',
		'800': '#d9d9d9',
		'900': '#cccccc',
		'A100': '#ffffff',
		'A200': '#ffffff',
		'A400': '#ffffff',
		'A700': '#bfbfbf'
	};
    $mdThemingProvider
        .definePalette('customBackground', 
                        customBackground);

   $mdThemingProvider.theme('default')
       .primaryPalette('customPrimary')
       .accentPalette('customAccent')
       .warnPalette('customWarn');
       
});


ratesApp.controller('indexCtrl', ['$http', '$scope', '$log', function($http, $scope, $log) {

	$scope.ui = {
		selectedTabIndex: 0,
	}

	$scope.warning = '';

	$scope.query = {
		lcl: {
			items: [{
				description: null,
				weight: null,
				weight_uom: 'kilogram',
				length: null,
				width: null,
				height: null,
				dim_uom: 'cm',
				quantity: null
				}
			],
			services: [],
			freight_classes: [50,55,60,65,70,77.5,85,92.5,100,110,125,150,175,200,250,300,400,500]
		},
		fcl: {
			commodity: null,
			containers: [{
				quantity: null,
				weight: null,
				weight_uom: 'pound',
				type: null
				}
			]
		},
		parcel: {
			terms: null,
			packages: [{
				weight: null,
				packaging: null,
				pod: null
			}]
		},
		origin: null,
		destination: null,
		shipdate: new Date()
	};	

	$scope.results = [];

	$scope.addLCLItem = function() {
		$scope.query.lcl.items.push({
			weight_uom: 'lbs',
			dim_uom: 'in'
		});
	}

	$scope.removeLCLItem = function(index) {
		
		$scope.query.lcl.items.splice(index, 1);
	}

	$scope.addFCLContainer = function() {
		$scope.query.fcl.containers.push({
			weight_uom: 'lbs',
			type: 'DV20'
		})
	}

	$scope.removeFCLContainer = function(index) {
		
		$scope.query.fcl.containers.splice(index, 1);
	}

	$scope.populateLCLServices = function populateLCLServices() {
		$scope.query.lcl.services = [];
		var list = [
			{
				key: 'lift_gate',
				title: 'Lift gate'
			},
			{
				key: 'construction_site',
				title: 'Construction Site'
			},
			{
				key: 'hotel',
				title: 'Hotel'
			},
			{
				key: 'inside',
				title: 'Inside'
			},
			{
				key: 'limited_access',
				title: 'Limited Access'
			},
			{
				key: 'residential',
				title: 'Residential'
			},
			{
				key: 'school',
				title: 'School'
			},
			{
				key: 'appointment',
				title: 'Appointment'
			},
			{
				key: 'delivery_notification',
				title: 'Delivery Notification'
			},
			{
				key: 'shipment_overlength_12_20',
				title: 'Overlenght (12-20)'
			},
			{
				key: 'shipment_overlength_20_28',
				title: 'Overlenght (20-28)'
			},
			{
				key: 'shipment_overlengthOver_28',
				title: 'Overlenght (over 28)'
			},
			{
				key: 'sort_and_segment',
				title: 'Sort & Segment'
			}];

		for(var i = 0; i < list.length; i++) {
			var obj = list[i];
			obj['at_pickup'] = false;
			obj['at_delivery'] = false;
			alert(JSON.stringify(obj));
			$scope.query.lcl.services.push(obj);
		}
	}

	$scope.transformExKey = function(key) {
		return key.split('_').join(' ').replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	}
	

	$scope.queryRates = queryRates;
	$scope.locationQuerySearch = locationQuerySearch;

	function queryRates() {
		if(!$scope.ratesForm.$valid) { $scope.warning="There are errors in the form, please correct the highlighted fields and try again"; return;  }
		$scope.results = [];
		$scope.parcel_result = null;
		$scope.ratesForm.$busy = true;
		switch($scope.ui.selectedTabIndex) {
			case 0:
				queryFCL();
				break;
			case 1: 
				queryLTL();
				break;
			case 2: 
				queryParcel();
				break;
			default: 
				break;
		}
	}

	function queryLTL() {
		$scope.warning = '';
		var query = $scope.query;

		var payload = {			
			pickup: query.origin.code,
			delivery: query.destination.code,
			ship_day: query.shipdate.toDateString(),
			accessorials: [],
			freight_class: query.lcl.freightclass,			
			items: [],
			us_domestic: query.origin.us_domestic && query.destination.us_domestic
		}

		for(var i = 0; i < query.lcl.items.length; i++) {
			var item = query.lcl.items[i];
			payload.items.push({
				description: item.description,
				quantity: item.quantity,
				weight: {
					unit: item.weight_uom,
					value: item.weight
				},
				length: {
					unit: item.dim_uom,
					value: item.length
				},
				width: {
					unit: item.dim_uom,
					value: item.width
				},
				height: {
					unit: item.dim_uom,
					value: item.height
				}
			});
		}

		$http.post('/members/rates/ltl', payload).then(function(successResponse) {
			$scope.results = successResponse.data.routes;
			if($scope.results.length == 0) {
				$scope.warning = 'No rates found...';
			} 
			$scope.ratesForm.$busy = false;
		}, function(errorResponse) {
			$scope.warning = 'Something went wrong processing your request, please try again later or contact an administrator.';
			$scope.ratesForm.$busy = false;
		});

	}


	function queryFCL() {
		$scope.warning = '';
		var query = $scope.query;

		var payload = {
			pickup: query.origin.code,
			delivery: query.destination.code,
			ship_day: query.shipdate.toDateString(),
			containers: []
		}

		for (var i = 0; i < query.fcl.containers.length; i++) {
			var ctr = query.fcl.containers[i];

			payload.containers.push({
				commodity: query.fcl.commodity,
				number: ctr.quantity.toString(),
				size: ctr.type,
				weight: {
					unit: ctr.weight_uom,
					value: ctr.weight
				}
			})
		}

		$http.post('/members/rates/fcl', payload).then(function(successResponse) {
			$scope.results = successResponse.data.routes;	
			if($scope.results.length == 0) {
				$scope.warning = 'No rates found...';
			}
			$scope.ratesForm.$busy = false;		
		}, function(errorResponse) {
			$scope.warning = 'Something went wrong processing your request, please try again later or contact an administrator.';
			$scope.ratesForm.$busy = false;
		});

	}

	function queryParcel() {
		var query = $scope.query;
		$scope.warning = '';
		
		if(!query.origin.us_domestic || !query.destination.us_domestic) {
			$scope.warning = 'Currently only US Domestic locations are supported for parcel rates, please select a different origin / destination.';
			$scope.ratesForm.$busy = false;
			return ;
		}

		var payload = {
			from: query.origin,
			to: query.destination,
			ship_day: query.shipdate.toDateString(),
			terms: query.parcel.terms,
			packages: []
		}

		for (var i = 0; i < query.parcel.packages.length; i++) {
			var pkg = query.parcel.packages[i];

			payload.packages.push({
				Weight: pkg.weight,
				Packaging: pkg.packaging,
				POD: pkg.pod
			});
		}

		$http.post('/members/rates/parcel', payload).then(function(successResponse) {
			$scope.ratesForm.$busy = false;
			$scope.parcel_result = successResponse.data;

			if(!$scope.parcel_result.success) {
				$scope.warning = $scope.parcel_result.error;				
				$scope.parcel_result = null;
				return;
			}

			if($scope.parcel_result.rate.total_price == 0) {
				$scope.warning = "No rate found...";
				$scope.parcel_result = null;
				return;
			}

		}, function(errorResponse) {
			$scope.warning = 'Something went wrong processing your request, please try again later or contact an administrator.';
			$scope.ratesForm.$busy = false;
		});
	}


	function locationQuerySearch(query) {
		
		return $http.get('/members/rates/locations', {params: {query: query}})
		.then(function(response) {
			return response.data;
		});		
	}

}]);