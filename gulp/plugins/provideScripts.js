var webpack   = require('webpack');

// utils
var deepMerge = require('../core/utils/deepMerge');

function addKey(obj, key, value) {
	var temp = {};
	temp[key] = value;
	return Object.assign({}, obj, temp);
}

function setProvider(scripts, script) {
	return script.local
		? addKey(scripts, script.local, script.package)
		: scripts;
}

function setExternal(scripts, script) {
	return script.global
		? addKey(scripts, script.package, script.global)
		: scripts;
}

module.exports = function provideScripts(scripts) {
	scripts = scripts
		.filter(function (script) {
			return script.package && (script.local || script.global);
		}).reduce(function (arr, script) {
			return arr.concat(
				Array.isArray(script.local)
					? script.local.reduce(function (agg, local) {
							return agg.concat({
								local: local,
								global: script.global,
								package: script.package
							});
						}, [])
					: script
			);
		}, []);

	return function provideTo(config) {
		config = config || {};

		var externals = scripts.reduce(setExternal, {});
		var providers = scripts.reduce(setProvider, {});

		return scripts.length
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