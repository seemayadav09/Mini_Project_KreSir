<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin_home.css">
    <link rel="stylesheet" href="createuser.css">
    <link rel="stylesheet" href="searchuser.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/TagCloud@2.2.0/dist/TagCloud.min.js"></script>
    <link rel="stylesheet" href="path/to/fontawesome.min.css">
</head>

<body>
    <div id="header" class="btn-group1">
        <div id="img_left">
            <img src="uoh_logo_white.png" alt="University of Hyderabad">
        </div>
        <div id="title">
            <h1>School of Computer and Information Sciences</h1>
            <h2>Library Books / Journals Indenting System</h2>
        </div>

        <div id="img_right">
            <img src="uoh_ioe_white.png" alt="University of Hyderabad">
        </div>
    </div>
    <div class="sidenav">
        <button class="dropdown-btn" >Manage Users
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
          <a href="#createuser">Create User</a>
          <a href="#searchuser">Search User</a>
          <a href="#">Update User</a>
          <a href="#">Delete User</a>
        </div>
        <button class="dropdown-btn" >Manage Books
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a href="#">Create Books</a>
            <a href="#">Search Books</a>
            <a href="#">Update Books</a>
            <a href="#">Delete Books</a>
          </div>
          <button class="dropdown-btn" >Manage Journals
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a href="#">Create Journals</a>
            <a href="#">Search Journals</a>
            <a href="#">Update Journals</a>
            <a href="#">Delete Journals</a>
          </div>
          <button class="dropdown-btn" >Edit Profile
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a href="#">Create User</a>
            <a href="#">Search User</a>
            <a href="#">Update User</a>
            <a href="#">Delete User</a>
          </div>
        
      </div>
      
      
      
      <script>
      /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
      var dropdown = document.getElementsByClassName("dropdown-btn");
      var i;
      
      for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var dropdownContent = this.nextElementSibling;
          if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
          } else {
            dropdownContent.style.display = "block";
          }
        });
      }
      </script>
      <section class="create-user-active" id="#createuser">
        <div class="forms">
            <div id="form-left">
                <div id="navigation-left">
                    <center>
                        <form action="insert.php" method="POST">
                            <!-- Left form content -->
                            <h2>Add New User's Individually</h2>
        
                            <label for="fname">FULL NAME :</label>
                            <input type="text" id="fname" min="3" max="30" name="fname" size="30"
                                placeholder="enter your fullname" required><br>
                            <label for="username">USER NAME :</label>
                            <input type="text" id="username" name="username" size="30" placeholder="xyz@gmail.com"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br>
                            <label for="password">PASSWORD:</label>
                            <div style="position: relative;">
                                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                                <span id="password-toggle" class="password-toggle" onclick="togglePasswordVisibility()">
                                    <img src="eye-slash.svg" alt="Toggle Password Visibility">
                                </span>
                            </div>
                            <div id="button">
                                <input type="submit" value="Submit" id="submit">
                                <input type="reset" value="Reset">
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        
            <div id="form-right">
                <div id="navigation-right">
                    <center>
                        <form action="insertion.php" method="POST" enctype="multipart/form-data">
                            <!-- Right form content -->
                            <h2>Bulk Uploading of New User's</h2>
                            <br><br>
                            <!-- Existing input fields -->
        
                            <label for="csvfile">Upload CSV File:</label>
                            <input type="file" id="csvfile" name="csvfile" accept=".csv">
                            <br><br><br><br>
                            <div id="button">
                                <input type="submit" value="Submit" id="submit">
                                <input type="reset" value="Reset" id="reset">
                            </div>
                        </form>
                    </center>
                </div>
            </div>

        </div>
        
    </section>
    <script>
        // Get the current page URL
        var currentPage = window.location.href;
    
        // Check if the current page URL matches the "new_user.html" URL
        if (currentPage.includes("create.html")) {
            // Add the "active" class to the button
            document.getElementById("create-user-btn").classList.add("active");
        }
    </script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggle = document.getElementById("password-toggle");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.innerHTML = '<img src="eye.svg" alt="Toggle Password Visibility">';
            } else {
                passwordInput.type = "password";
                passwordToggle.innerHTML = '<img src="eye-slash.svg" alt="Toggle Password Visibility">';
            }
        }
    </script>
    <section class="search-user-active" id="#searchuser">
        <div id="navigation-search">
            <h2><u>Search the Faculty Users</u> </h2>
            <form method="POST" action="">
            <center>
                <label for="username"><b> USERNAME : </b></label>
                <input type="text" name="search" placeholder="enter your email as username" size="30" required><br><br>
                <input type="submit" value="search">
            </center>
            </form>
        
        
            <?php
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                while ($row = mysqli_fetch_assoc($result))   //to fetch a single row from the result set returned by MySQL database query
                {
                //echo "<div style='background-color: lightgreen; padding: 10px; border: solid lightcoral;'>";
                echo " <p style='font-weight: bold; font-size:38px;'> 
                    Full Name : " . $row["fname"] . "<br>";
                echo "Username  : " . $row["username"] . "<br>";
                echo "Password  : " . $row["password"] . "<br>";
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
    </section>
    
    
        
    
    
</body>
</html>