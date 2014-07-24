<h1>utm-alternative</h1>

This new project aim is to provide the ability to use campaign data values inside the DOM (such as in forms). Many of us in the past added campaign data to our CRM (such as Salesforce) with Google Analytics UTMZ cookies, but with the move to Universal Analytics (UA), it's not possible to fetch values anymore, since Universal Analytics script does not store campaign data on a cookie. This project then 1) creates a new cookie, "traffic_source", which tracks the campaign data based on a fixed query string parameter, SRC (read more below) 2) Stores the existing UTMZ campaign variables so old campaign data won't be lost.

<h2>The SRC value</h2>
Since not all analytics platforms employ the utm_campaign query string paraemter, and since the auto-tagging of adwords enables you to omit it, the most efficient way to track campaign is by using a new campaign query string paremeter: "src". Each time this parameter is declared in the URL, the utm-alternative cookie takes action.

<h3>How Does the Script Work?</h3>

1) First, checks whether there is an existing UTMZ cookie with a campaign info. If there is one, it saves it to the new cookie - "traffic_source".

2) If there is also a SRC value, it adds it to the cookie (=concatenate it), unless it already exist as the recent value. This way you can track your campaigns effect over time. 

3) If there is neither, the script looks at the HTTP referrer, to see if it came from Google, Bing or Yahoo. If it does, it adds it to the cookie. 

4) Otherwise, put NONE (strictly speaking, we cannot know for sure it's "direct" traffic). 

An example of how the traffic source value should look like: 
<pre>
{src value from linkedin campaign}--{src value from adwords campaign}--{utmz campaign value}
</pre>
(Double dash being the separator of the values)

<h3>Installation</h3>

The main javascript could be loaded in the head section, after the body tag, or via GoogleTagManager. <br />
1) If you run traffic_source.js in the head, the JS code that prints the value in the form (hereafter: form.html) should run after the body tag. <br />
2) If after body tag, the traffic_source.js should run before form.html.<br />
3) If via GoogleTagManager, you must make sure that traffic_source.js runs before form.html. You can do that by putting bost codes in one tag, one after the other. 


<h4>FAQ</h4>

Q: Why not with Local Storage but a cookie?<br />
A: Local Storage does not allow you to share data across subdomains easily (if at all). Many advertisers run different campaigns on different web assets.

Q: Why Javascript?<br />
A: Cross-platform, server-side agnostic solution. 

Q: What to do if I use the utm_campaign any way and I don't use auto-tagging?<br />
A: From now on just add src=XXX to the target URL. You can make it identical to the utm_campaign so you keep track of your campaigns easily.

Q: So is the UTMZ campaign value adds up to the cookie each time the user enters the site?<br />
A: No. Once there is a new cookie of traffic traffic, the script does not check for utm_campaign anymore. You can now rely on the new lead source cookie. 

Q: Do I must use Google Analytics?<br />
A: The script works independently, so Google Analytics is not required. You can use it for your own projects where you need the campaign data in the DOM. However, it allows marketers who used Google Analytics UTMZ cokoie to get this campaign data, to keep on doing it when they move to Universal Analytics. 


<h5>Please Contribute!</h5>
This project is very new and needs more use cases, testing and suggestions to improve it. Please do!
