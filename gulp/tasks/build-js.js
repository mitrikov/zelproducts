import path from "../configs/path.js";
import gulp from "gulp";
import plumber from "gulp-plumber";
import browserSync from "browser-sync";
import notify from "gulp-notify";

import webpack  from "webpack-stream";

const buildJs = () => {
    return gulp.src(path.src.js, {sourcemaps: true})
        .pipe(plumber(
            notify.onError({
                title: "JS",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(webpack({
            mode: "development",
            output: {
                filename: "main.min.js"
            }
        }))
        .pipe(gulp.dest(path.build.js))
        .pipe(browserSync.stream());
}

export default buildJs
