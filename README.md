<h1>Kohana Pjax</h1>
<p>Kohana Controller_Template extension for <a href="https://github.com/defunkt/jquery-pjax">jQuery pjax</a> support.</p>

<h2>Requirements</h2>
<ul> 
    <li><a href="http://kohanaframework.org/download">Kohana 3.3</a></li>
    <li><a href="http://www.php.net/manual/en/intro.dom.php">DOM extension</a></li>
    <li><a href="https://github.com/defunkt/jquery-pjax">jQuery pjax</a></li> 
</ul>

<h2>Usage</h2>

All you need is to extend Controller_Pjax by your main controller - for example:

<pre><code>class Controller_Main extends Controller_Pjax {

    public $template = "your-template";

    // SOME OTHER STUFF

}
</code></pre>

From now, when pjax request will be detected, your response will be compatibile. <br />
Just build your application like before.

<pre><code>$(document).pjax('a', '#pjax-container') // IMPORTANT: only ID selector is supported on server-side currently
</code></pre>

