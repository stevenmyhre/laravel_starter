var gulp = require('gulp'),
    sass = require('gulp-sass'),
    minify = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    growl = require('gulp-notify-growl'),
    phpunit = require('gulp-phpunit'),
    livereload = require('gulp-livereload'),
    lr = require('tiny-lr'),
    print = require('gulp-print'),
    rev = require('gulp-rev'),
    del = require('del'),
    util = require('gulp-util'),
    autoprefix = require('gulp-autoprefixer'),
    server = lr();

var paths = {
    'css': './public/css/',
    'js': './public/js/'
};

var styles = [
    './resources/assets/sass/site.scss'
];

var scripts = [
    './resources/assets/js/site.js'
];

function handleError(err) {
    util.log(util.colors.red(err.toString()));
    this.emit('end');
}

gulp.task('cleanup', function() {
    return del('./public/build/*', { force: true });
});

gulp.task('css', ['cleanup'], function() {
    return gulp.src(styles)
        .pipe(sass())
        .on('error', handleError)
        .pipe(autoprefix('last 2 versions'))
        .pipe(gulp.dest(paths.css))

        .pipe(livereload())

        .pipe(minify())
        .pipe(rename({suffix: '.min'}))
        .pipe(rev())
        .pipe(gulp.dest('./public/build'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('./public/build'));


});

gulp.task('scripts', function() {
    return gulp.src(scripts)
        .pipe(gulp.dest(paths.js))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify({preserveComments: 'some'}))
        .pipe(gulp.dest(paths.js));
});

gulp.task('app', function() {
    return gulp.src("./public/app/**/*.js")
        .pipe(concat("app.js"))
        .pipe(gulp.dest(paths.js))
        .pipe(livereload());
})

gulp.task('blade', function() {
   return gulp.src("./public/index.php")
       .pipe(livereload());
});

gulp.task('watch', ['default'], function() {
    livereload.listen();
    gulp.watch('./resources/assets/js/**/*.js', ['scripts']);
    gulp.watch('./resources/assets/sass/**/*.scss', ['css']);
    gulp.watch('./resources/views/**/*.blade.php', ['blade']);
    gulp.watch('./public/app/**', ['app', 'blade']);
});

gulp.task('default', ['css', 'scripts', 'app']);