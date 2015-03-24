<?php
/**
 * Header file common to all
 * templates
 *
 * @author: Mozaik Ltd. <http://mozaik.com>
 */
?>
<!doctype html>
<html class="site" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width"/>

	<?php wp_head(); ?>
</head>
<body class="site__body">
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>