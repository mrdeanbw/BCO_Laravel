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
			}],
			service: null,
			services: getShipstoreServices()
		},
		origin: null,
		destination: null,
		shipdate: new Date(),
		
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

	function findShipStoreCarrierCode(code) {
		for(x in $scope.query.parcel.services) {
			if($scope.query.parcel.services[x].code == code) {
				return $scope.query.parcel.services[x];
			}
		}

		return null;
	}

	function getShipstoreServices() {
		return [
 {
   "code": "ARE_API.ARE.FX.FO",
   "name": "FedEx First Overnight",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.PO",
   "name": "FedEx Priority Overnight",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.SO",
   "name": "FedEx Standard Overnight",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.2D",
   "name": "FedEx 2Day",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.ES",
   "name": "FedEx Express Saver",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.G",
   "name": "FedEx Ground",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.HDL",
   "name": "FedEx Home Delivery",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.IF",
   "name": "FedEx International First",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.IP",
   "name": "FedEx International Priority",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.IE",
   "name": "FedEx International Economy",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.IPF",
   "name": "FedEx International Priority Freight",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.IEF",
   "name": "FedEx International Economy Freight",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.UPS.1DAM",
   "name": "UPS Next Day Air Early A.M.",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.1DA",
   "name": "UPS Next Day Air",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.1DAS",
   "name": "UPS Next Day Air Saver",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.2DAM",
   "name": "UPS 2nd Day Air A.M.",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.2DA",
   "name": "UPS 2nd Day Air",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.3DS",
   "name": "UPS 3 Day Select",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.G",
   "name": "UPS Ground",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.EXAM",
   "name": "UPS Express AM",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.EX",
   "name": "UPS Express",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.EXP",
   "name": "UPS Express Plus",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.EXPD",
   "name": "UPS Expedtited",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.SAV",
   "name": "UPS Saver",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.TC",
   "name": "UPS Today Courier",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.TEX",
   "name": "UPS Today Express",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.TES",
   "name": "UPS Today Express Saver",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.TIC",
   "name": "UPS Today Inter City",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.TS",
   "name": "UPS Today Standard",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.STD",
   "name": "UPS Standard",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.WWXPD",
   "name": "UPS Worldwide Expedited",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.WWX",
   "name": "UPS Worldwide Express",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.UPS.WWXP",
   "name": "UPS Worldwide Express Plus",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.ELS.EX",
   "name": "USPS Express (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.FC",
   "name": "USPS First Class (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.LIB",
   "name": "USPS Library Mail (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.MED",
   "name": "USPS Media Mail (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.PS",
   "name": "USPS Parcel Select (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.PR",
   "name": "USPS Priority Mail (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.EXI",
   "name": "USPS Express International (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.FCI",
   "name": "USPS First Class International (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.ELS.PRI",
   "name": "USPS Priority International (Endicia)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.DHL.D",
   "name": "DHL Documents",
   "carrier": "DHL"
 },
 {
   "code": "ARE_API.ARE.DHL.WPX",
   "name": "DHL Worldwide Priority Express",
   "carrier": "DHL"
 },
 {
   "code": "ARE_API.ARE.LSO.PRIB",
   "name": "Lonestar Priority Basic",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.PRIAM",
   "name": "Lonestar Priority Early",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.PRISAT",
   "name": "Lonestar Priority Saturday",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.PRINOON",
   "name": "Lonestar Priority Noon",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.GAM",
   "name": "Lonestar Ground Early",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.G",
   "name": "Lonestar Ground Basic",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.MX",
   "name": "Lonestar Mexico",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.PRI2D",
   "name": "Lonestar Priority 2nd Day",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.LSO.PLUS",
   "name": "Lonestar Plus",
   "carrier": "LONESTAR"
 },
 {
   "code": "ARE_API.ARE.OT.G",
   "name": "OnTrac Gound",
   "carrier": "ONTRAC"
 },
 {
   "code": "ARE_API.ARE.OT.FR",
   "name": "OnTrac Palletized Freight",
   "carrier": "ONTRAC"
 },
 {
   "code": "ARE_API.ARE.OT.GLD",
   "name": "OnTrac Gold",
   "carrier": "ONTRAC"
 },
 {
   "code": "ARE_API.ARE.OT.SR",
   "name": "OnTrac Sunrise",
   "carrier": "ONTRAC"
 },
 {
   "code": "ARE_API.ARE.UPS.*",
   "name": "UPS Rateshop",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.FX.*",
   "name": "FedEx Rateshop",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.FX.2DAM",
   "name": "FedEx 2Day AM",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.TLS.*",
   "name": "TLS Rateshop",
   "carrier": "TLS"
 },
 {
   "code": "ARE_API.ARE.TLS.NTC",
   "name": "Nebraska Transport",
   "carrier": "NEBRASKA"
 },
 {
   "code": "ARE_API.ARE.TLS.RL",
   "name": "R+L Carriers",
   "carrier": "RANDL"
 },
 {
   "code": "ARE_API.ARE.TLS.DAY",
   "name": "Dayton Freight",
   "carrier": "DAYTON"
 },
 {
   "code": "ARE_API.ARE.TLS.ES",
   "name": "Estes",
   "carrier": "ESTES"
 },
 {
   "code": "ARE_API.ARE.TLS.FXFP",
   "name": "FedEx Freight Priority",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.TLS.FXFE",
   "name": "FedEx Freight Economy",
   "carrier": "FEDEX"
 },
 {
   "code": "ARE_API.ARE.TLS.USR",
   "name": "US Road",
   "carrier": "USROAD"
 },
 {
   "code": "ARE_API.ARE.TLS.UPSF",
   "name": "UPS Freight",
   "carrier": "UPS"
 },
 {
   "code": "ARE_API.ARE.TLS.CFL",
   "name": "Central Freight Lines",
   "carrier": "CENTRALFREIGHT"
 },
 {
   "code": "ARE_API.ARE.TLS.ODFL",
   "name": "Old Dominion",
   "carrier": "OLDDOMINION"
 },
 {
   "code": "ARE_API.ARE.STAMPS.FC",
   "name": "USPS First Class (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.PR",
   "name": "USPS Priority Mail (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.EX",
   "name": "USPS Priority Mail Express (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.LIB",
   "name": "USPS Library Mail (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.MED",
   "name": "USPS Media Mail (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.PP",
   "name": "USPS Parcel Post (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.CRIT",
   "name": "USPS Parcel Post (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.PS",
   "name": "USPS Parcel Post (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.FCI",
   "name": "USPS First Class International (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.PRI",
   "name": "USPS Priority International (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.STAMPS.EXI",
   "name": "USPS Priority Express International (Stamps.com)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.PURO.G",
   "name": "Purolator Ground",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.G9",
   "name": "Purolator Ground 9 AM",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.G1030",
   "name": "Purolator Ground 10:30 AM",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.GPM",
   "name": "Purolator Ground Evening",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.GD",
   "name": "Purolator Ground Distribution",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.EX",
   "name": "Purolator Express",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.EX9",
   "name": "Purolator Express 9:00 A.M",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.EX1030",
   "name": "Purolator Express 10:30 A.M",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.EX12",
   "name": "Purolator Express 12:00",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.PURO.EXPM",
   "name": "Purolator Express Evening",
   "carrier": "PURCOLATOR"
 },
 {
   "code": "ARE_API.ARE.CAPOST.REG",
   "name": "Regular Parcel",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.XPD",
   "name": "Expedited Parcel",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.XP",
   "name": "Xpresspost",
   "carrier": "XPRESSPOST"
 },
 {
   "code": "ARE_API.ARE.CAPOST.XPC",
   "name": "Xpresspost Certified",
   "carrier": "XPRESSPOST"
 },
 {
   "code": "ARE_API.ARE.CAPOST.PRI",
   "name": "Priority",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.LIB",
   "name": "Library Books",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.WW",
   "name": "Priority Worldwide",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.SPA",
   "name": "Small Packet Air",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.TP",
   "name": "Tracked Packet",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.TPLVM",
   "name": "Tracked Packet (Large Volume)",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.IPA",
   "name": "International Parcel Air",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.IPS",
   "name": "International Parcel Surface",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.CAPOST.SPS",
   "name": "Small Packat Surface",
   "carrier": ""
 },
 {
   "code": "ARE_API.ARE.ELS.PR",
   "name": "USPS Priority Mail (Endicia) - Flat Rate",
   "carrier": "USPS"
 },
 {
   "code": "ARE_API.ARE.TLS.USFH",
   "name": "USF Holland (TLS)",
   "carrier": "USF"
 },
 {
   "code": "ARE_ENG.OSM.PS",
   "name": "USPS Parcel Select (OSM)",
   "carrier": "USPS"
 },
 {
   "code": "ARE_ENG.OSM.PSLW",
   "name": "USPS Parcel Select Lightweight (OSM)",
   "carrier": "USPS"
 }
];
	}

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
			service: query.parcel.service,
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
			$scope.parcel_result.carrier_code = findShipStoreCarrierCode($scope.query.parcel.service);
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