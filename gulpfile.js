"use strict";

import gulp from "gulp";

import path from "./gulp/configs/path.js";

import compileSass from "./gulp/tasks/compile-sass.js";
import buildJs from "./gulp/tasks/build-js.js";
import processImages from "./gulp/tasks/process-images.js";
import initBrowserSync from "./gulp/tasks/init-browser-sync.js";
import cleanBuildDirectory from "./gulp/tasks/clean-build-directory.js";
import ftpDeploy from "./gulp/tasks/ftp-deploy.js";


const watchFiles = () => {
    //gulp.watch([path.watch.html], html);
    gulp.watch([path.watch.sass], compileSass);
    gulp.watch([path.watch.js], buildJs);
    gulp.watch([path.watch.img], processImages);
    //gulp.watch([path.watch.data], copyData);
}

//let build = gulp.series(cleanBuildDirectory, parallel(buildJs, compileSass, processImages));
let build = gulp.series(gulp.parallel(buildJs, compileSass, processImages));
let watch = gulp.parallel(build, watchFiles, initBrowserSync);

gulp.task("images", processImages); 
gulp.task("js", buildJs);
gulp.task("sass", compileSass);
//gulp.task("html", html);
gulp.task("deploy", ftpDeploy);
gulp.task("clean", cleanBuildDirectory);
gulp.task("build", build);
gulp.task("watch", watch);
gulp.task("default", watch);


export const exports = {
    images : processImages,
    js : buildJs,
    css : compileSass,
    //html: html,
    clean : cleanBuildDirectory,
    //json : copyData,
    build : build,
    watch : watch,
    default : watch
}
