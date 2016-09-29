var gulp = require('gulp');
var less = require('gulp-less');
var cleanCss = require('gulp-clean-css');
var plumber = require('gulp-plumber');
var livereload = require('gulp-livereload');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var notify = require("gulp-notify");
var del = require('del');


/**
 * Cleans out the public dist folder
 */
gulp.task('clean-dist', function(cb){
    return del(['web/dist/**/*'], cb);
});


/**
 * Copies dist folders from node_modules to public dir
 */
gulp.task('copy-dist', ['clean-dist'], function(){
    var modules = [
        'bootstrap',
        'bootstrap-colorpicker'
    ];
    modules.forEach(function(moduleName){
        gulp.src(['node_modules/' + moduleName + '/dist/**/*']).pipe(gulp.dest('web/dist/' + moduleName));
    });
});


/**
 * Frontend JS
 **/
gulp.task('js', function(){
    gulp.src([
        // Components
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        // Project Specific JS
        'web/js/javascript.js'
    ])
    .pipe(concat('javascript.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/js/min'))
    .pipe(livereload());
});


/**
 * Frontend LESS
 **/
gulp.task('less', function(){
    gulp.src([
        //components
        //project specific less
        'web/less/screen.less'
    ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(less())
    .pipe(cleanCss())
    .pipe(concat('screen.css'))
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('web/css'))
    .pipe(livereload());
});


/**
 * Admin LESS
 **/
gulp.task('admin-less', function(){
    gulp.src([
        'src/Application/AdminBundle/Resources/public/less/admin.less'
    ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(less())
    .pipe(cleanCss())
    .pipe(concat('admin.css'))
    .pipe(autoprefixer({
        browsers: ['last 4 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('src/Application/AdminBundle/Resources/public/css'))
    .pipe(livereload());
});


/**
 * Admin JS
 **/
gulp.task('admin-js', function(){
    gulp.src([
        // Project Specific JS
        'src/Application/AdminBundle/Resources/public/js/admin.js'
    ])
    .pipe(concat('admin.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/js/min'))
    .pipe(livereload());
});


/**
 * WATCH
 **/
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('web/less/**/*.less', ['less']);
    gulp.watch('src/Application/AdminBundle/Resources/public/less/**/*.less', ['admin']);
    gulp.watch(['web/js/**/*.js', '!web/js/min/javascript.min.js'], ['js']);
    gulp.watch(['src/**/*.html.twig', 'src/**/*.php', 'src/**/*.yml', 'app/Resources/**/*.html.twig', 'app/config/**/*.yml'], ['justReload']);
});


/**
 * HTML
 */
gulp.task('justReload', function() {
    livereload.reload();
});


/**
 * DEFAULT
 * Gets run when gulp is run
 **/
gulp.task('default', [
    'copy-dist',
    'js',
    'less',
    'admin-less',
    'admin-js',
    'watch'
]);


/**
 * DEPLOY
 */
gulp.task('deploy', [
    'copy-dist',
    'js',
    'less',
    'admin-less',
    'admin-js'
]);
