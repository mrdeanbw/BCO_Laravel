
<template>
    <div>
        <pre>{{address}}</pre>
        <div class="form-group">
            <label for="location">Location</label>
            <google-places
                class = "input form-control"
                placeholder = "type your address">
            </google-places>
        </div>
        <div class="form-group">
            <label>City: {{ address.locality }}</label>
        </div>
        <div class="form-group">
            <label>State/Province: {{ address.administrative_area_level_1 }}</label>
        </div>
        <div class="form-group">
            <label>Country: {{ address.country }}</label>
        </div>
    </div>
</template>

<script>
    import Store from './../GoogleAutoCompleteStore.js'

    export default {
        components: function() {
            return {
            'google-places': Vue.component('google-places')
            };
        },
        data: function () {
            return {
                address: {}
            };
        },
        computed:
        {
            sharedAddress: function()
            {
                return Store.state.sharedAddress;
            }
        },

        watch: {
            sharedAddress: function ()
            {
                this.address = this.sharedAddress;
            }
        },

        methods:
        {
        }
    }
</script>

<style>

</style>
