<?php
session_start();
?>

<!DOCTYPE html>

<html>
   <head>
      <meta charset = "utf-8">
      <title>Air CS206</title>
      <style type = "text/css">
         
         table         { width: 200px;
                         border-collapse:collapse; 
                         background-color: lightblue; }
         table, td, th { border: 1px solid black; 
                         padding: 4px; 
                         margin-top: 20px; }
         th            { text-align: left; 
                         color: white;
                         background-color: darkblue; }
      </style>
   </head>
   
   <body>
   
     <?php
     if(!($database = mysqli_connect("db.peicloud.ca","zetaU","zeta")))
         die("Error connecting to database!</body></html>");
     if(!mysqli_select_db($database,"zetaDB"))
         die("Error openning table</body></html>");
     
     $fname=$lname=$email=$phone=$section=$seat=$price="   ";
     $priceA=rand(100,200);
     $priceB=rand(100,300);
     $priceC=rand(100,300);
     $prices=array("A" => $priceA,
                   "B" => $priceB,
                   "C" => $priceC);
     asort($prices);
     
     if ($_SERVER["REQUEST_METHOD"]=="POST")
     {
         
         $fname=$_POST["fname"];
         $lname=$_POST["lname"];
         $email=$_POST["email"];
         $phone=$_POST["phone"];
         $section=$_POST["section"];
         $query1 = "SELECT Available FROM available WHERE Section = 'D'";
         if(!($result=mysqli_query($database,$query1)))
         {
             print ("<p>Could not execute query!</p>");
             die("</body></html>");
         }
         while($row = mysqli_fetch_row($result))
         {
             foreach($row as $key => $value)
                 $booked = $value;
         }
         $booked++;
         if($booked<6)
         { 
            
            if($section=="A")
            {
                $seat = $booked;
                $price = $priceA;
            }
            if($section=="B")
            {
                $seat = $booked+5;
                $price = $priceB;
            }
            if($section=="C")
            {
                $seat = $booked+10;
                $price = $priceC;
            }
            $query2 = "Update SEAT set SeatAvailable=1 WHERE SeatNumber=".$seat;
            
            mysqli_query($database,$query2);
            $query3 = "Update available set Available=". $booked ." WHERE Section = '".$section."'";
            
            mysqli_query($database,$query3);
           
            echo "<h3>Thank you for choosing Air CS206.</h3>";
            echo "<h3 class = 'head'>Boarding Pass:</h3>";
            echo "<p>Name: ";
            echo $fname;
            echo " ";
            echo $lname;
            echo "</p>";
            echo "<p>Email: ";
            echo $email;
            echo "</p>";
            echo "<p>Phone: ";
            echo $phone;
            echo "</p>";
            echo "<p>section: ";
            echo $section;
            echo "</p>";
            echo "<p>seat: ";
            echo $seat;
            echo "</p>";
            echo "<p>price: ";
            echo $price;
            echo "</p>";
            echo "<p class = 'head'>Thank you for choosing Air ";
            echo "CS206. Please arrive the airport 2 hours before ";
            echo "the flight to avoid missing the flight. Thank you.</p>"; 
         }
         else 
             print ("<p>All seats from theis section has been taken!</p>");
         
         
     }
     ?>
         
      <h1>Welcome to Air206</h1>
      
      <?php
      $total = 0;
      $queryTotal = "SELECT Available FROM available";
      if(!($result=mysqli_query($database,$queryTotal)))
      {
          print ("<p>Could not execute query!</p>");
          die("</body></html>");
      }
      while($row = mysqli_fetch_row($result))
      {
          foreach($row as $key => $value)
              $total += $value;
      }
      
      if($total>15)
      {
            print("<h1>Thank you for choosing Air CS206.</h1>");
        	print("<h2>The information for next flight will be available soon.</h2>");
      }
      ?>
      
      <p>
      <table>
      <caption>Price</caption>
      <thead><th>Section</th><th>Price</th>
      </thead>
      <tbody>
      <?php
      foreach($prices as $element => $value)
          print("<tr><td>$element</td><td>$value</td></tr>");
      ?>
      </tbody></table>
	 </p>
	 
	 <p>
      <table>
      <caption>Avalability</caption>
      <thead><th>Section</th><th>Booked</th>
      </thead>
      <tbody>
      <?php 
      $queryAvailable = "SELECT Section, Available FROM available";
      if(!($result=mysqli_query($database,$queryAvailable)))
      {
          print ("<p>Could not execute query!");
          die(mysqli_error()."</body></html>");
      }
      while($row = mysqli_fetch_row($result))
      {
          print("<tr>");
          foreach($row as $key => $value)
              print("<td>$value</td>");
          print("</tr>");
      }
     ?>
      </tbody></table>
	 </p>
	 
	 <p>
	 <table>
	 <caption>Seats Condition</caption>
	 <thead><th>Seat</th>
	 <th>Availability</th></thead>
	 <tbody>
	 <?php
	 $querySeat = "SELECT SeatNumber, SeatAvailable FROM SEAT";
	 if(!($result1=mysqli_query($database,$querySeat)))
	 {
	     print ("<p>Could not execute query!");
	     die(mysqli_error()."</body></html>");
	 }
	 while($row = mysqli_fetch_row($result1))
	 {
	     print("<tr>");
	     foreach($row as $key => $value)
	         print("<td>$value</td>");
	     print("</tr>");
	 }
	 
	 ?>
	 </tbody></table>
	 </p>
	 
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <h2>Passenger Information</h2>

         <!-- create four text boxes for user input -->
         <div><label>First name:</label> 
            <input type = "text" name = "fname"></div>
         <div><label>Last name:</label>
            <input type = "text" name = "lname"></div>
         <div><label>Email:</label>
            <input type = "text" name = "email"></div>
         <div><label>Phone:</label>
            <input type = "text" name = "phone" 
               placeholder = "(555) 555-5555"></div>
         </div>

         <h3>Sections</h3>
         <p>Which section would you like book?</p>

        
         <select name = "section">
            <option>A</option>
            <option>B</option>
            <option>C</option>
         </select>

        
         <p><input type = "submit" name = "submit" value = "Book"></p>
      </form>
      
</html>
