Integrate Facebook Login with Wordpress
----

This PHP script provide easy way to integrate Facebook Login with Wordpress. 

- Auto Login to Wordpress After Sign in. 
- Configure Sign in user **default User lavel**.
 
How to use
----
1. Create Facebook Application [Facebook Application Setup](http://www.facebook.com/developers/createapp.php) and get 'App Id' and 'App Secret'
2. Copy facebook folder to wordpress root. 
 - ..
 - wp-load.php
 - wp-config.php
 - **facebook**
3. Update config.php file. Add ```APP_ID``` and ```APP_SECRET``` value.
4. Use following HTML code in Wordpress page/post. 

```html
<a href="#" onclick="window.open('http://www.arjunjain.info/facebook','_blank','directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=400, height=280,top=200,left=200')">Login With Facebook</a>
```
