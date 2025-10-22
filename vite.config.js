import { defineConfig } from 'vite'
import { glob } from 'glob'
import path from 'path'
import postcss from 'postcss'
import purgecss from '@fullhuman/postcss-purgecss'

export default defineConfig({
  build: {
    emptyOutDir: false,
    rollupOptions: {
      input: Object.fromEntries(
        [
          ...glob.sync('acf_blocks/*/*.js', { ignore: '**/**.min.js' }).map(file => [
            path.relative('acf_blocks', file).replace(/\.js$/, ''),
            path.resolve(file)
          ]),
          ...glob.sync('acf_blocks/*/*.scss').map(file => [
            path.relative('acf_blocks', file).replace(/\.scss$/, '') + '-style',
            path.resolve(file)
          ]),
          ...glob.sync('acf_blocks/*.js', { ignore: '**/**.min.js' }).map(file => [
            path.basename(file, '.js'),
            path.resolve(file)
          ]),
          ...glob.sync('acf_blocks/*.scss').map(file => [
            path.basename(file, '.scss') + '-style',
            path.resolve(file)
          ]),
        ]
      ),
      output: {
        dir: 'acf_blocks',
        entryFileNames: '[name].min.js',
        assetFileNames: '[name].min.css',
      },
    },
    minify: 'terser',
  },
  css: {
    postcss: {
      plugins: [
        purgecss({
          content: ['./**/*.php', './acf_blocks/**/*.js', './*.html'],
          defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
        }),
      ],
    },
  },
})