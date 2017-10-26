// == Gulp Require Modules == //
var gulp =            require('gulp'),
    sass =            require('gulp-ruby-sass'),
    autoprefixer =    require('gulp-autoprefixer'),
    cssmin =          require('gulp-cssmin'),
    rename =          require('gulp-rename'),
    concat =          require('gulp-concat'),
    uglify =          require('gulp-uglify'),
    livereload =      require('gulp-livereload'),
    plumber =         require('gulp-plumber'),
    imagemin =        require('gulp-imagemin'),
    pngcrush =        require('imagemin-pngcrush'),
    mainBowerFiles =  require('main-bower-files'),
    filter =          require('gulp-filter'),
    clean =           require('gulp-clean'),
    less =            require('gulp-less');

// == STYLES TASKS == //

// = Only compiles SASS and autoprefixes = //
gulp.task('styles-dev', function() {
  return gulp.src('public/css/*.less')
    .pipe(plumber())
    .pipe(less({}))
    .pipe(autoprefixer())
    .pipe(gulp.dest('public/css/'));
});

// == WATCH TASKS == //

// = Watches all SASS, JS, and the image folder for any changes, then runs the appropriate task.
// = Also watches all PHP, CSS, JS and the image folder in the dist folder for any changes then triggers livereload
gulp.task('watch', function() {
  gulp.watch('public/css/*.less', ['styles-dev']);

  livereload.listen();
  gulp.watch('public/css/*.css').on('change', livereload.changed);
});


// == GULP TASKS == //
gulp.task('dev', ['styles-dev']);
// = Default Task = //
gulp.task('default', ['dev', 'watch']);