module.exports = [
	'\n\n\n',
	'/**',
	' * DEVELOPMENT MODE ONLY',
	' *',
	' * Browser-sync script loader',
	' * to enable script/style injection',
	' *',
	' * Run "gulp build" to generate the theme',
	' * for production before deploying!',
	' *',
	' */',
	'add_action( \'wp_head\', function () { ?>',
	'\t<script type="text/javascript" id="__bs_script__">//<![CDATA[',
	'\t\tdocument.write("<script async src=\'http://HOST:3000/browser-sync/browser-sync-client.js\'><\\/script>".replace("HOST", location.hostname));',
	'\t//]]></script>',
	'<?php }, 999);'
].join('\n');