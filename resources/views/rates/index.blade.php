@extends('layouts.app')

@section('content')
<style>
	footer {
		display: none;
	}
</style>

<md-content layout-fill ng-app="ratesApp" id="ratesapp" ng-cloak>
	<div flex-gt-sm="60" flex-offset-gt-sm="20" ng-controller="indexCtrl">

		<form name="ratesForm" id="ratesForm"  novalidate ng-submit="queryRates()" >
			<div layout="column" class="md-whiteframe-2dp">
				<h3 layout-margin><img src="/res/logo-2.png" /> Shipping Rates</h3>
				<div layout="row" layout-align="start center" layout-margin>
							
					<md-autocomplete
						md-input-name="originAutoCompleteField"
						flex
						required
						md-require-match
						ng-disabled="false"
						md-no-cache="false"
						md-selected-item="query.origin"				
						md-search-text="searchOriginText"				
						md-items="item in locationQuerySearch(searchOriginText)"
						md-item-text="item.display_name"
						md-min-length="3"
						placeholder="Pick the shipment origin"
						
						>
						<md-item-template>
							<span md-highlight-text="searchOriginText" md-highlight-flags="gi"> [[ item.display_name ]]</span>
						</md-item-template>
						<md-not-found>
							No locations matching "[[ searchOriginText ]]" were found.					
						</md-not-found>					
					</md-autocomplete>

					<md-autocomplete
						md-input-name="destinationAutoCompleteField"
						flex
						required
						md-require-match
						ng-disabled="false"
						md-no-cache="false"
						md-selected-item="query.destination"				
						md-search-text="searchDestinationText"				
						md-items="item in locationQuerySearch(searchDestinationText)"
						md-item-text="item.display_name"
						md-min-length="3"
						placeholder="Pick the shipment destination"
						
						>
						<md-item-template>
							<span md-highlight-text="searchDestinationText" md-highlight-flags="gi"> [[ item.display_name ]]</span>
						</md-item-template>
						<md-not-found>
							No locations matching "[[ searchDestinationText ]]" were found.					
						</md-not-found>						
					</md-autocomplete>
					
						<md-datepicker 
							name="shipDate"
							ng-model="query.shipdate" 
							md-placeholder="Enter date"
							required>

						</md-datepicker>
					
				</div> 
				
				<md-tabs md-dynamic-height  md-border-bottom md-selected="ui.selectedTabIndex" >
					
					<md-tab label="Full Load">
						<md-content class="md-padding">
							<md-input-container class="md-block">
								<label>Commodity</label>
								<input name="fclCommodity" ng-model="query.fcl.commodity" ng-required="ui.selectedTabIndex == 0">
							</md-input-container>
							<md-list>
								<md-list-item ng-repeat="ctr in query.fcl.containers">
									<div layout="row" flex>
										<md-input-container class="md-block" flex="20">
											<label ng-if="$index == 0">Quantity</label>
											<input name="fclQuantity" ng-model="ctr.quantity" aria-label="Quantity" ng-required="ui.selectedTabIndex == 0">
										</md-input-container>
										<md-input-container class="md-block" flex="30">
											<label ng-if="$index == 0">Type</label>
											<md-select name="fclType"  ng-model="ctr.type" aria-label="Container Type" ng-required="ui.selectedTabIndex == 0">
												<md-option value="20'DV">20 DV</md-option>
												<md-option value="40'DV">40 DV</md-option>
												<md-option value="40'HC">40 HC</md-option>
											</md-select>
										</md-input-container>

										<md-input-container class="md-block" flex="20">
											<label ng-if="$index == 0">Weight</label>
											<input name="fclWeight" type="number" ng-model="ctr.weight" aria-label="Weight" ng-required="ui.selectedTabIndex == 0">									
										</md-input-container>

										<md-input-container class="md-block" flex="30">
											<label ng-if="$index == 0">Weight Unit</label>
											<md-select name="fclWeightUOM" ng-model="ctr.weight_uom" aria-label="Weight Unit" ng-required="ui.selectedTabIndex == 0">
												<md-option value="pound">Pounds</md-option>
												<md-option value="kilogram">Kilograms</md-option>
											</md-select>
										</md-input-container>
										

									</div>
										<md-button class="md-icon-button md-warn" ng-click="removeFCLContainer($index)">
											<md-icon><i class="fa fa-minus-circle" aria-hidden="true"></i></md-icon>
										</md-button>
								</md-list-item>
								<md-button class="md-primary md-raised" ng-click="addFCLContainer()">Add Container</md-button>
							</md-list>

						</md-content>
					</md-tab>

					<md-tab label="Partial Load / Pallet">
						<md-content class="md-padding">	
							<md-input-container ng-show="query.origin.us_domestic && query.destination.us_domestic">
								<label>Freight Class</label>
								<md-select ng-model="query.lcl.freightclass" ng-required="query.origin.us_domestic && query.destination.us_domestic && ui.selectedTabIndex == 1">
									<md-option ng-repeat="fc in query.lcl.freight_classes" value="[[fc]]">Class [[fc]]</md-option>
								</md-select>
							</md-input-container>					
							<md-list>
							<div ng-repeat="item in query.lcl.items">
								<md-list-item>
									
										<div layout="row" flex>
											<md-input-container class="md-block" flex="10">		
												<label ng-if="$index == 0">Quantity</label>							
												<input name="lclQuantity" type="number" ng-model="item.quantity" aria-label="Quantity"  ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block">		
												<label ng-if="$index == 0">Description</label>							
												<input name="lclDescription" ng-model="item.description" aria-label="Description"  ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block" flex="10">
												<label ng-if="$index == 0">Weight</label>
												<input name="lclWeight" type="number" ng-model="item.weight" aria-label="Weight"  ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block" flex="15">
												<label ng-if="$index == 0">Weight Unit</label>
												<md-select name="lclWeightUOM" ng-model="item.weight_uom" aria-label="Weight Unit"  ng-required="ui.selectedTabIndex == 1">
													<md-option value="pound">Pounds</md-option>
													<md-option value="kilogram">Kilograms</md-option>
												</md-select>
											</md-input-container>
									
											<md-input-container class="md-block" flex="10">
												<label ng-if="$index == 0">Length</label>
												<input name="lclLength" type="number" ng-model="item.length" aria-label="Length" ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block" flex="10">
												<label ng-if="$index == 0">Width</label>
												<input name="lclWidth" type="number" ng-model="item.width" aria-label="Width" ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block" flex="10">
												<label ng-if="$index == 0">Height</label>
												<input name="lclHeight" type="number" ng-model="item.height" aria-label="Height" ng-required="ui.selectedTabIndex == 1">
											</md-input-container>

											<md-input-container class="md-block" flex="15">
												<label ng-if="$index == 0">Meas. Unit</label>
												<md-select name="lclMeasUOM" ng-model="item.dim_uom" aria-label="Meas. Unit" ng-required="ui.selectedTabIndex == 1">
													<md-option value="inch">Inches</md-option>
													<md-option value="cm">Centimeters</md-option>
												</md-select>
											</md-input-container>

										</div>
									
									
									<md-button class="md-icon-button md-warn" ng-click="removeLCLItem($index)">
										<i class="fa fa-minus-circle" aria-hidden="true"></i>
									</md-button>
								</md-list-item>
								
							</div>
							</md-list>
							<md-button class="md-primary md-raised" ng-click="addLCLItem()">Add Item</md-button>
							{{-- <md-button class="md-primary" ng-click="populateLCLServices()">Show services</md-button>
							<div layout="column" flex="50">							
								<div layout="row">
									<span flex></span>
									<p flex="10">Pickup</p>
									<p flex="10">Delivery</p>
									<div ng-repeat="serv in query.lcl.services">
										<p style="margin: 0;" flex>[[serv.title]]</p> 
										<md-checkbox ng-model="serv.pickup" flex="10" style="margin-bottom: 2px;"></md-checkbox>
										<md-checkbox ng-model="serv.delivery" flex="10" style="margin-bottom: 2px;"></md-checkbox>
									</div>
								</div>
							</div> --}}
							
						</md-content>

						
					</md-tab>
					<md-tab label="Parcel" ng-disabled="true">
						<md-content class="md-padding">
						</md-content>
					</md-tab>
				</md-tabs>

				<md-button class="md-primary md-raised" type="submit">Get Rates</md-button>
				<md-progress-linear md-mode="indeterminate" ng-show="ratesForm.$busy"></md-progress-linear>				
			</div>


		</form>	

		<div class="error-panel md-whiteframe-2dp" layout-padding ng-show="warning != ''">
			<h3>Sorry</h3>
			<p>[[ warning ]]</p>
		</div>

		<div class="results-panel md-whiteframe-2dp" ng-show="results.length > 0">
			<md-list>
				<md-list-item ng-repeat="result in results | orderBy: 'total_charge_cents'">
					<div layout="row" flex layout-align="start center" layout-padding>
						<span flex="5" class="primary" data-toggle="tooltip" title="[[ transformExKey(result.type) ]] ">
							<i class="fa fa-plane fa-2x"  ng-if="result.type.substring(0,3) == 'air'"></i>
							<i class="fa fa-ship  fa-2x" ng-if="result.type == 'ocean_standard' || result.type=='fcl'"></i>
							<i class="fa fa-truck  fa-2x" ng-if="result.type == 'ftl' || result.type=='truck'"></i>
						</span>
						<div layout="column" layout-align="center center">
							<span style="font-size: 1.3em;"><strong>$[[result.total_charge_cents / 100 | number : 2]]</strong></span>
							<span>[[result.transit_days]] days</span>
						</div>
						<span flex></span>
						<span flex="50">[[result.description]]</span> 
						<span class="subtle" data-toggle="tooltip" title="[[transformExKey(result.door_service)]]" style="font-size: 1.5em">
							<span ng-if="result.door_service == 'door_to_port'">
								<i class="fa fa-home" aria-hidden="true"></i> 
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
								<i class="fa fa-ship" aria-hidden="true" ng-if="result.type.substring(0,3) != 'air'"></i>
								<i class="fa fa-plane" aria-hidden="true" ng-if="result.type.substring(0,3) == 'air'"></i>
							</span>
							<span ng-if="result.door_service == 'door_to_door'">
								<i class="fa fa-home" aria-hidden="true"></i> 
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
								<i class="fa fa-home" aria-hidden="true"></i>
							</span>
							<span ng-if="result.door_service == 'port_to_door'">
								<i class="fa fa-ship" aria-hidden="true" ng-if="result.type.substring(0,3) != 'air'"></i>
								<i class="fa fa-plane" aria-hidden="true" ng-if="result.type.substring(0,3) == 'air'"></i>
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
								<i class="fa fa-home" aria-hidden="true"></i> 							
							</span>
						</span>
					</div>
					<md-divider></md-divider>
				</md-list-item>
			</md-list>
		</div>
	</div>
</md-content>



@endsection

@section('js')

	<script src="/js/rates.js" type="text/javascript"></script>

@endsection

