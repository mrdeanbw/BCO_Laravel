
<template>

    <div class="marketnews">
        <h3><i class="fa fa-newspaper-o primary" aria-hidden="true"></i> Industry News</h3>    
        <div v-for="item in newsitems" class="marketnewsitem">
            <h5 class="title-line"><a :href="item.link" target="_blank">{{ item.title }}</a></h5>
            <p class="subtle date-line">{{ item.pubDate }}</p>
            <p class="description-line">{{ item.description }}</p>
        </div>
        <p class="subtle">Source: American Shipper</p>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                newsitems: [],
                error: ''
            };
        },
        created : function() {
            this.loadData();
        },

        methods: {
            loadData:  function() {
                this.$http.jsonp("https://query.yahooapis.com/v1/public/yql?q=select * from rss(0,5) where url='http://americanshipper.com/feed.aspx?sn=ASDailyShippersLogistics'&format=json", {'jsonp': 'callback'}).then((response) => {
                    this.error = ''; 
                    this.newsitems = response.body.query.results.item;
                }, (response) => {
                    this.error = 'Unable to retrieve news.';
                });
            }
        }
    }
    </script>

<style>

    .marketnewsitem {
        border-bottom: 1px solid #d6d8d9;    
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .marketnewsitem .title-line {
        font-size: 1.2em;
        margin-bottom: 0px;
    }

    .marketnewsitem .date-line {
        margin-bottom: 10px;
    }

    .marketnewsitem p {
        margin-bottom: 0;
    }

</style>
