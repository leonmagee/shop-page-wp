/**
 *  Initialize Gulp
 */
var gulp = require('gulp');

/**
 *  Load Gulp Dependencies
 */
var sass = require('gulp-sass');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var util = require('gulp-util');
var wpPot = require('gulp-wp-pot');

/**
 * Default Task
 */
gulp.task('default', ['scss-base', 'scss-grid', 'watch']);

/**
 * SCSS Task
 */
gulp.task('scss-base', function () {
    gulp.src(['assets/scss/shop-page-wp-base-styles.scss'])
        .pipe(sass({style: 'compressed', errLogToConsole: true}))
        .pipe(rename('shop-page-wp-base-styles.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('assets/css'));
    util.log(util.colors.red('> > > base styles compiled < < <'));
});

gulp.task('scss-grid', function () {
    gulp.src(['assets/scss/shop-page-wp-grid.scss'])
        .pipe(sass({style: 'compressed', errLogToConsole: true}))
        .pipe(rename('shop-page-wp-grid.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('assets/css'));
    util.log(util.colors.red('> > > grid styles compiled < < <'));
});

/**
 * Watch Task
 */
gulp.task('watch', function () {

    /**
     *  Watch PHP files for changes
     */
    var php = '**/*.php';
    gulp.watch(php).on('change', function (file) {
        util.log(util.colors.blue('[ ' + file.path + ' ]'));
    });

    /**
     *  Watch SCSS files for changes
     */
    gulp.watch('assets/scss/**/*.scss', ['scss-base', 'scss-grid']);
});

/**
 * Generate Pot Files
 */
gulp.task('pot', function () {
    return gulp.src('**/*.php')
        .pipe(wpPot( {
            domain: 'shop-page-wp',
            package: 'Shop_Page_WP'
        } ))
        .pipe(gulp.dest('languages/shop-page-wp.pot'));
});
