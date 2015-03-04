function footer()
{
		return "<footer>"+
				"<p>Made by <a href=\"http://twitter.com/chgravier\">@chgravier</a> & <a href=\"http://twitter.com/jsubercaze\">@jsubercaze</a>. Special thanks to <a href=\"http://twitter.com/mehlah\">@mehlah</a> for the HTML/CSS discussions !</p>"+
					"<p>&copy; <a href=\"http://www.telecom-st-etienne.fr\">Télécom Saint-Etienne</a> - <a href=\"http://portail.univ-st-etienne.fr/\">Université Jean Monnet</a>"+
					"		- <a href=\"http://www.institut-telecom.fr\">Institut Télécom 2012</a><br />"+
			" </footer>";
}


function menu()
{

	var m = "<div class=\"navbar navbar-fixed-top\">"+
      "<div class=\"navbar-inner\">"+
       "<div class=\"container\">"+
         "<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">"+
            "<span class=\"icon-bar\"></span>"+
            "<span class=\"icon-bar\"></span>"+
            "<span class=\"icon-bar\"></span>"+
          "</a>"+
          "<a class=\"brand\" href=\"#\">@jchevalier</a>"+
          "<div class=\"nav-collapse\">"+
            "<ul class=\"nav\">"+
							"<li id=\"menuhome\"><a href=\"./index.html\">Home</a></li>"+
							"<li id=\"menupubli\"><a href=\"./publications.php\">Publications</a></li>"+
              "<li id=\"menuteach\"><a href=\"./teaching.html\">Teaching</a></li>"+
            "</ul>"+
          "</div><!--/.nav-collapse -->"+
        "</div>"+
      "</div>"+
    "</div>";

    return m;
}
