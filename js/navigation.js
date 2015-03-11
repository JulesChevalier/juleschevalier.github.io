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
          "<div class=\"nav-collapse\">"+
            "<ul class=\"nav\">"+
							"<li id=\"menuhome\"><a href=\"./\">Home</a></li>"+
							"<li id=\"menupubli\"><a href=\"./publications.html\">Publications</a></li>"+
              "<li id=\"menuteach\"><a href=\"./teaching.html\">Teaching</a></li>"+
            "</ul>"+
          "</div><!--/.nav-collapse -->"+
        "</div>"+
      "</div>"+
    "</div>";

    return m;
}
