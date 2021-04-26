export default {
    build: {
      // generate manifest.json in outDir
      manifest: true,
      rollupOptions: {
        // overwrite default .html entry
        input: '/wp-content/themes/canaan/static/js/main.js'
      }
    }
  }