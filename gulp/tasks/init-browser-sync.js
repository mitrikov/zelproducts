import browserSync from "browser-sync";
//import path from "../configs/path";

const initBrowserSync = () => {
    browserSync.init({
        proxy: {
            target: "http://zelproducts"
        },
        
        port: 6861,
        notify: false
    });
}

export default initBrowserSync
