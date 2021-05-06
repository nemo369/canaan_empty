// TODO: check https://github.com/wp-bond/boilerplate/blob/master/app/themes/boilerplate
export default {
    build: {
      // generate manifest.json in outDir
      manifest: true,
      target: 'es2018',
      // outDir: themeDir + '/dist',
      rollupOptions: {
        // overwrite default .html entry
        input: '/wp-content/themes/canaan/static/js/main.js'
      }
    },
    server: {
      // required to load scripts from custom host
      cors: true,
  
      // we need a strict port to match on PHP side
      //
      strictPort: true,
      port: 3000
      // if changed match here /templates/html/vite.php
    },
  }