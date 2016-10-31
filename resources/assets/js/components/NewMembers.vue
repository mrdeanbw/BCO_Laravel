
<template>

    <div>    
        <h3><i class="fa fa-users primary" aria-hidden="true"></i> New Members</h3>    
        <p v-for="member in members">
            {{ member.name}} - {{ member.organization }}
        </p>        
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                members: [],
                error: ''
            };
        },
        created : function() {
            this.loadData();
        },

        methods: {
            loadData:  function() {
                this.$http.get("/api/new_members").then((response) => {
                    this.error = ''; 
                    this.members = response.body;
                }, (response) => {
                    this.error = 'Unable to retrieve members.';
                });
            }
        }
    }
    </script>

<style>

   

</style>
