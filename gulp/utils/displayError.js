var notify = require('gulp-notify');

module.exports = function (error) {
	var errorString = '[' + error.plugin + ']';

	errorString += ' ' + error.message.replace("\n", '');
	if (error.fileName)
		errorString += ' in ' + error.fileName;
	if (error.lineNumber)
		errorString += ' on line ' + error.lineNumber + '.';

	notify({
		title: "Gulp Error",
		message: errorString
	});
};