<?php
/*
 * Created on 4 Sep 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	function echoLatestTweet() {
		// Your twitter username.
		$username = "mattbilson";
		
		// Prefix - some text you want displayed before your latest tweet. 
		// (HTML is OK, but be sure to escape quotes with backslashes: for example href=\"link.html\")
		$prefix = "";
		
		// Suffix - some text you want display after your latest tweet. (Same rules as the prefix.)
		$suffix = "";
		
		$feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";
		
		
		$twitterFeed = file_get_contents($feed);
		
		echo stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix);
	}

	function parse_feed($feed) {
	
		$stepOne = explode("<content type=\"html\">", $feed);
		$stepTwo = explode("</content>", $stepOne[1]);
		
		$tweet = $stepTwo[0];
		$tweet = str_replace("&lt;", "<", $tweet);
		$tweet = str_replace("&gt;", ">", $tweet);
		
		return $tweet;
	
	}
?>
