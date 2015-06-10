<?php
$dir    = get_theme_root();
//echo $dir; 
$files = scandir($dir, 1);

foreach($files as $file)

{	
	preg_match_all('/^.*child.*$/im', $file, $matches, PREG_PATTERN_ORDER);

	if($file !='index.php' && $file !='.' && $file !='..' && $matches[0][0] =='' )
	{
	
	$opts .= '<option value="'.$file.'">'.$file.'</option>';
	}
}

/*Submit Actions*/
$ect_parent = "ect_parenttheme";

if(isset($_POST["submit"])){
	$ect_show = $_POST[$ect_parent];
	$dir_name = $dir."/".$ect_show."-child";
	if (file_exists($dir_name)) {
		echo '<div id="message" class="error fade"><p>Child Theme '.$dir_name.' Already Exists.</p></div>';

	}
	else{
	update_option($ect_parent, $ect_show);
	mkdir($dir_name, 0755);
	$content  = '/*'.PHP_EOL;
	$content .= 'Theme Name: '.$ect_show.' Child'.PHP_EOL;
	$content .= 'Theme Uri:  http://ashokg.in'.PHP_EOL;
	$content .= 'Author:     wpashokg'.PHP_EOL;
	$content .= 'Author Uri: http://ashokg.in'.PHP_EOL;
	$content .= 'Template:   '.$ect_show.PHP_EOL;
	$content .= 'Version:    1.0'.PHP_EOL;
	$content .= 'License:    GNU General Public License v2 or later'.PHP_EOL;
	$content .= 'Version:    1.0'.PHP_EOL;
	$content .= '*/';
	
	$php_content = "<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}";
	
	$fp = fopen($dir_name.'/style.css','wb');
	fwrite($fp,$content);
	fclose($fp);
	
	$create_functions = fopen($dir_name.'/functions.php','wb');
	fwrite($create_functions,$php_content);
	fclose($create_functions);
	


	echo '<div id="message" class="updated fade"><p>Child Theme Created Successfully</p></div>';
	}
}
else{
	$ect_show = get_option($ect_parent);
}

/*Submit Actions*/
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Welcome To Easy Child Theme Creator</h2>
</div>
<?php if(isset($_GET['action'])) { $menu = $_GET['action']; } else { $menu = ''; } ?>
<h2 class="nav-tab-wrapper">
    <a href="?page=easy-ctc&action=create" class="nav-tab <?php if($menu=='create') { echo 'nav-tab-active'; } ?>">Create Child Theme</a>
    <a href="?page=easy-ctc&action=overview" class="nav-tab <?php if($menu=='overview' || $menu == '') { echo 'nav-tab-active'; } ?>">Overview</a>
</h2>
<?php if($menu=='create') { ?>
<fieldset>
    <legend>Select A Parent Theme</legend>
    <form method="post" action=""> 
        <select name="ect_parenttheme"><option value="">Select A Parent Theme</option><?php echo $opts; ?></select>
       
        <p><input type="submit" value="Create" class="button button-primary" name="submit" /></p>
    </form>
</fieldset>
<?php   }  ?>

<?php if($menu=='overview' || $menu=='') { ?>
<fieldset>
    <h2>OverView</h2>
    <p>Welcome to Easy Child Theme Creator!</p>
    <p>This is a simple effort to create a child theme easily so that it would be in the proper standards.</p>
    <p><h3>Future Updates.</h3><ul><li>Template Cration</li><li>Configurations etc.,</li></ul></p>
    
    
   
</fieldset>
<?php   }  ?>
