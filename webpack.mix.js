const mix = require('laravel-mix');

// Compiler les fichiers JavaScript
mix.js('resources/js/app.js', 'public/js')

// Compiler les fichiers Sass et inclure Bootstrap
   .sass('resources/sass/app.scss', 'public/css');
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/ajax-navigation.js', 'public/js') // Ajoutez cette ligne
   .postCss('resources/css/app.css', 'public/css', [
       //
   ]);