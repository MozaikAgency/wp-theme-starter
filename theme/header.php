<?php
/**
 * Header file common to all
 * templates
 *
 */
?>
<!doctype html>
<html class="site" <?php language_attributes(); ?>>
<head>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width"/>

	<?php wp_head(); ?>
</head>
<body class="site__body">
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>