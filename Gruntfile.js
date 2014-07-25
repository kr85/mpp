module.exports = function(grunt) {

  //Initializing the configuration object
    grunt.initConfig({

    // Task configuration
    less: {
        development: {
            options: {
              compress: false
            },
            files: {
              "./public/assets/stylesheets/frontend.css":"./app/assets/stylesheets/frontend.less",
              "./public/assets/stylesheets/backend.css":"./app/assets/stylesheets/backend.less"
            }
        }
    },
    concat: {
      options: {
        separator: ';'
      },
      js_frontend: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/frontend.js'
        ],
        dest: './public/assets/javascript/frontend.js'
      },
      js_backend: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/backend.js'
        ],
        dest: './public/assets/javascript/backend.js'
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      frontend: {
        files: {
          './public/assets/javascript/frontend.js': './public/assets/javascript/frontend.js'
        }
      },
      backend: {
        files: {
          './public/assets/javascript/backend.js': './public/assets/javascript/backend.js'
        }
      }
    },
    phpunit: {
        classes: {
            dir: 'app/tests/'
        },
        options: {
            bin: 'vendor/bin/phpunit',
            colors: true
        }
    },
    watch: {
        js_frontend: {
          files: [
            //watched files
            './bower_components/jquery/dist/jquery.js',
            './bower_components/bootstrap/dist/js/bootstrap.js',
            './app/assets/javascript/frontend.js'
            ],   
          tasks: ['concat:js_frontend','uglify:frontend'],
          options: {
            livereload: true
          }
        },
        js_backend: {
          files: [
            './bower_components/jquery/dist/jquery.js',
            './bower_components/bootstrap/dist/js/bootstrap.js',
            './app/assets/javascript/backend.js'
          ],   
          tasks: ['concat:js_backend','uglify:backend'],
          options: {
            livereload: true
          }
        },
        less: {
          files: ['./app/assets/stylesheets/*.less'],
          tasks: ['less'],
          options: {
            livereload: true
          }
        },
        tests: {
          files: ['app/controllers/*.php','app/models/*.php'],
          tasks: ['phpunit']
        }
      }
    });

  // Plugin loading
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('default', ['watch']);

};
