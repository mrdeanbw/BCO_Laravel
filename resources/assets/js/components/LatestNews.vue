<template>

    <div class="assocnews">
        <h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> Association News</h3>
        <div v-for="item in newsitems" class="assocnewsitem">
            <h5 class="title-line"><a :href="'members/news/' + item.id"><strong>{{ item.title }}</strong></a></h5>
            <p class="subtle date-line">{{ item.pubDate }}</p>
            <p class="description-line" v-html="item.summary"></p>
        </div>
        <a href="/members/news" class="readmore"><i class="fa fa-caret-down" aria-hidden="true"></i> Read more</a>
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
                this.$http.get("/api/latest_news").then((response) => {
                    this.error = '';
                    this.newsitems = response.body;
                }, (response) => {
                    this.error = 'Unable to retrieve news.';
                });
            }
        }
    }
</script>

<style>

    .assocnewsitem {
        border-bottom: 1px solid #d6d8d9;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .assocnewsitem .title-line {
        font-size: 1.2em;
        margin-bottom: 0px;
    }

    .assocnewsitem .date-line {
        margin-bottom: 10px;
    }

    .assocnewsitem .description-line p {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3; /* number of lines to show */
        line-height: 1.2;        /* fallback */
        max-height: 3.6;
    }

    .assocnewsitem p {
        margin-bottom: 0;
    }

</style>
