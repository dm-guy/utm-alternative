<?php 
////////////////////////////////////////////////////
// GA_Parse - PHP Google Analytics Parser Class 
//
// Version 1.0 - Date: 17 September 2009
// Version 1.1 - Date: 25 January 2012
// Version 1.2 - Date: 21 April 2012
//
// Define a PHP class that can be used to parse 
// Google Analytics cookies currently with support
// for __utmz (campaign data) and __utma (visitor data)
//
// Author: Joao Correia - http://joaocorreia.pt
// https://github.com/joaolcorreia/Google-Analytics-PHP-cookie-parser/
// License: LGPL
//
////////////////////////////////////////////////////

class GA_Parse
{

  var $campaign_source;    		// Campaign Source
  var $campaign_name;  			// Campaign Name
  var $campaign_medium;    		// Campaign Medium
  var $campaign_content;   		// Campaign Content
  var $campaign_term;      		// Campaign Term

  var $first_visit;      		// Date of first visit
  var $previous_visit;			// Date of previous visit
  var $current_visit_started;	// Current visit started at
  var $times_visited;			// Times visited
  var $pages_viewed;			// Pages viewed in current session
  
  
  function __construct($_COOKIE) {
	   // If we have the cookies we can go ahead and parse them.
	   if (isset($_COOKIE["__utma"]) and isset($_COOKIE["__utmz"])) {
	       $this->ParseCookies();      
       }
      
  }

  function ParseCookies(){

  // Parse __utmz cookie
  list($domain_hash,$timestamp, $session_number, $campaign_numer, $campaign_data) = preg_split('[\.]', $_COOKIE["__utmz"],5);

  // Parse the campaign data
  $campaign_data = parse_str(strtr($campaign_data, "|", "&"));

  $this->campaign_source = $utmcsr;
  $this->campaign_name = $utmccn;
  $this->campaign_medium = $utmcmd;
  if (isset($utmctr)) $this->campaign_term = $utmctr;
  if (isset($utmcct)) $this->campaign_content = $utmcct;

  // You should tag you campaigns manually to have a full view
  // of your adwords campaigns data. 
  // The same happens with Urchin, tag manually to have your campaign data parsed properly.
  
  if (isset($utmgclid)) {
    $this->campaign_source = "google";
    $this->campaign_name = "";
    $this->campaign_medium = "cpc";
    $this->campaign_content = "";
    $this->campaign_term = $utmctr;
  }

  // Parse the __utma Cookie
  list($domain_hash,$random_id,$time_initial_visit,$time_beginning_previous_visit,$time_beginning_current_visit,$session_counter) = preg_split('[\.]', $_COOKIE["__utma"]);

  $this->first_visit = new \DateTime();
  $this->first_visit->setTimestamp($time_initial_visit);

  $this->previous_visit = new \DateTime();
  $this->previous_visit->setTimestamp($time_beginning_previous_visit);

  $this->current_visit_started = new \DateTime();
  $this->current_visit_started->setTimestamp($time_beginning_current_visit);

  $this->times_visited = $session_counter;

  // Parse the __utmb Cookie

  list($domain_hash,$pages_viewed,$garbage,$time_beginning_current_session) = preg_split('[\.]', $_COOKIE["__utmb"]);
  $this->pages_viewed = $pages_viewed;


 // End ParseCookies
 }  

// End GA_Parse
}

?>
