var elixir = require('laravel-elixir');

require('laravel-elixir-svgstore');
require('laravel-elixir-webpack');

elixir( function ( mix ) {
    mix.sass(['main.scss', 'icomoon.scss'], 'public/css/main.css');

    mix.scriptsIn('resources/assets/js/libs', 'public/js/libs.js');
    mix.version(['js/libs.js', 'css/main.css']);

	mix.svgstore('resources/assets/svg', 'public/svg');
} );
