module.exports = {
  content: [
    'acf_blocks/**/*.js',
    'acf_blocks/**/*.php',
    'acf_blocks/**/*.html',
    '**/*.js',
    '**/*.php',
    '*.php',
    '**/*.html',
    '!node_modules/**',
    '!dist/**',
  ],
  css: [
    'acf_blocks/**/*.min.css',
  ],
  output: 'acf_blocks/',
  safelist: [],
  defaultExtractor: (content) => content.match(/[\w-/:]/g) || [],
}