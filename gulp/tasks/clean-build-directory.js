import path from "../configs/path.js";
import clean from "gulp-clean";

const cleanBuildDirectory = () => {
    return src(path.folder.build, {read: false, allowEmpty: true})
        .pipe(clean());
}

export default cleanBuildDirectory
