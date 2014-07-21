<h1>utm-alternative</h1>

This project aim is to provide the ability to use utm_campaign values inside the DOM (such as in forms), as replacement for Google Analytics UTM cookies with the move to Universal Analytics (UA). Since UA does not use utm cookies and fetch values from them, this project attempts to 1) create cookies that will use the tracking variable that was declared in the URL using query string parameters and store them on a new first-party cookie; 2) import existing UTM campaign variables to the new cookie so old campaign data won't be lost. 

<h2>The SRC value</h2>
Since not all analytics platforms employ the utm_campaign, and since the auto-tagging of adwords enables you to omit it, a new campaign tag is suggested = "src". Each time this parameter is declared in the URL, the utm-alternative cookie takes action.

<h3>How Does the Script Work?</h3>

1) First, checks whether there is an existing UTMZ cookie with a campaign info. If there is one, it saves it to the new cookie.

2) If there is also a SRC value, it adds it to the cookie (=concatenate it), unless it already exist as the recent value.

3) If there is neither, the script looks at the HTTP referrer, to see if it came from Google, Bing or Yahoo.

4) Otherwise, put NONE (strictly speaking, we cannot know for sure it's "direct" traffic). 

An example of how the traffic source value should look like: 
{src value from linkedin campaign}--{src value from adwords campaign}--{utmz campaign value}

<h4>FAQ</h4>

Q: Why not with Local Storage but a cookie?<br />
A: Local Storage does not allow you to share data across subdomains easily (if at all). Many advertisers run different campaigns on different web assets.

Q: Why Javascript
A: So as to make cross-platform, server-side agnostic solution. 

Q: What to do if I use the utm_campaign any way and I don't use auto-tagging?<br />
A: From now on just add src=XXX to the target URL. You can make it identical to the utm_campaign so you keep track of your campaigns easily.

Q: So is the UTMZ campaign value adds up to the cookie each time the user enters the site?<br />
A: No. Once there is a new cookie of traffic traffic, the script does not check for utm_campaign anymore. You can now rely on the new lead source cookie. 

<h5>Please Contribute!</h5>
This project needs more use cases, testing and suggestions to improve it. Please do!
