module.exports = (() => {

  // NAMES
  const names = {
    theme:  'awp-demo',
    plugin: 'awp-demo'
  };

  // DIR
  const dir = {
    path: './html'
  };

  // CONTENT
  const content = {
    path: `${dir.path}/wp-content`
  };

  // PROJECT
  const project = {
    src:    './src',
    dest:   `${content.path}/themes/${names.theme}/dist`,
    theme:  `${content.path}/themes/${names.theme}`,
    plugin: `${content.path}/plugins/${names.plugin}`
  };

  // REV
  const rev = {
    manifest: `${project.dest}/rev-manifest.json`
  };

  // SCRIPTS
  const scripts = {
    src:     `${project.src}/scripts`,
    dest:    `${project.dest}/scripts`,
    adminWatch: `${project.src}/scripts/admin`,
    watch: [`${project.src}/scripts`, `!${project.src}/scripts/admin`],
    pattern: '/**/*.js',
    presets: ['es2015'],
    vendor: {
      vendor: ['lodash', 'babel-polyfill']
    },
    admin: {
      admin: `${project.src}/scripts/admin/admin.js`
    },
    entries: {
      app: `${project.src}/scripts/app.js`
    }
  };

  // STYLES
  const styles = {
    src:  `${project.src}/styles`,
    dest: `${project.dest}/styles`,
    pattern: '/**/*.{sass,scss}'
  };

  // FONTS
  const fonts = {
    src:  `${project.src}/fonts`,
    dest: `${project.dest}/fonts`,
    pattern: '/**/*.{eot,svg,ttf,woff,woff2}'
  };

  // IMAGES
  const images = {
    src:   `${project.src}/images`,
    dest:  `${project.dest}/images`,
    pattern: '/**/*.{gif,ico,jpeg,jpg,png,svg,webp}'
  };

  // SERVER
  const server = {
    proxy:     'https://localhost',
    whitelist: ['/wp-admin/admin-ajax.php'],
    blacklist: ['/wp-admin/**']
  };

  return {
    names: names,
    dir: dir,
    content: content,
    project: project,
    rev: rev,
    scripts: scripts,
    styles: styles,
    fonts: fonts,
    images: images,
    server: server
  };

})();
