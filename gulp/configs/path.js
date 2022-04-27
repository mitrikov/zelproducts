const folder = {
    //root: nodePath.basename(nodePath.resolve()),
    source: "src",
    build: "assets_test"
}

const path = {
    src : {
        html : `${folder.source}/*.html`,
        sass : `${folder.source}/sass/style.sass`,
        css : `${folder.source}/css/*.css`,
        js : `${folder.source}/js/main.js`,
        img : `${folder.source}/img/**/*.{jpg,png,svg,gif,ico,webp}`,
    },

    build : {
        html : `${folder.build}/`,
        css :  `${folder.build}/css/`,
        js : `${folder.build}/js/`,
        img : `${folder.build}/img/`,
        fonts : `${folder.build}/fonts/`,
        data : `${folder.build}/data/`
    },

    watch : {
        html : `${folder.source}/**/*.html`,
        sass : `${folder.source}/sass/**/*.{sass,css}`,
        js : `${folder.source}/js/**/*.js`,
        img : `${folder.source}/img/**/*.{jpg,png,svg,gif,ico,webp}`,
    },

    ftp : {
        src : `${folder.build}/**/*.*`,
        remoteFolder : ``
    },
    clean : `${folder.build}/**/*.*`,
    folder : folder
}

export default path
