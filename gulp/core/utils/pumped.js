/**
 * Booyah! Prefix your Gulp notifications
 * with a <Legendary> exclamation!
 *
 * @author Max GJ Panas <http://maxpanas.com/>
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

	var randomIndex = Math.floor(Math.random() * exclamations.length);

	return [exclamations[randomIndex], '! ', achievement].join('');
};