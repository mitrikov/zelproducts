import path from "../configs/path.js";
import gulp from "gulp";
import plumber from "gulp-plumber";
import browserSync from "browser-sync";
import notify from "gulp-notify";

import fileInclude from "gulp-file-include";
import webpHtmlNosvg from "gulp-webp-html-nosvg";

const html = () => {
    return gulp.src(path)
        .pipe(plumber(
            notify.onError({
                title: "HTML",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(fileInclude())
        .pipe(webpHtmlNosvg())
        .pipe(gulp.dest(path.build.html))
        .pipe(browserSync.stream());
}

export default html
