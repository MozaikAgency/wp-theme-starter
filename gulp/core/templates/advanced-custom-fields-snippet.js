var project = require('../../../project.config');

const dir = __dirname.replace('/gulp/core/templates', '');
const theme_name = (dir.substr(dir.lastIndexOf('/') + 1));

module.exports = [
    '\n\n\n',
    '/**',
    ' * DEVELOPMENT MODE ONLY',
    ' *',
    ' * Change the ACF location for saving config files',
    ' * (https://www.advancedcustomfields.com/resources/local-json)',
    ' *',
    ' * Run "gulp build" to generate the theme',
    ' * for production before deploying!',
    ' *',
    ' */',
    'if(class_exists(\'acf\')) {',
    '\tadd_filter(\'acf/settings/save_json\', function ($path) {',
    '\t\treturn get_theme_root() . \'/' + theme_name + '/theme/acf-json\';',
    '\t});',
    '}',
    ''
].join('\n');
