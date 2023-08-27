<!DOCTYPE html>
<head>
    <title>Booking_Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #navigation
        {
            background-color:lightgreen;
            border: solid lightcoral;
            padding-top:20px;
            padding-bottom: 250px;
            padding-left: 10px;
        }
  </style>
</head>
<body>
<div id="header">
        <h1>Library Books / Journals Indenting System </h1>
            <img src="uoh.jpg" alt="University of Hyderabad">
            </div>
            <div id="section" align="left" class="btn-group1">
                <button onclick="window.location.href='update_user.php'">Update Users</button>
                <button onclick="window.location.href='delete_user.php'">Delete Users</button>
                <button onclick="window.location.href='search_user.php'">Search Users</button>     
            </div>
        <div id="navigation">
        <h1><u>Search the Faculty Users</u> </h1>
          <form method="POST" action=""> 
            <center>
          <label for="username"><b> USERNAME : </b></label>
          <input type="text" name="search" placeholder="enter your email as username" size="30" required ><br><br>
            <input type="submit"  value="search"></center>
        </form> 

        
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Retrieve form data
  $id = $_POST['search'];

  //Connect to the database
  $conn = new mysqli("127.0.0.1:3308", "root", "", "indenting");

  //Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //Retrieve data from the database by using id
  $sql = "SELECT * FROM create_new_user WHERE username = '$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    //output data of each row
    while($row = mysqli_fetch_assoc($result))   //to fetch a single row from the result set returned by MySQL database query
    {
      //echo "<div style='background-color: lightgreen; padding: 10px; border: solid lightcoral;'>";
      echo " <p style='font-weight: bold; font-size:38px;'> 
            Full Name : " . $row["fname"]. "<br>";
      echo "Username  : " . $row["username"]. "<br>";
      echo "Password  : " . $row["password"]. "<br>";
      echo "</p>";
      echo "</div>";
    }
  } else {
    echo "No users found with the given UserName";
  }

  mysqli_close($conn);
}

?>

</div>
</body>
</html>
