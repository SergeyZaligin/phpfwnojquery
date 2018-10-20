const gulp = require("gulp");
const sass = require("gulp-sass");
const autoprefixer = require("gulp-autoprefixer");
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const imageminJpegRecompress = require('imagemin-jpeg-recompress');
const pngquant = require('imagemin-pngquant');
const cssnano = require("gulp-cssnano");
const plumber = require("gulp-plumber");

const uglify = require('gulp-uglifyjs');
const babel = require('gulp-babel');

gulp.task("scss", () => {
  return gulp
    .src("dev/scss/**/*.scss")
    .pipe(plumber())
    .pipe(sass())
    .pipe(
      autoprefixer(["last 15 versions", "> 1%", "ie 8", "ie 7"], {
        cascade: true
      })
    )
    .pipe(cssnano({
                discardComments: {
                    removeAll: true,
                },
            }))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest("public/css"));
});


gulp.task('js', function() {
  return gulp
    .src([
        "dev/js/libs/jquery.js",
        "dev/js/libs/jquery-ui.js",
        "dev/js/libs/jquery.cookie.js",
        "dev/js/libs/jquery.accordion.js",
        "dev/js/libs/jquery.validate.js",
        "dev/js/modules/libsinit.js",
        "dev/js/modules/registration.js",
        "dev/js/main.js"
     ])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(plumber())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/js/'));
  });

gulp.task('img', function() {
  return gulp
    .src('dev/images/**/*')
    .pipe(imagemin([
      imagemin.gifsicle({interlaced: true}),
      imagemin.jpegtran({progressive: true}),
      imageminJpegRecompress({
        loops: 5,
        min: 55,
        max: 55,
        quality: 'low'
      }),
      imagemin.svgo(),
      imagemin.optipng({optimizationLevel: 3}),
      pngquant({quality: '55-60', speed: 5})
    ],{
      verbose: true
    }))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/images'));
  });

gulp.task("default", ["scss", "img", "js"], () => {
  gulp.watch("dev/scss/**/*.scss", ["scss"]);
  gulp.watch("dev/images/**/*", ["img"]);
  gulp.watch("dev/js/**/*", ["js"]);
});
