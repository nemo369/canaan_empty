// MORE OPTIONS: https://github.com/i18next/i18next-scanner

// eslint-disable-next-line no-undef
module.exports = {
  options: {
    fallbackLng: 'en',
    debug: true,
    sort: true,
    func: {
      list: ['pll__', 'pll_e'],
      extensions: ['.php'],
    },
    attr: {
      list: ['data-i18n'],
      extensions: ['.php']
  },
    lngs: ['en'],
    ns: ['common'],
    defaultLng: 'en',
    defaultNs: 'common',
    interpolation: {
      prefix: '{{',
      suffix: '}}',
    },
    defaultValue: (lng, ns, key) => key,

    // Location of translation files
    resource: {
      loadPath: 'wp-content/themes/canaan/framework/pll/{{lng}}.json',
      savePath: 'wp-content/themes/canaan/framework/pll/{{lng}}.json',
      jsonIndent: 4,
    },

    nsSeparator: ':',
    keySeparator: '.',
  },
};
