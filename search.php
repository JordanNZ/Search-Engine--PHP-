

 /*(C) Media Cookie 2012 and Onwards All Rights Reserved
	Any external use other then Github or moodsearch.net render
	the user breaching copyright.

    This website is not permitted for external use
    on any other webdomain other than the sites listed above

    This copyright MUST remain on the document under
    Australian/New Zealand Law.

   Coded by Jordan Diamond & Daniel Johnson*/
   

    

<?php
 
$button = $_GET['submit'];
$search = $_GET['search'];
 
if (!$button)
   echo "Please fill out the form";
else
{
    if (strlen($search)<=2)
    echo "The item you searched for was to small";
    else
    {
     
    echo "You searched for <b>$search</b> <hr size='1'>";
    echo"<title>LB-Search &raquo; $search</title>";
    echo"<style type='text/css'> 
  @import url('style.css');
 </style> ";
    echo "<form action='search.php' method='GET'> 
           <center> <a href="moodsearch.com/search'/><img src='logo.png'/></a><br>
                    <input type='text' size='50' name='search'><input type='submit' name='submit' value='Search'><br>";
     
     //connect to database
     
     mysql_connect('localhost','','');
     mysql_select_db('');
     
 
           //explode search term
           $search_exploded = explode(" ",$search);
           foreach($search_exploded as  $search_each)
           {
            //construct query
            
            $x++;
            if ($x==1)
               $construct .= "keywords LIKE '%$search_each%'";
            else
               $construct .= " OR keywords LIKE '%$search_each%'";
 
           }
 
     
     //echo out construct
     
     $construct = "SELECT * FROM search WHERE $construct";
     $run = mysql_query($construct);
     
     $foundnum = mysql_num_rows($run) or die(mysql_error());
     
     if ($foundnum==0)
        echo "How about you try a non-retarded search, huh?";
     else
     {
       
       echo "$foundnum results found.<p><hr size='1'>";
       
       while ($runrows = mysql_fetch_assoc($run))
       {
        //get data
        $title = $runrows['title']; 
        $desc = $runrows['description'];
        $url = $runrows['url'];
        
        echo "<b>$title</b><br>
       $desc<br>
       <a href='$url'>$url</a><p>";
 
       }
       
     }
     
 
 
    }
}
 
 
?>
