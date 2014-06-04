<?php
/**
 * Manage all facebook API function
 * @author Arjun Jain <http://www.arjunjain.info>
 * @version 1.0
 * 
 */
require_once 'ext/facebook.php';
class FacebookFunctions {
	
	private $_facebook;
	private $_username;
	
	function __construct($app_id,$app_secret,$cookies=false){
		$this->_facebook = new Facebook(array(
  			'appId'  => $app_id,
  			'secret' => $app_secret,
 			'cookie' => $cookies
		));
	}
		
	/**
	 * 
	 * Get Current login user id
	 * 
	 */
	public function GetUserId(){
		return $this->_facebook->getUser();
	}
	
	/**
	 * 
	 * Get user access token
	 * 
	 */
	public function GetAccessToken(){
		return $this->_facebook->getAccessToken();
	}
	
	/**
	 * 
	 * Facebook API request to fetch other details
	 * 
	 */
	public function API($query){
		return $this->_facebook->api($query);
	}
	
	/**
	 * Get login URL
	 * @param array $params ("scope"=>"","redirect_uri"=>"","display"=>"")
	 */
	public function GetLoginUrl($params){
		return $this->_facebook->getLoginUrl($params);
	}
	
	/**
	 * 
	 * Get logout URL
	 * @param array $params
	 */
	public function GetLogoutUrl($params){
		return $this->_facebook->getLogoutUrl($params);
	}
	
	public function DestroysSession(){
		return $this->_facebook->destroySession();
	}


}