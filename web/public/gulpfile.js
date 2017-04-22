/**
 * Script de Automação 
 * Versão: 1.2
 * Author: Isael Sousa <faelp22@gmail.com>
 * Data: 27/03/2017
 */

var gulp = require('gulp');
var jshint = require('gulp-jshint');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var runSequence = require('run-sequence');
var watch = require('gulp-watch');
var es = require('event-stream');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var debug = require('gulp-debug');

/**
 * Variaveis
 */
var tmp = './temp/';
var dist = './dist/';
var app = './js/';
var css = './css/';
var libs = './bower_components/';
var distlibs = './lib/';

/**
 * Tarefaz
 */
gulp.task('cleanAll', function () {
    return gulp.src([dist, distlibs, tmp]).pipe(clean());
});

gulp.task('clean', function () {
    return gulp.src([
        dist + 'framework/', tmp,
//        dist + 'main.min.js',
        dist + '/app/app.min.js',
        dist + '/app/services.min.js'
    ])
            .pipe(clean());
});

gulp.task('jshint', function () {
    return gulp.src([app + '*.js'])
            .pipe(jshint())
            .pipe(jshint.reporter('default'));
});

/**
 * Coletando bibliotecas css
 */
gulp.task('coletorcss', function () {
    return gulp.src([
        libs + 'components-font-awesome/css/font-awesome.min.css',
        libs + 'bootstrap/dist/css/bootstrap.min.css',
        libs + 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ])
            .pipe(concat('all-libs.min.css'))
            .pipe(gulp.dest(distlibs + 'css/'));
});

gulp.task('coletorfonts', function () {
    return gulp.src([
        libs + 'bootstrap/dist/fonts/*',
        libs + 'components-font-awesome/fonts/*'
    ])
            .pipe(gulp.dest(distlibs + 'fonts/'));
});

gulp.task('coletorjs', function () {
    return gulp.src([
        libs + 'jquery/dist/jquery.min.js',
        libs + 'bootstrap/dist/js/bootstrap.min.js',
        libs + 'moment/min/moment.min.js',
        libs + 'jquery.maskedinput/dist/jquery.maskedinput.min.js',
        libs + 'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
//        libs + 'angular/angular.min.js'
    ])
            .pipe(concat('all-libs.min.js'))
            .pipe(gulp.dest(distlibs + 'js/'));
});

/**
 * Minificação
 */
gulp.task('jsminsrc', function () {
    return gulp.src([
//        app + '**/*.js',
        app + 'main.js'
    ])
            .pipe(uglify().on('error', function (e) {
                console.log(e);
            }))
                    .pipe(debug({title: 'jsminsrc:'}))
                    .pipe(gulp.dest(tmp));
});

gulp.task('cssminsrc', function () {
    return gulp.src(
            [css + '**/*.css'])
        .pipe(debug({title: 'cssminsrc:'}))
        .pipe(cleanCSS())
        .pipe(gulp.dest(tmp));
});

/**
 * Include extension .min.
 */
gulp.task('renamejs', function () {
    return gulp.src(tmp + '**/*.js').pipe(rename({
        suffix: ".min",
        extname: ".js"
    })).pipe(gulp.dest(dist));
});

gulp.task('renamecss', function () {
    return gulp.src(tmp + '**/*.css').pipe(rename({
        suffix: ".min",
        extname: ".css"
    })).pipe(gulp.dest(dist));
});

//gulp.task('app-web', function () {
//    return gulp.src([
//        dist + 'main.min.js',
//        dist + '/app/app.min.js',
//        dist + '/app/services.min.js'
//    ])
//            .pipe(concat('app-web.min.js'))
//            .pipe(gulp.dest(dist + 'js/'));
//});

/**
 * Ativa monitor automatico
 */
gulp.task('monitor', function () {
    gulp.watch([app + '**/*.js', css + '**/*.css'], ['default']);
});

/**
 * Execução manual e na ordem definidas as tarefas
 * @param {cb} cb callback 
 */
gulp.task('default', function (cb) {
    return runSequence(
            'cleanAll',
            ['cssminsrc', 'jsminsrc'],
            ['coletorcss', 'coletorjs', 'coletorfonts'],
            'renamejs', 'renamecss', /*'app-web',*/ 'clean', cb);
});