import path from "../configs/path.js";
import gulp from "gulp";
import plumber from "gulp-plumber";
import browserSync from "browser-sync";
import notify from "gulp-notify";

import imagemin from "gulp-imagemin";
import webp from "gulp-webp";

const processImages = () => {
    return gulp.src(path.src.img)
        .pipe(plumber(
            notify.onError({
                title: "Images",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(imagemin({
            progressive : true,
            svgoPlugins: [{removeViewBox: false}],
            interlaced: true,
            optimizationLevel: 4
        }))
        .pipe(webp())
        .pipe(gulp.dest(path.build.img))
        .pipe(browserSync.stream());
}


export default processImages
