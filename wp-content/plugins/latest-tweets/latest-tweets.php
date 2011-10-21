<?php
/*
Plugin Name: Latest Tweets
Plugin URI: http://valums.com/wordpress-latest-tweets/
Description: This widget displays latest tweets in your blog
Version: 0.2
Author: Andrew Valums
Author URI: http://valums.com
*/

//error_reporting(E_ALL);
add_action("widgets_init", array('Latest_tweets', 'register'));
register_activation_hook( __FILE__, array('Latest_tweets', 'activate'));
register_deactivation_hook( __FILE__, array('Latest_tweets', 'deactivate'));

class Latest_tweets {
	function activate(){
		$data = array(
			'title' => _('Title')
			,'user' => 'valums'
			,'count' => 5
			,'display_replies' => true
			,'cache_time' => 60
		);
		
		if ( ! get_option('latest_tweets')){
			add_option('latest_tweets' , $data);
		} else {
			update_option('latest_tweets' , $data);
		}
	}
	
	function deactivate(){
		delete_option('latest_tweets');
	}
	
	/**
	 * Display and process text widget options form.
	 */	
	function control(){
		$data = get_option('latest_tweets');	
		
		if (isset($_POST['latest-tweets-title'])){
			$data['title'] = attribute_escape($_POST['latest-tweets-title']);
			$data['user'] = attribute_escape($_POST['latest-tweets-user']);
			$data['count'] = (int)$_POST['latest-tweets-count'];
			$data['display_replies'] = (bool)$_POST['latest-tweets-display-replies'];
			$data['cache_time'] = (int)$_POST['latest-tweets-cache-time'];
			unset($data['cache']);
			update_option('latest_tweets', $data);
		}
		
		self::input(__('Title'), "latest-tweets-title", 'text', $data['title']);
		self::input(__('Twitter username'), "latest-tweets-user", 'text', $data['user']);
		self::input(__('Number of tweets shown'), "latest-tweets-count", 'text', $data['count']);
		self::input(__('Display replies?'), "latest-tweets-display-replies", 'checkbox', $data['display_replies']);
		self::input(__('Cache tweets for (seconds)'), "latest-tweets-cache-time", 'text', $data['cache_time']);	
	}
	
	function input($title, $name, $type, $value){
		$add = '';
		if ($type != 'checkbox'){
			$add .= " value='$value' ";
		} else if ($value == true){
			$add .= ' checked="checked" ';
		}
	?>
		<p><label for="<?php echo $name; ?>">
		<?php echo $title; ?>
		<input id="<?php echo $name; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>" <?php echo $add; ?> />
		</label></p>
	<?php
	}
	
	function update_cache(){		
		$data = get_option("latest_tweets");
		
		if ( ! (isset($data['cache']) && ($data['last_checked'] > ( mktime() - $data['cache_time'])))){
			require_once(ABSPATH . 'wp-includes/class-snoopy.php');
			$snoopy = new Snoopy;
			
			$url = "http://twitter.com/statuses/user_timeline/{$data['user']}.json";
			$result = $snoopy->fetch($url);
			
			if ($result){
				$data['cache'] = json_decode($snoopy->results, true);
				$data['last_checked'] = mktime();
			} else if (isset($data['cache'])){
				// if twitter not responding use previous cached tweets
				$data['last_checked'] = mktime();					
			} else {
				return false;
			}
			update_option('latest_tweets', $data);
		}
	}	
	
	function display($args){	
		$data = get_option("latest_tweets");
		echo $args['before_widget'] . $args['before_title'];
		echo '<a rel="nofollow" href="http://twitter.com/' . $data['user'] . '/">' . $data['title'] . "</a>";
		echo $args['after_title'];		

		$displayed = 0;
		echo '<ul>';
		foreach($data['cache'] as $tweet){
			if ( ! $data['display_replies'] && $tweet['in_reply_to_user_id']){	
				continue;
			}

			$pattern = '/\@(\w+)/';
			$replace = '<a rel="nofollow" href="http://twitter.com/$1">@$1</a>';
//    		$tweet['text'] = preg_replace($pattern, $replace , $tweet['text']);
//    		$tweet['text'] = make_clickable($tweet['text']);
		    
    		echo '<li>' . $tweet['text'] . '</li>';
    		
    		$displayed++;
			if ($displayed == $data['count']) break;
		}
		echo '</ul>';
   		echo $args['after_widget'];		
	}
	
	function widget($args){
		self::update_cache();
		self::display($args);		
	}
	
	function register(){
		register_sidebar_widget('Latest tweets', array('Latest_tweets', 'widget'));
		register_widget_control('Latest tweets', array('Latest_tweets', 'control'));
	}
}
?>
