<?php
session_start();
?>

<!DOCTYPE html>

<html>
   <head>
      <meta charset = "utf-8">
      <title>Assignment6</title>
      <style type = "text/css">
         body  { font-family: sans-serif;
                 background-color: lightyellow; } 
         table { background-color: lightblue; 
                 border-collapse: collapse; 
                 border: 1px solid gray; }
         td    { padding: 5px; }
         tr:nth-child(odd) {
                 background-color: white; }
      </style>
   </head>
   
   <body>
		<?php
	    $id=$_POST["snumber"];
	    $_SESSION["id"] = $id;
        $password=$_POST["passwd"];
        if(!($database = mysqli_connect("db.peicloud.ca","zetaU","zeta")))
            die("Error connecting to database!</body></html>");
        if(!mysqli_select_db($database,"zetaDB"))
            die("Error openning Database!</body></html>");
        $check = "SELECT Password FROM STUDENTS WHERE ID=".$id;
        if(!($result = mysqli_query($database,$check)))
        {
            print ("<p>Could not execute query!</p>");
            die("</body></html>");
        }
        $match = false;
        while($row = mysqli_fetch_row($result))
        {
            foreach($row as $value)
                if($value==$password)
                    $match==true;
        }
        if($match)
        {
            die("Wrong Id or Password. Please try again.</body></html>");
        }   
    
        ?>
    	<p>Welcome, ID: <?php print($id);?>!</p>
    	<table>
         	<caption>Here's your registered courses:</caption>
         	<thead><th>Course</th></thead>
         	<?php
             $get = "SELECT * FROM id".$id;
            if(!($courses = mysqli_query($database,$get)))
            {
                print ("<p>Could not execute query!</p>");
                die("</body></html>");
            }
            // fetch each record in result set
            while ( $row = mysqli_fetch_row( $courses ) )
            {
                // build table to display results
                print( "<tr>" );

                foreach ( $row as$value )
                {
                    print( "<td>$value</td>" );
                }
                print( "</tr>" );
            } // end while
            ?><!-- end PHP script -->
    	</table>
    	<form method="post" action="system.php">
        	<p><input type = "submit" name = "1" value = "Register new course"></p>
    	</form>
    </body>
</html>