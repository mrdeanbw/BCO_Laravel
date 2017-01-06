
<template>
    <div class="stockapp">    
        <h3><i class="fa fa-bar-chart primary" aria-hidden="true"></i> Market Watch <button @click="toggleEdit" v-if="!editMode" class="btn btn-default btn-sm">Customize</button><button @click="saveSymbols" v-if="editMode" class="btn btn-primary btn-sm">Save</button></h3>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Last Price</th>
                    <th>Change</th>
                    <th v-if="editMode"></th>
                </tr>
            </thead>
            <tbody >
                <stock-ticker :ticker="ticker" :editMode="editMode" inline-template v-for="ticker in tickers" v-on:remove="removeSymbol">
                    <tr v-if="!hidden">
                        <td :title="ticker.Name + '\nMkt Cp: ' + ticker.MarketCapitalization" data-toggle="tooltip">{{ ticker.Symbol }}</td>
                        <td>{{ ticker.Currency }} {{ ticker.LastTradePriceOnly }}</td>
                        <td :class="{ 'change-up': isPercentUp, 'change-down': !isPercentUp }">{{ ticker.PercentChange }}</td>
                        <td v-if="editMode"><button class="btn btn-danger btn-sm" @click="remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                    </tr>
                </stock-ticker>                                                    
            </tbody>
        </table>    
        <p class="subtle">Source: Yahoo Finance</p>
        
        <div v-if="editMode">
        <span><input type="text" class="form-control" v-model="newSymbol">
        <button @click="addSymbol" class="btn btn-sm btn-default">Add</button></span>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['symbols'],

        data: function () {
            return {
                tickers: [],
                error: '',
                editMode: false,
                newSymbol: '',
                tempSymbols: ''
            };
        },
        created: function() {        
            this.tempSymbols = this.symbols;
            this.loadData();
        }, 
        methods: {
            loadData: function() {
                var url = "http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.quotes where symbol in (" + this.tempSymbols + ") order by symbol&format=json&diagnostics=true&env=http://datatables.org/alltables.env";

                this.$http.jsonp(url, {'jsonp': 'callback'}).then((response) => {            
                    this.error = '';
                    this.tickers = response.body.query.results.quote;
                }, (response) => {
                    this.error = 'Unable to retrieve stock quotes.';
                });
            },
            saveSymbols: function() {
                var symbols = this.tempSymbols;  
                this.$http.post('/api/user/edit_symbols', {'symbols': symbols}, null).then((response) => {
                    
                }, (response) => {
                    
                });
                this.toggleEdit();                
            },
            toggleEdit: function() {
                this.editMode = !this.editMode;                
            },
            addSymbol: function() {                
                this.tempSymbols += ", '" + this.newSymbol + "'"                
                this.newSymbol = '';                
                this.loadData();
            },
            removeSymbol: function(ticker) {                
                
                if(this.tempSymbols.indexOf("'" +ticker.symbol +"',")> -1) {
                    this.tempSymbols = this.tempSymbols.replace("'"+ticker.symbol+"', ", '');
                } else {
                    this.tempSymbols = this.tempSymbols.replace(", '" + ticker.symbol + "'", '');
                }                
                //this.loadData();                
            }     
        },
        components: {
            'stock-ticker': {
                props: ['ticker', 'editMode'],
                data: function() {
                    return {
                        hidden: false
                    };
                },             
                computed: {
                    isPercentUp : function() {
                        return this.ticker.PercentChange.startsWith('+');                        
                    }
                },
                methods: {
                    remove: function() {  
                        this.hidden = true;                                             
                        this.$emit('remove', this.ticker)
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