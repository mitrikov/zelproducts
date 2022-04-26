const {src, dest, parallel, series, watch} = require('gulp');
const bs = require('browser-sync');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');


let browserSync = () => {
    bs.init({
        server : { baseDir: 'assets/'},
        notify : false,
        online : true
    });
}

let scripts = () => {
    return src([
        'assets/js/customizer.js',
        'assets/js/ajax-search.js',
        'assets/js/sweetalert2.all.min.js',
        'assets/js/map.js'
    ])
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(dest('assets/js/'));
}

//scripts();

exports.bs = bs;
exports.scripts = scripts;