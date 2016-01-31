module.exports = function(grunt) {

  // подключаем плагин load-grunt-tasks, чтобы не перечислять все прочие плагины
  require('load-grunt-tasks')(grunt);

  // описываем те задачи, которые планируем использовать
  grunt.initConfig({

    // компилируем препроцессор
    less: {
      style: {
        options: {
          compress: false,
          yuicompress: false,
          optimization: 2,
        },
        files: {
          // в какой файл, из какого файла
          'assets/css/style.css': ['assets/less/style.less']
        },
      }
    },

    // обрабатываем postcss-ом (там только autoprefixer, на самом деле)
    postcss: {
      options: {
        processors: [
          // автопрефиксер и его настройки
          require("autoprefixer")({browsers: "last 2 versions"})
        ]
      },
      style: {
        // какие файлы обрабатывать (все .css в указанной папке)
        src: "assets/css/*.css"
      }
    },

    // объединяем медиавыражения
    cmq: {
      style: {
        files: {
          // в какой файл, из какого файла (тут они совпадают)
          'assets/css/style.css': ['assets/css/style.css']
        }
      }
    },

    // минимизируем стилевые файлы
    cssmin: {
      style: {
        options: {
          keepSpecialComments: 0
        },
        files: [{
          expand: true,
          // в какой папке брать исходники
          cwd: 'assets/css',
          // какие файлы (ЛЮБОЕ_ИМЯ.css, но не ЛЮБОЕ_ИМЯ.min.css)
          src: ['*.css', '!*.min.css'],
          // в какую папку писать результат
          dest: 'assets/css',
          // какое расширение дать результатам обработки
          ext: '.min.css'
        }]
      }
    },

    // слежение за файлами
    watch: {
      // следить за стилями
      style: {
        // за сохранением каких файлов следить
        files: ['assets/less/**/*.less'],
        // какую задачу при этом запускать (сами задачи — см. ниже)
        tasks: ['style'],
        options: {
          spawn: false,
        },
      },
    },

  });



  // задача по умолчанию
  grunt.registerTask('default', [
    'style',
    'watch'
  ]);

  // только компиляция стилей
  grunt.registerTask('style', [
    'less',
    'postcss',
    'cmq',
    'cssmin',
  ]);

};
