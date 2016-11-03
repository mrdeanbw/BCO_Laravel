
<template>
    <div>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="name" class="col-md-3 control-label">Name</label>

            <div class="col-md-9">
                <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="Your name">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Email Address</label>

            <div class="col-md-9">
                <input id="email" type="email" class="form-control" name="email" required placeholder="Email Address">
            </div>
        </div>

        <hr>
        <div class="form-group">
            <label for="password" class="col-md-3 control-label">Password</label>

            <div class="col-md-9">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>

            <div class="col-md-9">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>        
        <hr>

        <div class="form-group">
            <label for="organization" class="col-md-3 control-label">Organization</label>

            <div class="col-md-9">
                <input id="organization" type="text" class="form-control" name="organization" required placeholder="Your organization's name">
            </div>
        </div>        


        <div class="form-group">
            <label class="col-md-3 control-label">Location</label>
            <div class="col-md-9">
            <google-places
                class = "input form-control"
                placeholder = "Start typing your city and this will autocomplete">
            </google-places>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">City</label>
            <label class="col-md-9">{{ address.locality }}</label>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">State/Province</label>
            <span class="col-md-9">{{ address.administrative_area_level_1 }}</span>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Country</label>
            <label class="col-md-9">{{ address.country }}</label>            
        </div>

        <hr>

        <h4>Please pick the options that best describe your business</h4>
        I am predominantly a 
            <input type="radio" id="imp"><label for="imp">Importer</label>
            <input type="radio" id="exp"><label for="exp">Exporter</label>
            <input type="radio" id="both"><label for="both">Both</label>
        <br>
        My primary commodity is <select>
            <option>Recycled/Scrap paper, plastic, or metals</option>
            </select>
        <br>
        My commodities are 
            <input type="checkbox"><label>Perishable</label>
            <input type="checkbox"><label>Hazardous</label>
            <input type="checkbox"><label>Fragile</label>
            <input type="checkbox"><label>Liquid</label>
        </form>
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
