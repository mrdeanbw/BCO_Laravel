<div id="newsApp" >
	<div ng-controller="newsAppController">
		<ng-view>	
			
			
			<div ng-repeat="item in feed track by $index">
			<p class="title"><a ng-href="<% item.link %>" target="_blank" alt="<% item.title %>"><% item.title %></a></p>
			<p><% item.description %></p>
			</div>
			<p><i>Obtained from American Shipper</i></p>
		</ng-view>
	</div>
</div>

	

<script src="/js/newsApp/app.js"></script>                    

<script>
angular.element(function() {
	angular.bootstrap($('#newsApp'), ['newsApp']);
});
</script>