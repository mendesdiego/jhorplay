const gulp = require('gulp');
const autoPrefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass')(require('sass'));
const cleanCss = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

//Compila e minifica arquivos Sass em CSS
gulp.task('sass', function () {
    return gulp.src(['./sass/main.sass', './node_modules/bootstrap/scss/bootstrap.scss'])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoPrefixer())
        .pipe(concat('style.css'))
        .pipe(gulp.dest('../assets/css'))
        .pipe(browserSync.stream());
})

//Compila e minifica arquivos JS
gulp.task('scripts', function () {
    return gulp.src('./js/*.js', './node_modules/bootstrap/dist/js/bootstrap.bundle.js')
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../assets/js'))
        .pipe(browserSync.stream());
})

//Inicia o servidor
gulp.task('server', function () {
    //watch files
    var files = [
        '../assets/js/*js',
        '../assets/css/*.css',
        '../**/*.php'
    ];

    browserSync.init(files, {
        proxy: 'jhorplay.local',
        notify: true
    });

    //Watch files
    gulp.watch('./sass/*.sass', gulp.series('sass'))
    gulp.watch('./js/*.js', gulp.series('scripts'))
    gulp.watch('*.html').on('change', browserSync.reload)
})

gulp.task('default', gulp.series(['sass', 'scripts', 'server']))

