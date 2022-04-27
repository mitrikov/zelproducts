import path from "../configs/path.js";
import gulp from "gulp";
import plumber from "gulp-plumber";
import notify from "gulp-notify";

import config from "../configs/ftp.js";
import ftp from "vinyl-ftp";

const ftpDeploy = () => {
    config.log = util.log;
    const connection = ftp.create(config);
    return gulp.src(path.ftp.src, {})
            .pipe(plumber(
                notify.onError({
                    title: "FTP",
                    message: "Error: <%= error.message %>"
                })
            ))
            .pipe(connection.dest(path.ftp.remoteFolder));
}

export default ftpDeploy
