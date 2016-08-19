<script>
(function(cookieName, domain){

	var traffic_source_COOKIE_TOKEN_SEPARATOR = ">>"; //separating between concatenated traffic source
	var site_hostname = "subdomain.domain.com"; //enter here your site. This will stop the script from populating with internal navigation
	var tracking_parameter = "src" //you can put here "utm_campaign" if you rather use your existing tagging, or any other query string parameter name. How to deal with Adwords auto-tagging without utm_campaign value? Check the documentation. 
	
	/**
	 * Checks if the referrer is a real referrer and not navigation through the same (sub)domain
	 * @return true/false
	 */
	
	function isRealReferrer(){
			return document.referrer.split( '/' )[2] != site_hostname;
		}
		
	
	/**
	 * Receives a query string parameter name. 
	 * @return value of given query string parameter (if true); null if query string parameter is not present. 
	 */
	
	function getURLParameter(param){
			var pageURL = window.location.search.substring(1); //get the query string parameters without the "?"
			var URLVariables = pageURL.split('&'); //break the parameters and values attached together to an array
			for (var i = 0; i < URLVariables.length; i++) {
				var parameterName = URLVariables[i].split('='); //break the parameters from the values
				if (parameterName[0] == param) {
					return parameterName[1];
				}
			}
			return null;
		}	
	
	
	/**
	 * Receives a cookie name. 
	 * @return Value of given cookie name
	 */
		
	function getCookie(cookieName){
        var name = cookieName + "=";
        var cookieArray = document.cookie.split(';'); //break cookie into array
        for(var i = 0; i < cookieArray.length; i++){
          var cookie = cookieArray[i].replace(/^\s+|\s+$/g, ''); //replace all space with '' = delete it
          if (cookie.indexOf(name)==0){
             return cookie.substring(name.length,cookie.length); //
          }
        }
        return null;
    }	
	
	
	/**
	 * Checks if a string is empty.
	 * @return false if empty or null.
	 */
	
	function isNotNullOrEmpty(string){
			return string !== null && string !== "";
	}
	
	
	/**
	 * Sets a new cookie. Receives cookie name and value. 
	 */
	 
	function setCookie(cookie, value){
        var expires = new Date();
        expires.setTime(expires.getTime() + 62208000000); //1000*60*60*24*30*24 (2 years)
        document.cookie = cookie + "=" + value + "; expires=" + expires.toGMTString() + "; domain=" + domain + "; path=/";
    }

	/**
	 * removes referrer's protocol for cleaner data
	 * @return referrer without http:// | https://
	 */
	function removeProtocol(href) {
        return href.replace(/.*?:\/\//g, "");
    }
	
	
	
	if (isRealReferrer()) { //if the last page was not the page of the website/domain...
	
		//Variables that will be used by both cases - A & B
		//CASE A - a new session, if there is no traffic source cookie created previously.
		//CASE B - returning user with the traffic source cookie already set. 
		
		var traffic_source = ""; //reset traffic source value
		var urlParamSRC = getURLParameter(tracking_parameter); //get value of the query string parameter (if any)
		

		if(document.cookie.indexOf(cookieName) === -1) //CASE A starts
		{				
			//First check is there is and old UTMZ cookie if we can use
			var utmzCookie = getCookie("__utmz"); //get ga.js cookie
			if(utmzCookie != null) { //if there is UTMZ cookie
				var utmzCookieCampaignValue = "";
				var UTMSRC = "utmccn=";
				var start = utmzCookie.indexOf(UTMSRC);
				var end = utmzCookie.indexOf("|", start); 
				if(start > -1) {
					if(end === -1) {
						end = utmzCookie.length; 
					}
				}
                utmzCookieCampaignValue = "utmz:" + utmzCookie.substring((start + UTMSRC.length), end); //get the value of the UTMZ, without the parameter name
				traffic_source = traffic_source_COOKIE_TOKEN_SEPARATOR + utmzCookieCampaignValue;				
            }
			
			
			if (isNotNullOrEmpty(urlParamSRC)) { //if there is a SRC query string parameter 
				traffic_source = urlParamSRC + traffic_source;  //use it, add it to the variable
			
			//if no SRC, check if there is a REFERRER 
			} else if (isNotNullOrEmpty(document.referrer)){
				traffic_source = removeProtocol(document.referrer) + traffic_source;
				
			} else {
				traffic_source = "none or direct" + traffic_source;	
			}
			
			
			// CREATE THE COOKIE
			setCookie(cookieName, traffic_source); //set the cookie
			
		} //End of CASE A if there is no traffic source cookie
			
		
		
		
		else {	//CASE B starts - traffic source cookie already exists
			
			//Get the traffic source value from the URL (if any)	
			if (isNotNullOrEmpty(urlParamSRC)) { //if there is a traffic source query string parameter 
				traffic_source = urlParamSRC;  //use it, add it to the variable
					
			//if no traffic source value as a query string parameter, check if there is a REFERRER 
			} else if (isNotNullOrEmpty(document.referrer)) {
				traffic_source = removeProtocol(document.referrer); //use it, add it to the variable
				
			} else {
				traffic_source = "none or direct" + traffic_source;
			}
				
				
			//Update the cookie with the new traffic_source of the new user visit
			updated_traffic_source = traffic_source + traffic_source_COOKIE_TOKEN_SEPARATOR + getCookie(cookieName);
			setCookie(cookieName, updated_traffic_source);
		}  //end of CASE B
			
			
		
	} 

})("traffic_source", ".YOUR-DOMAIN-HERE.com");
</script>
