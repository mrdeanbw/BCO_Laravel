
<template>
    <div>
        <google-places class="input form-control" placeholder="Start typing your city and this will autocomplete"></google-places>
        <input type="hidden" name="city" v-model="address.locality">   
        <input type="hidden" name="state" v-model="address.administrative_area_level_1">   
        <input type="hidden" name="country" v-model="address.country">
        <input type="hidden" name="lat" v-model="address.lat">
        <input type="hidden" name="lng" v-model="address.lng">        
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
    .control-label {
        text-align: left !important;
    }

</style>
