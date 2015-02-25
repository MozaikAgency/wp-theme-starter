/**
 *
 *
 * @param achievement
 */
module.exports = function (achievement) {
	var exclamations = [
		'Sweet',
		'Awesome',
		'Epic',
		'Wow',
		'High Five',
		'Yay',
		'YEAH!',
		'Booyah'
	];

	return exclamations[Math.floor(Math.random()*exclamations.length)] + '! ' + achievement;
};