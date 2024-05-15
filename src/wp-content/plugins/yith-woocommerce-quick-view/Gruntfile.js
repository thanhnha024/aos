const potInfo = {
  languageFolderPath: './languages/',
  filename          : 'yith-woocommerce-quick-view.pot',
  headers           : {
    "Project-Id-Version": "YITH WooCommerce Quick View",
    "Content-Type": "text/plain; charset=UTF-8",
    "Language-Team": "YITH <plugins@yithemes.com>",
    "poedit": true,
    "X-Poedit-KeywordsList": "__;_e;_n:1,2;__ngettext:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c,_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;esc_attr__;esc_attr_e;esc_attr_x:1,2c;esc_html__;esc_html_e;esc_html_x:1,2c",
    "X-Poedit-Basepath": "..",
    "X-Poedit-SearchPath-0": ".",
    "X-Poedit-SearchPathExcluded-0": "plugin-fw",
    "X-Poedit-SearchPathExcluded-1": "plugin-upgrade",
    "X-Poedit-SearchPathExcluded-2": "node_modules"
}
};

module.exports = function ( grunt ) {
  'use strict';

  grunt.initConfig( {
                        dirs: {
                            js : 'assets/js'
                        },

                        uglify: {
                            options: {
                                ie8   : true,
                                parse : {
                                    strict: false
                                },
                                output: {
                                    comments: /@license|@preserve|^!/
                                }
                            },
                            common: {
                                files: [{
                                    expand: true,
                                    cwd: '<%= dirs.js %>/',
                                    src: ["*.js", "!*.min.js"],
                                    dest: '<%= dirs.js %>/',
                                    ext: '.min.js',
                                    extDot: 'last'
                                }]
                            },
                        },

                        makepot: {
                            options: {
                                type         : 'wp-plugin',
                                domainPath   : 'languages',
                                headers      : potInfo.headers,
                                updatePoFiles: false,
                                processPot   : function ( pot ) {
                                    // Exclude plugin meta
                                    var translation,
                                        excluded_meta = [
                                            'Plugin Name of the plugin/theme',
                                            'Plugin URI of the plugin/theme',
                                            'Author of the plugin/theme',
                                            'Author URI of the plugin/theme'
                                        ];

                                    for ( translation in pot.translations[ '' ] ) {
                                        if ( 'undefined' !== typeof pot.translations[ '' ][ translation ].comments.extracted ) {
                                            if ( excluded_meta.indexOf( pot.translations[ '' ][ translation ].comments.extracted ) >= 0 ) {
                                                console.log( 'Excluded meta: ' + pot.translations[ '' ][ translation ].comments.extracted );
                                                delete pot.translations[ '' ][ translation ];
                                            }
                                        }
                                    }

                                    return pot;
                                }
                            },
                            dist   : {
                                options: {
                                    filename: potInfo.filename,
                                    exclude : [
                                        'bin/.*',
                                        'plugin-fw/.*',
                                        'plugin-upgrade/.*',
                                        'node_modules/.*',
                                        'tmp/.*',
                                        'vendor/.*'
                                    ]
                                }
                            }
                        },

                        update_po: {
                            options: {
                                template: potInfo.languageFolderPath + potInfo.filename
                            },
                            build  : {
                                src: potInfo.languageFolderPath + '*.po'
                            }
                        }

                    } );

  // Load NPM tasks to be used here.
  grunt.loadNpmTasks( 'grunt-wp-i18n' );
  grunt.loadNpmTasks( 'grunt-contrib-uglify' );

  // Register tasks.
  grunt.registerTask( 'js', ['uglify'] );
};
