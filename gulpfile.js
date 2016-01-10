var gulp = require('gulp');
var less = require('gulp-less');
var coffee = require('gulp-coffee');


gulp.task('less', function () {
    gulp.src('./resources/assets/less/*.less')
        .pipe(less())
        .pipe(gulp.dest('./web/assets/css'));
});

gulp.task('coffee', function() {
    gulp.src('./resources/assets/coffee/*.coffee')
        .pipe(coffee({bare: true}))
        .pipe(gulp.dest('./web/assets/js'));
});