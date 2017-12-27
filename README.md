<h1>utm-alternative</h1>


This project's aim is to allow you to gather campaign information for each conversion outside Google Analytics (or others). It does so by creating a cookie that saves users campaigns referral information on a cookie. It relies on existing utm_campaign, or your own query string parameter.

<h3>Why was this project started to being with?</h3>
Once on earth there were dinasaurs that used Google Analytics UTMZ cookie to store data in CRM (such as Salesforce). But with the move to Universal Analytics (UA), it was not possible to retrieve UTMZ cookie values anymore, since Universal Analytics script does not store campaign data on a cookie.

<h2>Create Your Own User Tracking</h2>
This project 1) creates a new cookie, "traffic_source", which tracks the campaign data based on utm_campaign or a query string parameter 2) Stores the existing UTMZ campaign value of returning users so old campaign data won't be lost.

<h3>How Does the Script Work?</h3>

1) First, checks whether there is an existing **UTMZ cookie** with a campaign info. If there is one, it saves it to the new cookie - "traffic_source". (This name can be changed to something else)

2) If there is also a **src** query string parameter value (can be changed as well or set to use **utm_campaign**), it adds it to the cookie (=concatenate it). This way you can track your campaigns effect over time. 

3) If there is neither, the script looks at the **referrer**. It will add the exact referring path (www.example.com/page.html, google.co.uk...)

4) Otherwise, it will put **"direct or none"** (strictly speaking, we cannot know for sure it's direct traffic, or a browser bookmark, email link, pdf or whatever). 

An example of how the traffic source value should look like: 
<pre>
{src/utm_campaign value from linkedin campaign}>>{src/utm_campaign value from adwords campaign}>>{utmz campaign value}
</pre>
(>> Double arrow is the separator of the values)

<h3>Installation</h3>

*fill in your site in the variable "site_hostname" at the top of the code. <br />
*Pass your domain name (in the format: .YOURDOMAIN.com) in the closure of the function. You can also change the default cookie name "traffic_source" to something else if you would like to. <br />


Loading the Javascript:
The main javascript could be loaded in the head section, after the body tag, or via GoogleTagManager. <br />
1) If you run traffic_source.js in the head, the JS code that prints the value in the form (hereafter: form.html) should run after the body tag. <br />
2) If you run all JS after body tag, the traffic_source.js should run before form.html.<br />
3) If via GoogleTagManager, you must make sure that traffic_source.js runs before the JS code in form.html. You can do that by putting both piece of codes in one tag, one after the other.




<h4>FAQ</h4>

Q: Why not with Local Storage but a cookie?<br />
A: Local Storage does not allow you to share data across subdomains easily (if at all). Many advertisers run different campaigns on different web assets, so being unable to share this data across subdomains will make this script less effective.

Q: Why Javascript?<br />
A: Cross-platform, server-side agnostic solution. 

Q: What to do if I use the utm_campaign anyway and I don't use Adwords auto-tagging?<br />
A: From version 2.0 you can do it more easily. Change "tracking_parameter" to "utm_campaign". Alternatively, just make the habit to add src=XXX to the target URL. You can make it identical to the utm_campaign so you keep track of your campaigns easily. Read "Tagging URLs" readme file for more information on using the plugin. 

Q: So is the UTMZ campaign value adds up to the cookie each time the user enters the site?<br />
A: No. Once there is a new "traffic_source" cookie, the script does not check for utm_campaign anymore. You can now rely on the new traffic_source cookie. 

Q: Do I must use Google Analytics?<br />
A: The script works independently, so Google Analytics is not required. You can use it for your own projects where you need the campaign data in the DOM. However, it allows marketers who used Google Analytics UTMZ cookie to retain the campaign data accessible via a cookie. 


<h5>Please Contribute!</h5>
This project is completely functional and working. However, it needs more use cases, testing and suggestions to improve it. Please do!

<h6>Updates</h6>

AUG 19 2016<br />
<b>Release 2.0:</b> Thanks bobbylechuga and svensson-david for additions and inspiration.<br /> 
-Support using utm_campaign tags as requested <br />
-Now populates the cookie on each visit<br />
-Less code and cleaner, easier to customize (but will work absolutely fine out of the box)<br />
-Adding the timestamp of the session was <b>removed</b> from 2.0. Will be added in the future. <br />
-Support for Adwords auto-tagging - use the new parameter OR utm_campaign - see documentation under "tagging URLs".<br />
<br />
<i>The new release is better adjusted for pure user tracking - regardless of using UTMZ cooking, or even Google Analytics.</i><br />

AUG 07 2015<br />
Added notes for implementation "Tagging URLs.md"

FEB 22 2015<br/>
Change separators for easier data analysis.

JAN 30 2015<br/>
-Domain and cookie name values are passed to the function. If no domain name is passed, the function will take by default the hostname (-->including the subdomain). Thanks caiorogerio. <br />
-Small fix of currTime() function. 

Aug 25 2014<br />
<b>Release 1.1:</b> New currTime() function gives you an option to add the time of the session to the traffic source cookie. By default, these lines are commented out. 

Aug 15 2014 <br/>
Add "utmz:" string before the old UTMZ campaign value (that was retrieved from the existing UTMZ cookie of the user).
