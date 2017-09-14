module.exports = (gulp, config, patternlab, plRev, plConfig, isProduction, plugins, fs, replace, runSequence) => {

  const plsrc = plConfig.paths.source;
  const plpub = plConfig.paths.public;
  const head = [plsrc.root + '_meta/_00-head.mustache'];
  const foot = [plsrc.root + '_meta/_01-foot.mustache'];

  gulp.task('pl-copy-styleguide', () => gulp
    .src([`${plsrc.styleguide}**/*`, `!${plsrc.styleguide}**/*.css`])
    .pipe(gulp.dest(plpub.root))
  );

  gulp.task('pl-copy-styleguide-css', () => gulp
    .src(`${plsrc.styleguide}**/*.css`)
    .pipe(plugins.flatten())
    .pipe(gulp.dest(plpub.styleguide + 'css'))
  );

  gulp.task('pl-copy-favicon', () => gulp
    .src(`${plsrc.root}favicon.ico`)
    .pipe(gulp.dest(config.dir.path))
  );

  gulp.task('pl-assets', (cb) => {
    runSequence(['pl-copy-styleguide', 'pl-copy-styleguide-css', 'pl-copy-favicon'], cb);
  });

  gulp.task('pl-rev', function () {
    if (isProduction) {
      fs.readFile(config.rev.manifest, 'utf8', (err, data) => {
        if (err) {
          throw err;
        }
        const manifest = JSON.parse(data);
        plRev(manifest, head, foot, replace);
      });
    } else {
      const manifest = false;
      plRev(manifest, head, foot, replace);
    }
  });

  gulp.task('patternlab-build', (cb) => {
    patternlab.build(cb, plConfig.cleanPublic);
  });

  gulp.task('pl-build', (cb) => {
    runSequence('pl-rev', 'pl-assets', 'patternlab-build', cb);
  });

  gulp.task('pl-watch', (cb) => runSequence('pl-build', 'reload', cb));
};
