<h1>utm-alternative</h1>


This project aim is to provide the ability to use campaign data values inside the DOM (such as in forms). Many of us in the past added campaign data to our CRM (such as Salesforce) with Google Analytics UTMZ cookies, but with the move to Universal Analytics (UA), it's not possible to retrieve UTMZ cookie values anymore, since Universal Analytics script does not store campaign data on a cookie. This project then 1) creates a new cookie, "traffic_source", which tracks the campaign data based on a  query string parameter 2) Stores the existing UTMZ campaign value of returning users so old campaign data won't be lost.

<h2>Update: Release 2.0 is out!</h2>
utm-alternative just got better!<br />
-Supports using utm_campaign tag as requested by some users<br />
-Now populates the cookie on each user's visit<br />
-Less code, cleaner, easier to customize (but will work absolutely fine out of the box)<br />
-Adding the timestamp of the session was <b>removed</b> from 2.0. Will be added in the future. <br />
-Support for Adwords auto-tagging - use the new parameter OR utm_campaign - see documentation under "tagging URLs". <br />

<i>Note that you can migrate easily as long as you keep the YOURDOMAIN.com value the same. For the documentation of version 1.1, see readme 1.1.</i>

<b>The new release is better adjusted for pure user tracking - regardless of using UTMZ cookie, or even Google Analytics.</b>

<h2>Your Own User Tracking </h2>
Since not all analytics platforms employ the utm_campaign query string paraemter, and since the auto-tagging of adwords enables you to omit it, this plugin creates and alternative - relying on your own cookie and a new parameter "src". Each time this parameter is declared in the URL, the utm-alternative code takes action.

<h3>How Does the Script Work?</h3>

1) First, checks whether there is an existing UTMZ cookie with a campaign info. If there is one, it saves it to the new cookie - "traffic_source". (This name can be changed to something else)

2) If there is also a src query string parameter value (can be changed as well), it adds it to the cookie (=concatenate it). This way you can track your campaigns effect over time. Since release 2.0 you can use the utm_campaign cookie as well more easily. 

3) If there is neither, the script looks at the referrer. It will add the exact referring path (www.example.com/page.html, google.co.uk...)

4) Otherwise, it will put "direct or none"" (strictly speaking, we cannot know for sure it's direct traffic, or a browser favorite, email link, pdf or whatever). 

An example of how the traffic source value should look like: 
<pre>
{src value from linkedin campaign}>>{src value from adwords campaign}>>{utmz campaign value}
</pre>
(>> Double arrow is the separator of the values)

<h3>Installation</h3>

*fill in your site in the variable "site_hostname" at the top of the code. <br />
*Pass your domain name (in the format: .YOURDOMAIN.com) in the closure of the function. You can also change the default cookie name "traffic_source" to something else if you would like to. <br />


Loading the Javascript:
The main javascript could be loaded in the head section, after the body tag, or via GoogleTagManager. <br />
1) If you run traffic_source.js in the head, the JS code that prints the value in the form (hereafter: form.html) should run after the body tag. <br />
2) If you run all JS after body tag, the traffic_source.js should run before form.html.<br />
3) If via GoogleTagManager, you must make sure that traffic_source.js runs before form.html. You can do that by putting both piece of codes in one tag, one after the other. 




<h4>FAQ</h4>

Q: Why not with Local Storage but a cookie?<br />
A: Local Storage does not allow you to share data across subdomains easily (if at all). Many advertisers run different campaigns on different web assets, so being unable to share this data across subdomains will make this script less effective.

Q: Why Javascript?<br />
A: Cross-platform, server-side agnostic solution. 

Q: What to do if I use the utm_campaign any way and I don't use Adwords auto-tagging?<br />
A: From version 2.0 you can do it more easily. Change "tracking_parameter" to "utm_campaign". What you can also do, is from now on just add src=XXX to the target URL. You can make it identical to the utm_campaign so you keep track of your campaigns easily. The ability to rely on the utm_campaign query string parameter alone was considered, however to keep it flexible and to adjust to different implementations of different users, a new parameter was created. Read "Tagging URLs" file for more information on using the plugin. 

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
