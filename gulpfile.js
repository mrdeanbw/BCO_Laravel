const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass(['app.scss'])
    	.sass(['appnew.scss'], 'public/css/appnew.css')
       .webpack('app.js')
       .webpack('ng-apps/rates.js', 'public/js/rates.js');
    mix.sass('forums.scss');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');
    mix.copy('resources/assets/summernote/', 'public/summernote');
    mix.copy('node_modules/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js', 'public/js');
    mix.copy('resources/assets/js/home.js', 'public/js');

});
