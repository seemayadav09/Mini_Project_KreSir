<!DOCTYPE html>
<head>
    <title>Booking_Details</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <style>
    #navigation
    {
        background-color:lightgreen;
        border: solid lightcoral;
        padding-top: 20px;
        padding-left: 20px;
        padding-bottom: 250px;
    }
    </style>   
</head>
<body>
    <div id="header">
    <h1>Library Books / Journals Indenting System </h1>
        <img src="uoh.jpg" alt="University of Hyderabad">
        </div>
        <div id="section" align="left" class="btn-group1">
            <button onclick="window.location.href='new_user.html'">Create New User</button>
            <button onclick="window.location.href='update_user.php'">Manage Users</button>
            <button onclick="window.location.href='edit_profile.html'">Edit Profile</button>
            <button onclick="window.location.href='adding_books.html'">Add Books</button>
            <button onclick="window.location.href='managing_books.html'">Manage Books</button>
            <button onclick="window.location.href='adding_journals.html'">Add Journals</button>
            <button onclick="window.location.href='managing_journals.html'">Manage Journals</button>
            <button onclick="window.location.href='approve.html'">Approve</button>
        </div>
        <div id="navigation">
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process the uploaded CSV file
    if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
        $file = $_FILES["csvfile"]["tmp_name"];
        
        // Read CSV file
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $book_name = $data[0];
                $author = $data[1];
                $edition = $data[2];
                $isbn = $data[3];
                $publisher = $data[4];
                $year = $data[5];
                $cost = $data[6];
                $field = $data[7];
                
                // Insert data into the "create_new_user" table
                $sql = "INSERT INTO add_new_books (book_name, author, edition, isbn, publisher, year, cost, field) VALUES ('$book_name', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field')";
                if ($conn->query($sql) !== true) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }else{
                    echo "Data added to database successfully"."<br>";
                }
            }
            fclose($handle);
        }
    }
    
    $conn->close();
}
?>
</div>
</body>
</html>