import path from "../configs/path.js";
import gulp from "gulp";
import plumber from "gulp-plumber";
import browserSync from "browser-sync";
import notify from "gulp-notify";

import sourceMaps from 'gulp-sourcemaps';
import groupmedia from "gulp-group-css-media-queries";

import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

const compileSass = () => {
    return gulp.src(path.src.sass, {sourcemaps: true})
        .pipe(plumber(
            notify.onError({
                title: "CSS",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(sourceMaps.init())
        .pipe(
            sass({
                outputStyle : "expanded"
            })
            .on('error', sass.logError)
        )
        .pipe(groupmedia())
        .pipe(sourceMaps.write("."))
        .pipe(sourceMaps.init({loadMaps: true}))
        .pipe(gulp.dest(path.build.css))
        .pipe(browserSync.stream());
}

export default compileSass
