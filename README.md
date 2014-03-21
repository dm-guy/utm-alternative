utm-alternative
===============

Replacement for Google Analytics UTM cookies with the move to Universal Analytics (UA). Since UA does not allow to read utm cookies anymore, this project attempts to create cookies that will use the tracking variables that were declared in the URL and store them on a private cookie.

This way you can keep your old tracking parameters (utm_campaign=your-campaign-name) that are still used by UA, but to use them for your tracking purposes (CRM, other analytics tools). 

Further development of this project would be to replace all the utm cookies (source, medium, user visits info and etc).
