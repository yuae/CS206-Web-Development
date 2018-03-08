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
   		    if(!($database = mysqli_connect("db.peicloud.ca","zetaU","zeta")))
                die("Error connecting to database!</body></html>");
            if(!mysqli_select_db($database,"zetaDB"))
                die("Error openning Database!</body></html>");
            $get = "SELECT * FROM COURSES";
            if(!($result1 = mysqli_query($database,$get)))
            {
                print ("<p>Could not execute query!</p>");
                die("</body></html>");
            }
        ?>
	  <table>
         <caption>List of all courses:</caption>
         <thead><th>Course Name</th><th>Maximum Seats</th>
	 	 <th>Remained Seats</th></thead>
         <?php
         // fetch each record in result set
         while ( $row = mysqli_fetch_row( $result1 ) )
         {
            // build table to display results
            print( "<tr>" );

               foreach ( $row as $value ) 
               print( "<td>$value</td>" );

               print( "</tr>" );
         } // end while
         ?><!-- end PHP script -->
       </table>
       <?php 
         	$getcourses = "SELECT Course FROM COURSES";
         	if(!($result2 = mysqli_query($database,$getcourses)))
         	{
         	    print ("<p>Could not execute query!</p>");
         	    die("</body></html>");
         	}
        ?>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        	<select name = "c">
         	<?php
         	while ( $row = mysqli_fetch_row( $result2 ) )
         	{
         	    // build option to display courses
         	    foreach ( $row as $value )
         	    {
         	      print( "<option>$value</option>" );
         	    }
         	} // end while
            ?>
         	</select>
        	<p><input type = "submit" name = "submit" value = "Register"></p>
      </form>
      <?php 
      
      if ($_SERVER["REQUEST_METHOD"]=="GET")
      {
          
          $course=$_GET["c"];
          $query3 = "SELECT Remain FROM COURSES WHERE Course = '".$course."'";
      
          if(!($result3=mysqli_query($database,$query3)))
          {
              print ("<p>Could not execute query!</p>");
              die("</body></html>");
          }
          while($row = mysqli_fetch_row($result3))
          {
              foreach($row as $value)
                  $remain = $value;
          }
          $query4 = "SELECT Course FROM id".$_SESSION["id"];
          $existed = false;
          if(!($result4=mysqli_query($database,$query4)))
          {
              print ("<p>Could not execute query3!</p>");
              die("</body></html>");
          }
          while($row = mysqli_fetch_row($result4))
          {
              foreach($row as $value)
              {
                  if($course==$value)
                      $existed = true;
              }
          }
          if($existed)
          {
              print("Course already registered.");
          }
          else if($remain>0)
          {
              $updateSystem = "Update COURSES set Remain=".($remain-1)." WHERE Course='".$course."'";
              $updateInfo = "INSERT into id".$_SESSION["id"]." (Course) values ('".$course."')";
              if(!($result6=mysqli_query($database,$updateInfo)))
              {
                  print ("<p>Could not execute query6!</p>");
                  die("</body></html>");
              }
              if(!($result5=mysqli_query($database,$updateSystem)))
              {
                  print ("<p>Could not execute query5!</p>");
                  die("</body></html>");
              }
              
              print("Course $course is successfully registered. Thank you!");
          }
          else 
          {
              print("This course is full please choose another course.");
          }
      }
      
      ?>
 </body>
 </html>   