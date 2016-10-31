
<template>
    <div class="stockapp">    
        <h3><i class="fa fa-bar-chart primary" aria-hidden="true"></i> Market Watch</h3>    
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Last Price</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody v-for="ticker in tickers">
                <stock-ticker :ticker="ticker" inline-template>
                    <tr>
                        <td :title="ticker.Name + '\nMkt Cp: ' + ticker.MarketCapitalization" data-toggle="tooltip">{{ ticker.Symbol }}</td>
                        <td>{{ ticker.Currency }} {{ ticker.LastTradePriceOnly }}</td>
                        <td :class="{ 'change-up': isPercentUp, 'change-down': !isPercentUp }">{{ ticker.PercentChange }}</td>
                    </tr>
                </stock-ticker>                                                    
            </tbody>
        </table>    
        <p class="subtle">Source: Yahoo Finance</p>
        
    </div>
</template>

<script>
    export default {
        props: ['symbols'],

        data: function () {
            return {
                tickers: [],
                error: ''
            };
        },
        created: function() {        
            this.loadData();
        }, 
        methods: {
            loadData: function() {
                var url = "http://query.yahooapis.com/v1/public/yql?q=select Symbol, Name, Currency, LastTradePriceOnly, MarketCapitalization, PercentChange from yahoo.finance.quotes where symbol in (" + this.symbols + ") order by symbol&format=json&diagnostics=true&env=http://datatables.org/alltables.env";

                this.$http.jsonp(url, {'jsonp': 'callback'}).then((response) => {            
                    this.error = '';
                    this.tickers = response.body.query.results.quote;
                }, (response) => {
                    this.error = 'Unable to retrieve stock quotes.';
                });
            }           
            
        },
        components: {
            'stock-ticker': {
                props: ['ticker'],
                computed: {
                    isPercentUp : function() {
                        return this.ticker.PercentChange.startsWith('+');                        
                    }
                }

                
            }
        }
    }
</script>

<style>
    .change-up {
        color: green;
    }

    .change-down {
        color: red;
    }

</style>

<!-- this.$http.jsonp("http://query.yahooapis.com/v1/public/yql?q=select Symbol, Name, Currency, LastTradePriceOnly, MarketCapitalization, PercentChange from yahoo.finance.quotes where symbol in ('JBHT', 'EXPD', 'UPS', 'FDX', 'CHRW', 'MAERSK-B')&format=json&diagnostics=true&env=http://datatables.org/alltables.env", {'jsonp': 'callback'}).then((response) => {
            console.log(response);
            this.newsitems = response.body;
        }, (response) => {

        }); -->