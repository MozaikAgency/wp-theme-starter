module.exports = [
	'\n\n\n',
	'/**',
	' * DEVELOPMENT MODE ONLY',
	' *',
	' * Browser-sync script loader',
	' * to enable script/style injection',
	' *',
	' */',
	'add_action( \'wp_footer\', function () { ?>',
		'\t<script type="text/javascript" id="__bs_script__">//<![CDATA[',
			'\t\tdocument.write("<script async src=\'http://HOST:3000/browser-sync/browser-sync-client.2.2.2.js\'><\\/script>".replace("HOST", location.hostname));',
		'\t//]]></script>',
	'<?php }, 999);'
].join('\n');