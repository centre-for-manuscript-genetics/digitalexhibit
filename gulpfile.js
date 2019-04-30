var elixir = require('laravel-elixir');
var gulp = require('gulp');
var Task = elixir.Task;
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');

require("laravel-elixir-webpack");

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.css.autoprefix = {
    enabled: true, //default, this is only here so you know how to disable
    options: {
       cascade: true,
       browsers: ['last 2 versions', 'IOS 7']
    }
};

var paths = {
    'bootstrap': 'node_modules/bootstrap-sass/assets/stylesheets',
}

elixir.extend('svgstore', function(){

    new Task('svgstore', function() {
        return gulp
            .src('resources/assets/images/svg-images/*.svg')
            .pipe(svgmin(function() {
                return {
                    plugins: [{
                        cleanupIDs: {
                            minify: true
                        }
                    }]
                };
            }))
            .pipe(svgstore())
            .pipe(gulp.dest('public/images/svg'));
    });
});

elixir(function(mix) {

    mix.svgstore();

    mix.sass('app.scss','public/css', {
        includePaths: [paths.bootstrap]
    });

    mix.webpack('app.js');

    mix.browserSync({
        proxy: 'uni00001.dev',
        open: false
    });
});

