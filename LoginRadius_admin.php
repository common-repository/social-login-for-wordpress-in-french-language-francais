<?php 
/**
 * Add the LoginRadius menu to the Settings menu
 * @param boolean $force if set to true, force updates the settings.
 */
function LoginRadius_restore_config($force=false) {
if ( $force or !( get_option('LoginRadius_apikey')) ) {
		update_option('LoginRadius_apikey',false);
	}
	
if ( $force or !( get_option('LoginRadius_secret')) ) {
		update_option('LoginRadius_secret',false);
	}
if ( $force or !( get_option('dummyemail')) ) {
		update_option('dummyemail',false);
	}	
if ( $force or !( get_option('LoginRadius_redirect')) ) {
		update_option('LoginRadius_redirect',false);
	}	
if ( $force or !( get_option('title')) ) {
		update_option('title',false);
	}	
}
/**
 * Displays the LoginRadius admin menu, first section (re)stores the settings.
 */
function LoginRadius_submenu() {
	global $LoginRadius_known_sites, $LoginRadius_date, $LoginRadiuspluginpath;
    if (isset($_REQUEST['restore']) && $_REQUEST['restore']) {
		check_admin_referer('LoginRadius-config');
		LoginRadius_restore_config(true);
		LoginRadius_message(__("Restaure` tous les parame`tres par de`faut.", 'LoginRadius'));
	} 
	else if (isset($_REQUEST['save']) && $_REQUEST['save']) {
	
	if (isset($_POST['LoginRadius_apikey']) && $_POST['LoginRadius_apikey']!="") {
			update_option('LoginRadius_apikey',$_POST['LoginRadius_apikey']);
		} else {
			LoginRadius_message(__("Vous devez avoir besoin une cle` API Connexion Rayon Pour processus de login.", 'LoginRadius'));
		}
		if (isset($_POST['LoginRadius_secret']) && $_POST['LoginRadius_secret']!="") {
			update_option('LoginRadius_secret',$_POST['LoginRadius_secret']);
		} else {
			LoginRadius_message(__("Vous devez avoir besoin d'un secret Radius connecter Api Pour processus de login.", 'LoginRadius'));
		}
		if (isset($_POST['title']) && $_POST['title']!="") {
			update_option('title',$_POST['title']);
		} else {
			update_option('title',$_POST['title']=='S\'il vous plait Connexion avec');
		}
		if (isset($_POST['dummyemail'])==true && $_POST['dummyemail']!="") {
			update_option('dummyemail',$_POST['dummyemail']==true);
		} else {
			update_option('dummyemail',$_POST['dummyemail']==false);
		}
		$LoginRadius_redirect = $_POST['LoginRadius_redirect'];
		if ($LoginRadius_redirect=='samepage' && $LoginRadius_redirect!="") {
		$samepage = 'checked';
			update_option('LoginRadius_redirect',$LoginRadius_redirect);
		} 
		if ($LoginRadius_redirect=='homepage' && $LoginRadius_redirect!="") {
		$homepage = 'checked';
			update_option('LoginRadius_redirect',$LoginRadius_redirect);
		} 
		else if($LoginRadius_redirect=='dashboard'){
		$dashboard = 'checked';
			update_option('LoginRadius_redirect',$LoginRadius_redirect);
		}
		else if($LoginRadius_redirect=='custom'){
		$custom = 'checked';
			update_option('LoginRadius_redirect',$LoginRadius_redirect);
		}
		else{
		update_option('LoginRadius_redirect',$LoginRadius_redirect=='samepage');
		}
		if($LoginRadius_redirect=='custom' && $custom == 'checked' && isset($_POST['LoginRadius_redirect_custom_redirect'])!="")
		{
		update_option('LoginRadius_redirect_custom_redirect',$_POST['LoginRadius_redirect_custom_redirect']);
		}
		if($LoginRadius_redirect=='custom' && $custom == 'checked' && $_POST['LoginRadius_redirect_custom_redirect']=="")
		{
			LoginRadius_message(__("Vous avez besoin d'un URL de redirection pour la redirection de connexion.", 'LoginRadius'));
		}
		
		check_admin_referer('LoginRadius-config');
		LoginRadius_message(__("modifications enregistre`es.", 'LoginRadius'));
	}
	/**
	 * Display options.
	 */?>
<form action="<?php echo attribute_escape( $_SERVER['REQUEST_URI'] ); ?>" method="post">
<?php if ( function_exists('wp_nonce_field') )
		wp_nonce_field('LoginRadius-config');?>

<div class="wrap">
	<?php //screen_icon();?>
	<h2><?php _e("Re`glages <b style='color:#00ccff;'>Login</b><b>Radius</b>", 'LoginRadius'); ?></h2>
	<div class="LoginRadius_container_outer">
		<div class="LoginRadius_container">
			<h3>Merci pour l'installation de plugin LoginRadius!</h3><p>
Vous pouvez se`lectionner les parame`tres souhaite`s pour votre plugin sur cette page. Bien que vous pouvez choisir les fournisseurs d'identite` et peut obtenir la cle` <strong> API LoginRadius and Secret </strong>en vous connectant a` <a href="http://www.LoginRadius.com" target="_blank">www.LoginRadius.com.</a>  Afin de rendre le processus de connexion hautement se`curise`e l'ensemble, nous vous demandons de le ge`rer depuis votre compte LoginRadius.</p>
<p><strong>LoginRadius</strong> est une socie`te` en Ame`rique du Nord la technologie qui offre de connexion sociale a` travers ho`tes populaires tels que Facebook, Twitter, Google et plus de 15 autres! Pour le support technique ou des questions, s'il vous plait contactez-nous au hello@loginradius.com.</strong></p><h3>Nous sommes jusqu'a` 24x7 pour aider nos clients!</h3>
<p>
<a class="button-secondary" href="http://www.loginradius.com/" target="_blank"><strong>Cre`ez votre compte gratuit !</strong></a>
</p>
		</div>
		<div class="LoginRadius_container_inner">
		<h3 style="color:black;">Aide plugin</h3>
		<p><ul class="LoginRadius_container_links">
		<li><a href="http://www.loginradius.com/loginradius/plugins.aspx" target="_blank">Documentation</a></li>
		<li><a href="http://wordpress.org/extend/plugins/loginradius-for-wordpress/" target="_blank">page plugin</a></li>
		<li><a href="http://wordpressdemo.loginradius.com/" target="_blank">Site de Live Demo</a></li>
		<li><a href="http://www.loginradius.com/loginradius/" target="_blank">A` propos LoginRadius</a></li>
		<li><a href="http://blog.loginradius.com/" target="_blank">Blog LoginRadius</a></li>
		<li><a href="http://www.loginradius.com/loginradius/plugins.aspx" target="_blank">Autres plugins LoginRadius</a></li>
		
		<li><a href="http://www.loginradius.com/loginradius/writetous.aspx" target="_blank">Tech Support</a></li>
		<br /><br />
		</ul>
        </p>
		</div>
	</div>
	<table class="form-table LoginRadius_table">
	<tr>
	<th class="head" colspan="2">LoginRadius Settings API</small></th>
	</tr>
	<tr >
	<th scope="row">LoginRadius<br /><small>API Key</small></th>
	<td><?php _e("Coller cle`s API LoginRadius ici. Pour obtenir la cle` API, connectez-vous a`  
<a href='http://www.LoginRadius.com/' target='_blank'>LoginRadius.</a>", 'LoginRadius'); ?><br/>
<input size="60" type="text" name="LoginRadius_apikey" id="LoginRadius_apikey" value="<?php echo get_option('LoginRadius_apikey' ); ?>" /></td>
	</tr>
	<tr >
	<th scope="row">LoginRadius<br /><small>API Secret</small></th>
	<td><?php _e("Coller LoginRadius API secret ici. Pour obtenir le secret de l'API, connectez-vous a` <a href='http://www.LoginRadius.com/' target='_blank'>LoginRadius.</a>", 'LoginRadius'); ?><br/>
		<input size="60" type="text" name="LoginRadius_secret" id="LoginRadius_secret" value="<?php echo get_option('LoginRadius_secret'); ?>" /></td>
	</tr>
	</table>
	<table class="form-table LoginRadius_table">
	<tr>
	<th class="head" colspan="2">LoginRadius Parame`tres de base</small></th>
	</tr>
	<tr>
	<th scope="row">Titre</th>
	<td><?php _e("Ce texte displyed au-dessus du bouton de connexion sociale.", 'LoginRadius'); ?>
	<br />
<input type="text"  name="title" size="60" value="<?php if(htmlspecialchars(get_option('title'))){echo htmlspecialchars(get_option('title'));}else{echo 'S`il vous plait Connexion avec';} ?>" />
</td>
	</tr>
	<tr>
	<th scope="row">courriel Requis</th>
	<td><?php _e("Peu de fournisseurs d'identite` ne fournissent Email ID utilisateur. Se`lectionnez OUI si vous voulez un email pop-up apre`s identification ou Se`lectionnez Non si vous voulez ge`ne`rer automatiquement l'adresse de courriel.", 'LoginRadius'); ?>
	</td></tr>
	<tr class="row_white">
	<th></th>
	<td> 
Oui <input name="dummyemail" type="radio"  value="0" <?php checked( '0', get_option( 'dummyemail' ) ); ?> checked /><br />
Non <input name="dummyemail" type="radio" value="1" <?php checked( '1', get_option( 'dummyemail' ) ); ?>  />
</td>
	</tr>
	<tr >
	<th scope="row">Re`glage pour redirection apre`s la connexion</th>
	<td>
<input type="radio" name="LoginRadius_redirect" value="samepage" <?php checked( 'samepage', get_option( 'LoginRadius_redirect' )); ?> checked /> <?php _e ('Redirection vers une me`me page du blog'); ?> <strong>(<?php _e ('par de`faut') ?>)</strong><br />

<input type="radio" name="LoginRadius_redirect" value="homepage" <?php checked( 'homepage', get_option( 'LoginRadius_redirect' )); ?> /> <?php _e ('Redirection vers une page d\'accueil du blogue'); ?> 
<br />
<input type="radio" name="LoginRadius_redirect" value="dashboard" <?php checked( 'dashboard', get_option( 'LoginRadius_redirect' )); ?> /> <?php _e ('Redirection vers une planche de bord en compte'); ?>
<br />
<input type="radio" name="LoginRadius_redirect" value="custom" <?php checked( 'custom', get_option( 'LoginRadius_redirect' )); ?> /> <?php _e ('Redirection vers l\'URL suivante:'); ?>
<br />
<input type="text"  name="LoginRadius_redirect_custom_redirect" size="60" value="<?php if($LoginRadius_redirect=='custom' && $custom == 'checked'){echo htmlspecialchars(get_option('LoginRadius_redirect_custom_redirect'));}else{} ?>" />
</td>
</tr>
</table>
<table>
<tr>
<td>&nbsp;</td>
<td>
<span class="submit"><input name="save" value="<?php _e("Enregistrer les modifications", 'LoginRadius'); ?>" type="submit" class="button-primary"/></span>
<span class="submit"><input name="restore" value="<?php _e("Restore Defaults", 'LoginRadius'); ?>" type="submit" class="button-primary"/></span>
</td>
</tr>
</table>
</div>
</form>
<?php }?>