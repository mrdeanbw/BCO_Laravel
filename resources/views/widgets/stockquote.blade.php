<div id="stockQuoteApp" ng-app="stockQuoteApp">
	<style>
	
	</style>
	<div ng-controller="appController">
		<ng-view>			
			<table class="table">
				<thead>
					<th>

						<td>Change</td>
						<td>Last Price</td>
						<td>Mkt Cp</td>
					</th>
				</thead>
				<tbody>
					<tr ng-repeat="quote in result">
						<td><strong><% quote.name %><strong></td>
						<td><% quote.change %></td>
						<td><% quote.currency %> <% quote.bid %></td>						
						<td><% quote.cap %></td>					
					</tr>
				</tbody>
			</table>
		</ng-view>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.js" type="text/javascript" ></script>

<script src="/js/stockQuoteApp/app.js"></script>