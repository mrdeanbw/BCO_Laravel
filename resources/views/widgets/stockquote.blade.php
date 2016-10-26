<div id="stockQuoteApp" ng-app="stockQuoteApp">
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
					<tr ng-repeat="quote in result track by $index">
						<td><strong><span><% quote.ticker %></span><strong></td>
						<td><% quote.change %></td>
						<td><% quote.currency %> <% quote.bid %></td>						
						<td><% quote.cap %></td>					
					</tr>
				</tbody>
			</table>
		</ng-view>
	</div>
</div>

<script src="/js/stockQuoteApp/app.js"></script>