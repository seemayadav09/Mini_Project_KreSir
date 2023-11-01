<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin_home.css">
    <link rel="stylesheet" href="createuser.css">
    <link rel="stylesheet" href="searchuser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        /* Add your custom styles here */
        #createUserSection{
            margin-left:250px;
        
        }
        #form-right{
            display: none;
        }
    </style>
</head>

<body>
    <div id="header" class="btn-group1">
        <!-- Header content -->
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
        <div class="nav">
            <button class="dropdown-btn">Manage Users
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#createuser">Create User</a>
                <a href="#searchuser">Search User</a>
                <a href="#">Update User</a>
                <a href="#">Delete User</a>
            </div>
            <!-- Additional menu items for Books and Journals -->
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
    </div>
    <section class="create-user-active" id="#createuser">
        <div id="section" class="btn-group1">
            <button onclick="showCreateIndividualUserForm()">Create Individual User</button>
            <button onclick="showBulkUploadForm()">Bulk Upload</button>
        </div>
        <div class="forms">
                <div id="form-left">
                    <div id="navigation-left">
                        <center>
                            <form action="insert.php" method="POST">
                                <!-- Left form content -->
                                <h2>Add New User's Individually</h2>
            
                                <label  for="fname">FULL NAME :</label>
                                <input  type="text" id="fname" min="3" max="30" name="fname" size="30"
                                    placeholder="enter your fullname" required><br>
                                <label  for="username">USER NAME :</label>
                                <input  type="text" id="username" name="username" size="30" placeholder="xyz@gmail.com"
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
        <section class="search-user-active" id="searchuser" >
        <div id="navigation-search">
            <h2><u>Search the Faculty Users</u></h2>
            <form method="POST" action="">
                
                <label for="username"><b>USERNAME:</b></label>
                <input  type="text" name="search" placeholder="Enter email as username" required><br><br>
                <input type="submit" value="Search">
            
            </form>

            <!-- PHP logic to fetch user data based on search -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Retrieve form data
                $id = $_POST['search'];
            
                //Connect to the database
                $conn = new mysqli("127.0.0.1", "root", "", "indenting");
            
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


    <script>
         var createUserButton = document.querySelector('a[href="#createuser"]');
        var searchUserButton = document.querySelector('a[href="#searchuser"]');
        var updateUserButton = document.querySelector('a[href="#updateuser"]');


        // Get references to the Create User and Search User sections
        var createUserSection = document.querySelector('.create-user-active');
        var searchUserSection = document.querySelector('.search-user-active');
        var updateUserSection = document.querySelector('.update-user-active');

        // Add a click event listener to the Create User button
        createUserButton.addEventListener('click', function () {
            // Show the Create User section
            createUserSection.style.display = 'block';
            // Hide the Search User section
            searchUserSection.style.display = 'none';
            updateUserSection.style.display = 'none';
        });

        // Add a click event listener to the Search User button
        searchUserButton.addEventListener('click', function () {
            // Show the Search User section
            searchUserSection.style.display = 'block';
            // Hide the Create User section
            createUserSection.style.display = 'none';
            uodateUserSection.style.display = 'none';
        });
        updateUserButton.addEventListener('click', function () {
            // Show the Search User section
            updateUserSection.style.display = 'block';
            // Hide the Create User section
            createUserSection.style.display = 'none';
            searchUserSection.style.display = 'none';
        });


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
        function toggleCreateUser() {
            var createUserSection = document.getElementById("createUserSection");
            createUserSection.style.display = "none"; // Hide create user section by default
        }

        function showCreateUserSection() {
            var createUserSection = document.getElementById("createUserSection");
            createUserSection.style.display = "block"; // Show create user section when "Create User" is clicked
        }
        function showCreateIndividualUserForm() {
            document.getElementById('form-left').style.display = 'block';
            document.getElementById('form-right').style.display = 'none';
        }

        function showBulkUploadForm() {
            document.getElementById('form-right').style.display = 'block';
            document.getElementById('form-left').style.display = 'none';
        }
        function createIndividualUser() {
            // Get form input values
            const fullName = document.getElementById('fname').value;
            const userName = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (fullName && userName && password) {
                fetch('insert.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        fullname: fullName,
                        username: userName,
                        password: password
                    })
                })
                .then(response => {
                    if (response.ok) {
                        alert('Individual user created successfully!');
                    } else {
                        alert('Failed to create individual user');
                        // Additional error handling if required
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while creating the individual user');
                    // Additional error handling if required
                });
            } else {
                alert('Please fill in all fields to create an individual user.');
            }
        }

        function bulkUploadUsers() {
            const fileInput = document.getElementById('csvfile');
            const formData = new FormData();

            if (fileInput.files.length > 0) {
                formData.append('csvfile', fileInput.files[0]);

                // Perform an action with the uploaded file, for example, sending it to a server
                // Simulate a fetch POST request (replace this with your actual endpoint and method)
                fetch('insertion.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        alert('Bulk user upload successful!');
                        // Additional success handling if required
                    } else {
                        alert('Failed to perform bulk upload');
                        // Additional error handling if required
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during bulk user upload');
                    // Additional error handling if required
                });
            } else {
                alert('Please select a file to perform a bulk upload.');
            }
        }
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
</body>
</html>
