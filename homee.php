<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<h2>Page 1 [Home]</h2>
	<h3>Digital Wallet</h3>

	<a href="home.php" target="_blank">1.Home </a>
	
	<a href="history.php" target="_blank">2.Transaction History </a>
    <br><br>

       <?php
         define("filepath", "data.txt");

     $lnumber = "";
     $amount= "";
     $select = "";

     if($_SERVER['REQUEST_METHOD']==="POST")
	  {
	  	$select = test_input($_POST['select']);
     $lnumber = test_input($_POST['lnumber']);
  
     $amount = test_input($_POST['amount']);
	      }
    function write($content) {
    $resource = fopen(filepath, "a");
    $fw = fwrite($resource, $content . "\n");
    fclose($resource);
     return $fw;
     }

     function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
       return $data;
      }
         ?>

       <div class="div1">
       <p><h2>Found Transfer:</h2></p>
       <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="">Select Category:</label><span></span>
         <select class="" name="select" id="select" required>
         <span style="color: red;"><?php echo $amount; ?></span>
          <option option selected hidden>Choose an Option</option>
          <option value="Send Money">Send Money</option>
          <option value="Mobile Recharge">Mobile Recharge</option>
          <option value="Merchant Pay">Transfer Money</option>
         
         </select>

        <br><br>
        <label for="lnumber" >To:</label>
        <input id="lnumber" type="tel" name="lnumber" value="" placeholder="Enter a Namber" >
        <span style="color: red;"><?php echo $lnumber; ?></span>
        <br><br>
        <label for ="amount">Amount:</span>:</label>
        <input id="amount" type="text" name="amount" value="" placeholder="Enter a amount" >
        <span style="color: red;"><?php echo $amount; ?></span>
        
        <br><br> 
        <input id="submit" type="submit"  value="submit">

        <br>

       <span style="color: green;"><?php echo $successfulMessage; ?></span>
       <span style="color: red;"><?php echo $errorMessage; ?></span>

        
      </form>

    </div>
    <?php
     
      $fileData = read();
      $fileDataExplode = explode("\n", $fileData);

       echo "<ol>";
      for($i = 0; $i < count($fileDataExplode) - 1; $i++) {
     echo "<li>" . $fileDataExplode[$i] . "</li>";
    }
   echo "</ol>";

   function read() {
   $resource = fopen(filepath, "r");
    $fz = filesize(filepath);
   $fr = "";
   if($fz > 0) {
   $fr = fread($resource, $fz);
    }
   fclose($resource);
   return $fr;
   }
    ?>
</body>
</html>