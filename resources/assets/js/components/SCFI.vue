<template>
    <div class="scfi">
        <h3><i class="fa fa-newspaper-o primary" aria-hidden="true"></i> SCFI</h3>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th>This Week</th>
                    <th>Last Week</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="item in comprehensive(data)">
                <td colspan="2">{{ item.description }}</td>
                <td class="col-right">{{ item.current }}</td>
                <td class="col-right">{{ item.previous }}</td>
                <td class="col-right">{{ item.change >= 0 ? '+' : '' }}{{item.change}}%</td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr v-for="item in trades(data)">
                <td>{{ item.description }}</td>
                <td>{{ item.unit }}</td>
                <td class="col-right">{{ item.current }}</td>
                <td class="col-right">{{ item.previous }}</td>
                <td class="col-right">{{ item.change > 0 ? '+' : '' }}{{item.change}}%</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script>
    export default {
        data: function () {
            return {
                data: [],
                error: ''
            };
        },
        created : function() {
            this.loadData();
        },

        methods: {
            loadData:  function() {
                this.$http.jsonp("http://index.chineseshipping.com.cn/servlet/scfiGetContrast?SpecifiedDate=", {'jsonp': 'jc'}).then((response) => {
                    this.error = '';
                    var scfi = response.body.scfi;
                    var pre_scfi = response.body.scfi_pre;
                    var w = response.body.scfi_w;

                    var scfi_compiled = [];

                    for(var prop in scfi.data) {
                        if(scfi.data.hasOwnProperty(prop)) {

                            var id = prop;
                            var mapping = this.getMapping();

                            var obj = window.$.grep(mapping, function(e) { return e.id == id;})[0];

                            var current = parseFloat(scfi.data[prop]);
                            var previous = parseFloat(pre_scfi.data[prop]);
                            var change = Math.round((current - previous) / previous * 1000) / 10;

                            var item = {
                                id: prop,
                                sort: obj.sort,
                                'description': obj.name,
                                'unit': obj.unit,
                                'current': current,
                                'previous': previous,
                                'weight': w[prop + 'w'],
                                'change': change//(Math.round(((current - previous) / previous) * 1000) / 1000) * 100
                            };
                            scfi_compiled.push(item);


                        }
                    }
                    scfi_compiled.sort(function(a,b) {
                        return (a.sort > b.sort) ? 1 : ((b.sort > a.sort) ? -1 : 0);
                    });
                    console.log(scfi_compiled);

                    this.data = scfi_compiled;
                }, (response) => {
                    this.error = 'Unable to retrieve SCFI.';
                });
            },

            getMapping: function() {
                return [{id:'L1','sort': 1,'name':'Europe (Base port)', 'unit':'USD/TEU'},
                {id:'L2','sort': 2,'name':'Mediterranean (Base port)', 'unit':'USD/TEU'},
                {id:'L3','sort': 3,'name':'USWC (Base port)', 'unit':'USD/FEU'},
                {id:'L4','sort': 4,'name':'USEC (Base port)', 'unit':'USD/FEU'},
                {id:'L5','sort': 5,'name':'Persian Gulf and Red Sea (Dubai)', 'unit':'USD/TEU'},
                {id:'L6','sort': 6,'name':'Australia/New Zealand (Melbourne)', 'unit':'USD/TEU'},
                {id:'L7','sort': 7,'name':'East/West Africa (Lagos)', 'unit':'USD/TEU'},
                {id:'L8','sort': 8,'name':'South Africa (Durban)', 'unit':'USD/TEU'},
                {id:'L9','sort': 9,'name':'South America (Santos)', 'unit':'USD/TEU'},
                {id:'L10','sort': 10,'name':'West Japan (Base port)', 'unit':'USD/TEU'},
                {id:'L11','sort': 11,'name':'East Japan (Base port)', 'unit':'USD/TEU'},
                {id:'L12','sort': 12,'name':'Southeast Asia (Singapore)', 'unit':'USD/TEU'},
                {id:'L13','sort': 13,'name':'Korea (Pusan)', 'unit':'USD/TEU'},
                {id:'L14','sort': 14,'name':'Taiwan (Kaohsiung)', 'unit':'USD/TEU'},
                {id:'L15','sort': 15,'name':'Hong Kong (Hong Kong)', 'unit':'USD/TEU'},
                {id:'L20','sort': 16,'name':'Other', 'unit':'USD/TEU'},
                {id:'T','sort': 0,'name':'Comprehensive Index', 'unit':'USD/TEU'}];
            },
            comprehensive: function(data) {
                return data.filter(function(item) {
                    return item.id === 'T';
                })
            },
            trades: function(data) {
                return data.filter(function(item) {
                    return item.id !== 'T' && item.id !== 'L20';
                })
            }
        }
    }
</script>

<style>

</style>
