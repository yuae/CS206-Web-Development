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
      
      
	 
		$fname=$lname=$email=$phone=$section=$seat=$price="   ";
		$priceA=rand(100,200);
		$priceB=rand(200,300);
		$priceC=rand(200,300);
		
		$availableA=$availableB=$availableC='0';
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    $fname = $_POST["fname"];
		    $lname = $_POST["lname"];
		    $email = $_POST["email"];
		    $phone = $_POST["phone"];
		    $section = $_POST["section"];
		    if ($section=="A")
		    {
		        if($_SESSION['seatA']<6)
		        {
		          $_SESSION["seats"][$_SESSION['seatA']]='1';
		          $_SESSION['seatA']++;
		          $seat=$_SESSION['seatA'];
		          $price=$priceA;
		        }
		        else 
		            $availableA=1;
		    }
		    else if ($section=="B")
		    {
		        if ($_SESSION['seatB']<11)
		        {
		          $_SESSION["seats"][$_SESSION['seatB']]='1';
		          $_SESSION['seatB']++;
		          $seat=$_SESSION['seatB'];
		          $price=$priceB;
		        }
		        else 
		            $availableB=1;
		    }
		    else if ($section=="B")
		    {
		        if($_SESSION['seatC']<16)
		        {
		          $_SESSION["seats"][$_SESSION['seatC']]='1';
		          $_SESSION['seatC']++;
		          $seat=$_SESSION['seatC'];
		          $price=$priceC;
		        }
		        else 
		            $availableC=1;
		    }
		    $_SESSION['count']=$_SESSION['count']+1;
		}
		
		    
      ?>
      <?php
      if($_SESSION['count']>14)
      {
            print("<h1>Thank you for choosing Air CS206.</h1>");
        	print("<h2>The information for next flight will be available soon.</h2>");
      }
      ?>
      <h1>Welcome to Air CS206!</h1>
      <p>
      <table>
      <caption>Price</caption>
      <thead><th>Section</th><th>Price</th>
      </thead>
      <tbody><tr><td>A</td>
      <td><?php print( $priceA ); ?></td></tr>
      <tr><td>B</td><td><?php print( $priceB ); ?></td></tr>
      <tr><td>C</td><td><?php print( $priceC ); ?></td></tr>
      </tbody></table>
	 </p>
	 
	 <p >
	 <table>
	 <caption>Seats Condition</caption>
	 <thead><th>Section</th><th>Seat</th>
	 <th>Availability</th></thead>
	 <tbody><tr><td>A</td><td>1</td><td>
	 <?php print($_SESSION['seats'][0]); ?></td></tr>
	 <tr><td>A</td><td>2</td><td>
	 <?php print($_SESSION['seats'][1]); ?></td></tr>
	 <tr><td>A</td><td>3</td><td>
	 <?php print($_SESSION['seats'][2]); ?></td></tr>
	 <tr><td>A</td><td>4</td><td>
	 <?php print($_SESSION['seats'][3]); ?></td></tr>
	 <tr><td>A</td><td>5</td><td>
	 <?php print($_SESSION['seats'][4]); ?></td></tr>
	 <tr><td>B</td><td>6</td><td>
	 <?php print($_SESSION['seats'][5]); ?></td></tr>
	 <tr><td>B</td><td>7</td><td>
	 <?php print($_SESSION['seats'][6]); ?></td></tr>
	 <tr><td>B</td><td>8</td><td>
	 <?php print($_SESSION['seats'][7]); ?></td></tr>
	 <tr><td>B</td><td>9</td><td>
	 <?php print($_SESSION['seats'][8]); ?></td></tr>
	 <tr><td>B</td><td>10</td><td>
	 <?php print($_SESSION['seats'][9]); ?></td></tr>
	 <tr><td>C</td><td>11</td><td>
	 <?php print($_SESSION['seats'][10]); ?></td></tr>
	 <tr><td>C</td><td>12</td><td>
	 <?php print($_SESSION['seats'][11]); ?></td></tr>
	 <tr><td>C</td><td>13</td><td>
	 <?php print($_SESSION['seats'][12]); ?></td></tr>
	 <tr><td>C</td><td>14</td><td>
	 <?php print($_SESSION['seats'][13]); ?></td></tr>
	 <tr><td>C</td><td>15</td><td>
	 <?php print($_SESSION['seats'][14]); ?></td></tr>
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
      
      <?php 
      if($section=="A" && $availableA=='1')
          print("Sorry, this section is full.");
      if($section=="B" && $availableB=='1')
          print("Sorry, this section is full.");
      if($section=="C" && $availabelC=='1')
          print("Sorry, this section is full.");
      
      
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
           
       
      ?>
   </body>
</html>
