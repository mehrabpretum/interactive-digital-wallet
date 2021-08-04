<?php 

	define("filepath", "data.txt");
	$amount = $lnumber = $select = "";
	$isValid = true;

	$amountErr = $lnumberErr = $selectErr = "";

	$successfulMessage = $errorMessage = "";

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$select = $_POST['select'];
		$lnumber = $_POST['lnumber'];
		$amount = $_POST['amount'];
		

		if(empty($select)) {
			$selectErr = "can not be empty!";
			$isValid = false;
		}
		if(empty($lnumber)) {
			$lnumberErr = "can not be empty!";
			$isValid = false;
		}
		if(empty($amount)) {
			$amountErr = "can not be empty!";
			$isValid = false;
		}
		
		if($isValid) {
			
            $select  = test_input($select);
			$lnumber = test_input($lnumber);
			$amount = test_input($amount);

			$data = array("select" => $select ,"lnumber" => $lnumber, "amount" => $amount);
			 $data_encode = json_encode($data);
			$result1 = write($data_encode);
			if($result1) {
				$successfulMessage = "Successfully saved.";
			}
			else {
				$errorMessage = "Error while saving.";
			}
		}
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



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<h2>Page 1 [Home]</h2>
	<h3>Digital Wallet</h3>

	<script src="a.js"></script>
	
	<a href="home.php" target="_blank">1.Home </a>
	<a href="history.php" target="_blank">2.Transaction History </a>

    <br><br>

    <p><h2>Found Transfer:</h2></p>
       	<form action="actionJS.php" method="POST" onsubmit = "return isValid()" name = "mForm" id ="nForm">
    <label for="">Select Category:</label>
         <select type="dropdown" id="select" name="select"required value="<?php echo $select; ?>">
      
          <option option selected hidden>Choose an Option</option>
          <option value="Send Money">Send Money</option>
          <option value="Mobile Recharge">Mobile Recharge</option>
          <option value="Merchant Pay">Transfer Money</option>
         </select>

         <br><br>

        <label for="lnumber" >To:</label>
        <input id="lnumber" type="tel" name="lnumber" value="" placeholder="Enter a Namber" required>
        <span style="color: red;"><?php echo $lnumber; ?></span>

        <br><br>

        <label for ="amount">Amount:</label>
        <input id="amount" type="text" name="amount" value="" placeholder="Enter a amount" required>
        <span style="color: red;"><?php echo $amount; ?></span>
        
        <br><br> 
        <input id="submit" type="submit"  value="submit">

    </form>
    <p style="color: green;"><?php echo $successfulMessage; ?></p>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
</body>
</html>
