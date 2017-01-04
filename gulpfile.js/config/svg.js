var config = require('./');

module.exports = {
  src: config.sourceAssets + "/images/svg/*.svg",
  dest: config.publicAssets + "/images/svg",
  settings: {
    mode: {
      symbol: {
        dest: './',
        sprite: 'svg-sprite.svg',
        prefix: 'icon-%s',
        inline: true
      }
    }
  }
};