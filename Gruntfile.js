module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    watch: {
      scripts: {
        files: ['Resources/less/**/*.less'],
        tasks: ['less'],
        options: {
          spawn: false,
        },
      },
    },

    less: {
      development: {
        options: {
            paths: ['Resources/less/mixins','Resources/less']  ,
          compress: false,
          yuicompress: false,
          syncImport: true,
          strictImports: true
          
        },
        files: {
          "Resources/public/css/style.css": "Resources/less/style.less" // destination file and source file
        }
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');


  // Default task(s).
  grunt.registerTask('default', ['less']);

};



              