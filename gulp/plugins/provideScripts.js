var webpack   = require('webpack');

// utils
var deepMerge = require('../core/utils/deepMerge');


/**
 * Return a new object extended
 * from the given object with the
 * given key-value pair set on
 * it
 *
 * @param obj
 * @param key
 * @param value
 * @returns {*}
 */
function addKey(obj, key, value) {
	var temp = {};
	temp[key] = value;
	return Object.assign({}, obj, temp);
}


/**
 * Return an object mapping a local
 * variable to a given package
 *
 * @param scripts
 * @param script
 * @returns {*}
 */
function setProvider(scripts, script) {
	return script.local
		? addKey(scripts, script.local, script.package)
		: scripts;
}


/**
 * Return an object mapping a package
 * to a given global variable
 *
 * @param scripts
 * @param script
 * @returns {*}
 */
function setExternal(scripts, script) {
	return script.global
		? addKey(scripts, script.package, script.global)
		: scripts;
}


/**
 * Make sure the given script is
 * valid
 *
 * @param script
 * @returns {*|string|string|string|string|Array}
 */
function hasValidConfig(script) {
	return script.package && (script.local || script.global);
}


/**
 * Explode script configs with an
 * array of local variables names
 * to be able to map each variable
 * to a package individually
 *
 * @param scripts
 * @param script
 * @returns {Array.<T>|string|*|{dist}}
 */
function extractNestedConfig(scripts, script) {
	return scripts.concat(
		Array.isArray(script.local)
			? script.local.reduce(function (extracted, local) {
					return extracted.concat({
						local: local,
						global: script.global,
						package: script.package
					});
				}, [])
			: script
	);
}


/**
 * Return a decorator for the scripts
 * config object to add library script
 * configuration
 *
 * @example:
 *    // in ./gulp/config/scripts.js
 *    var provideScripts = require('../plugins/provideScripts');
 *
 *    var provideLibs = provideScripts([
 *      // map the local var `$` and the package `jquery` to the global var `jQuery`
 *      {local: '$', package: 'jquery', global: 'jQuery'},
 *
 *      // map the local vars `ko` & `k` to the package `ko`
 *      {local: ['ko', 'k'], package: 'ko'},
 *
 *       // map the package `lodash` to the global variable `_`
 *      {package: 'lodash', global: '_'}
 *    ]);
 *
 *    module.exports = provideLibs();
 *
 * @param scripts array
 * @returns {Function}
 */
module.exports = function provideScripts(scripts) {
	scripts = scripts || [];

	var validScripts = scripts
		.filter(hasValidConfig)
		.reduce(extractNestedConfig, []);

	return function provideTo(config) {
		config = config || {};

		var externals = validScripts.reduce(setExternal, {});
		var providers = validScripts.reduce(setProvider, {});

		return validScripts.length
			? deepMerge({
					options: {
						webpack: {
							defaults: {
								externals: externals,
								plugins: providers
									? [new webpack.ProvidePlugin(providers)]
									: []
							}
						}
					}
				}, config)
			: config;
	};
};
