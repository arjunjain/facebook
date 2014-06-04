<?php
/**
 * @author Arjun Jain <http://www.arjunjain.info>
 */
require_once '../wp-load.php';
require_once 'config.php';
require_once 'lib/FacebookFunctions.php';

$fbObject=new FacebookFunctions(APP_ID,APP_SECRET);
$userId=$fbObject->GetUserId();

if($userId){ 
	try{
		$userDetails=$fbObject->API('/me');
		
		$wpuserId= $userDetails['id'];
		$wpuseremail=$userDetails['email'];
		$wpfirstname=$userDetails['first_name'];
		$wplastname=$userDetails['last_name'];
		$wpuserId=$userDetails['id'];
		
		if(! username_exists($wpuserId) and email_exists($wpuseremail) == false){
			
			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			
			$userparams=array("user_pass"=>$random_password,"user_login"=>$wpuserId,"user_email"=>$wpuseremail,"first_name"=>$wpfirstname,"last_name"=>$wplastname,"role"=>WP_LEVEL);
			$userid=wp_insert_user($userparams);
			
			wp_new_user_notification($wpuserId,$random_password);
			
			$is_error=wp_signon(array("user_login"=>$wpuserId,"user_password"=>$random_password));
			if(is_wp_error($is_error)){
				if (!empty($_SERVER['HTTP_REFERER'])){
				?>
					<script type="text/javascript">
						window.opener.location.href="<?php echo $_SERVER['HTTP_REFERER']; ?>";
						window.close();
					</script>
				<?php 
				}
				else
				{
				?>
					<script type="text/javascript">
						window.opener.location.href="<?php echo get_bloginfo('wpurl'); ?>";
						window.close();
					</script>
				<?php 
				}
			}
			else{
				?>
				<script type="text/javascript">
					window.opener.location.href="<?php echo get_bloginfo('wpurl')."/wp-admin/"; ?>";
					window.close();
				</script>
				<?php 
			}
	 	}
		else {
			$userinfo=get_user_by('login',$wpuserId);
			wp_set_auth_cookie($userinfo->ID);
			do_action('wp_login', $userinfo->user_login);
			?>
			<script type="text/javascript">
				window.opener.location.href="<?php echo get_bloginfo('wpurl')."/wp-admin/"; ?>";
				window.close();
			</script>
			<?php 
		}
	}
	catch(FacebookApiException $e){
		$userId=null;
	}
	catch (Exception $e){
		$userId=null;
	}
}
else {
	$lparams=array("scope"=>"email",
			"redirect_uri"=>SITE_URL,
			"display"=>"popup");
	$loginurl=$fbObject->GetLoginUrl($lparams);
	header("Location: ".$loginurl);
}
?>	
</html>