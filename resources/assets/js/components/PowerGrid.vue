
<template>

    <div>    
        <h3><i class="fa fa-comments-o" aria-hidden="true"></i> PowerGRID Posts</h3>    
        <div v-for="post in posts" >
            <a href="/members/forums"><span class="postbody" v-html="post.body"></span></a>
            <strong><p>by {{post.user.name }} on {{post.updated_at}}</p></strong>
        </div>
       
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                posts: [],
                error: ''
            };
        },
        created : function() {
            this.loadData();
        },

        methods: {
            loadData:  function() {
                this.$http.get("/api/forum_posts").then((response) => {
                    this.error = ''; 
                    this.posts = response.body;
                }, (response) => {
                    this.error = 'Unable to retrieve posts.';
                });
            }
        }
    }
    </script>

<style>

   .postbody {
        color: #636b6f;
        display: block; 
        max-height: 4.2em;
        line-height: 1.4em;
        overflow: hidden; 
        word-wrap: break-word; 
        text-overflow: ellipsis;
   }

</style>
