module.exports = {
  root: true,
  extends: [
    'eslint:recommended',
    'plugin:vue/base',
    'plugin:vue/vue3-essential',
    'plugin:vue/vue3-recommended',
    'plugin:vue/vue3-strongly-recommended',
  ],
  plugins: [ 'unused-imports' ],
  env: {
    // 'browser': true,
    // 'commonjs': true,
    // 'es6': true,
    'jquery': true,
  },
  ignorePatterns: [ '**/plugins/**/*.js', 'resources/assets/js/modernizr.js' ],
  rules: {
    // 'vue/require-default-prop': [ 'error' ],
    'array-bracket-spacing': [ 'error', 'always' ],
    'object-curly-spacing': [ 'error', 'always' ],
    'computed-property-spacing': [ 'error', 'always' ],
    'space-in-parens': [ 'error', 'always', { 'exceptions': [ 'empty' ] } ],
    semi: [ 'error', 'always' ], // Enforce semicolons
    'no-undef': [ 'off' ],
    'no-unused-vars': [ 'off' ],
    'comma-dangle': [ 'error', 'always-multiline' ], // Enforce dangling commas
    'indent': [ 'error', 2, { 'SwitchCase': 1 } ],
    'no-console': [ 'error' ],
    'space-infix-ops': [ 'error' ],
    'padding-line-between-statements': [
      'error',
      { blankLine: 'always', prev: 'var', next: 'return' },
      { blankLine: 'always', prev: '*', next: 'if' },
      { blankLine: 'always', prev: '*', next: 'export' },

    ],
    'keyword-spacing': [ 'error', { 'before': true, 'after': true } ],
    'space-before-blocks': 'error',
    'space-before-function-paren': 'error',
    'no-multi-spaces': 'error',
    'comma-spacing': [ 'error', { 'before': false, 'after': true } ],
    'no-multiple-empty-lines': 'error',
    'quotes': [ 'error', 'single' ],
    'eqeqeq': [ 'error', 'always' ],
    'key-spacing': [ 'error' ],

    'vue/no-static-inline-styles': [ 'error' ],
    'vue/max-attributes-per-line': [ 'error' ],
    'vue/html-indent': [ 'error' ],
    'vue/html-closing-bracket-newline': [ 'error' ],
    'vue/multiline-html-element-content-newline': [ 'error' ],
    'vue/require-prop-types': [ 'error' ],
    'vue/require-default-prop': [ 'error' ],
    'vue/attributes-order': [ 'error' ],
    'vue/no-template-shadow': [ 'error' ],

    'unused-imports/no-unused-imports': 'error',
    'unused-imports/no-unused-vars': [
      'warn',
      { 'vars': 'all', 'varsIgnorePattern': '^_', 'args': 'after-used', 'argsIgnorePattern': '^_' },
    ],
  },
};
