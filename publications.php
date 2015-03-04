<?



function extract_authors($authors)
{
	$string_authors = "";
	for ($i = 0; $i < count($authors);$i++)
	{
		$author = "";

		if (isset($authors[$i]["von"]) &&  $authors[$i]["von"] != "")
			$author = $author.$authors["von"].' ';

		$author .= $authors[$i]["last"]." ".$authors[$i]["first"];
		
		if ($i < count($authors)-1)
			$author .= ", ";

		$string_authors .= $author;
	}
	return reaccentuated($string_authors);
}

function printfilelink($loc)
{
	if (isset($loc) && $loc != "")
		return " <a href=\"".$loc."\">[.pdf]</a>";
	else return "";
}	


function reaccentuated($string)
{
	$voyelles = array('a','e','i','o','u','y');

	for ($i = 0; $i < count($voyelles); $i++)
	{
		$string = str_replace('\\"{'.$voyelles[$i].'}',"&".$voyelles[$i]."uml;",$string);
		$string = str_replace("\\'{".$voyelles[$i].'}',"&".$voyelles[$i]."acute;",$string);
		$string = str_replace('\\^{'.$voyelles[$i].'}',"&".$voyelles[$i]."circ;",$string);
		$string = str_replace('\\`{'.$voyelles[$i].'}',"&".$voyelles[$i]."grave;",$string);
		
	}
	return $string;
}

function print_proc($entry)
{
	$authors = extract_authors($entry["author"]);
	$authors .= ', <b>'.$entry["title"].'</b>';
	$authors .= ', '.$entry["booktitle"];

	if (isset($entry["pages"]) && $entry["pages"] != "")
                $authors .= ', pp.'.$entry["pages"];

	if (isset($entry["address"]) && $entry["address"] != "")
                $authors .= ', '.$entry["address"];

	
	 $authors .= ', '. $entry["year"];

	if (isset($entry["file"]) && $entry["file"]!="")
		$authors .= printfilelink($entry["file"]);

	echo $authors;
}

function print_book($entry)
{
        $authors = extract_authors($entry["author"]);
        $authors .= ', <b>'.$entry["title"].'</b>';

        if (isset($entry["chapter"]) && $entry["chapter"] != "")
                $authors .= ', chapter '.$entry["chapter"];

	if (isset($entry["editor"]) && $entry["editor"] != "")
                $authors .= ', '.$entry["editor"].' Eds';

 	if (isset($entry["publisher"]) && $entry["publisher"] != "")
                $authors .= ', chap.'.$entry["publisher"];

 	if (isset($entry["isbn"]) && $entry["isbn"] != "")
                $authors .= ', ISBN .'.$entry["isbn"];

        if (isset($entry["address"]) && $entry["address"] != "")
                $authors .= ', '.$entry["address"];
        
         $authors .= ', '. $entry["year"];

        if (isset($entry["file"]) && $entry["file"]!="")
                $authors .= printfilelink($entry["file"]);

        echo $authors;
}

function print_article($entry)
{
	//var_dump($entry);
	$authors = extract_authors($entry["author"]);
	$authors .= ', <b>'.$entry["title"].'</b>';
	$authors .= ', '.$entry["journal"];
	

	if (isset($entry["volume"]) && $entry["volume"] != "")
		$authors .= ', vol.'.$entry["volume"];

	if (isset($entry["number"]) && $entry["number"] != "")
                $authors .= ', n.'.$entry["number"];

	if (isset($entry["pages"]) && $entry["pages"] != "")
		$authors .= ', pp.'.$entry["pages"];

	$authors .= ", ".$entry["year"];

	if (isset($entry["file"]) && $entry["file"]!="")
		$authors .= printfilelink($entry["file"]);

	echo $authors;

}
	

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Jules Chevalier's homepage</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/navigation.js"></script>

        
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        
</script>
    </head>
    
    <body>
        <script>
            document.write(menu());
            $("#menupubli").addClass("active");
        </script>
        <div class="container">
           <section>
            	<div class="page-header">
                    <h1>Recent research publications</h1>
        	</div>
                
                <div class="row">
			<p>I am trying to maintain the following list of the recent co-authored publications (most recent first).</p>
			<p>You can access a (possibly) synchronized RDF version of our team publications <a href="http://data-satin.telecom-st-etienne.fr/snorql/?query=PREFIX+swrc%3A+%3Chttp%3A%2F%2Fswrc.ontoware.org%2Fontology%23%3E%0D%0A%0D%0ASELECT+%3Fnom+%3Ftitre+%3Ftitre+%3Fpages+%3Fabstract+%3Fyear+WHERE+%7B%0D%0A%0D%0A%3Fmade+foaf%3Amaker+%3Fmaker+.%0D%0A%3Fmaker+foaf%3Aname+%3Fnom+.%0D%0A%3Fmade+dc%3Atitle+%3Ftitre+.%0D%0A%3Fmaker+foaf%3Afamily_name+%22gravier%22+.%0D%0AOPTIONAL+%7B%3Fmade+swrc%3Apages+%3Fpages%7D%0D%0AOPTIONAL+%7B%3Fmade+swrc%3Aabstract+%3Fabstract+%7D%0D%0AOPTIONAL+%7B%3Fmade+swrc%3Ayear+%3Fyear%7D%0D%0A%0D%0A%7D">here</a>.</p>
		</div>
			<?
				require_once 'PEAR.php';
				require_once 'Structures/BibTex.php';
				$bibtex = new Structures_BibTex();
				$ret    = $bibtex->loadFile('jc.bib');
				if (PEAR::isError($ret)) {
				    die($ret->getMessage());
				}
				$bibtex->parse();
		
				echo "<p>";
				for ($i = 0; $i <  count($bibtex->data); $i++)
				{
					echo "<blockquote>[".($i+1)."] ";
					if ($bibtex->data[$i]["entryType"]=="inproceedings")
					{
						print_proc($bibtex->data[$i]);
						
					}
					else if ($bibtex->data[$i]["entryType"]=="article")
					{
						print_article($bibtex->data[$i]);
						//var_dump($bibtex->data[$i]);
					}
					else if ($bibtex->data[$i]["entryType"]=="book")
					{
						print_book($bibtex->data[$i]);
					}

					echo "</blockquote>";

                                        // $bibtex->data[$i]["title"];
                                        // $bibtex->data[$i]["pages"];
                                        // $bibtex->data[$i]["number"];
                                        // $bibtex->data[$i]["hournal"];
                                        // $bibtex->data[$i]["year"];

					// $bibtex->data[$i]["year"];
					// $bibtex->data[$i]["title"];
					// $bibtex->data[$i]["pages"];
					// $bibtex->data[$i]["number"];
					// $bibtex->data[$i]["hournal"];
					// $bibtex->data[$i]["year"];
					// $bibtex->data[$i]["year"];
					// $bibtex->data[$i]["year"];

				}
				echo "</p>";

			?>		
		

		<button class="btn-info" type="submit" onClick="window.location.href=('./jc.bib');">
  			Download bibtex
		</button>
		</div>
	   </section>
        </div>
        <!-- /container -->
       </body>
</html>
