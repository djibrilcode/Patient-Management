const mix = require('laravel-mix');

// Compiler les fichiers JavaScript
mix.js('resources/js/app.js', 'public/js')

// Compiler les fichiers Sass et inclure Bootstrap
   .sass('resources/sass/app.scss', 'public/css');
