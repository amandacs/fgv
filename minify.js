var initConfig = {
    build: {
        src: __dirname
    },
    config: {
        ignored: ['View/Emails/', 'View/Layouts/*/', 'node_modules/', '.idea/', 'Minified/']
    }
};

var cm = require('./node_modules/cake-minifier/index.js');

cm.minify(initConfig.build.src, initConfig.config.ignored)