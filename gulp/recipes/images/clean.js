var del     = require('del');
var project = require('../../../package.json');


/**
 * Delete all images
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (cb) {
	del(['../' + project.name + '/assets/img/**/*.{gif,ico,jpg,jpeg,png,webp}'], { force: true }, cb);
};