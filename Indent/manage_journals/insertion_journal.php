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
                $journalName = $data[0];
                $journalNumber = $data[1];
                $publisher = $data[2];
                $year = $data[3];
                $field = $data[4];
                
                // Insert data into the "create_new_user" table
                $sql = "INSERT INTO journals (journalName, journalNumber, publisher, year, field) VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$field')";
                if ($conn->query($sql) == true) {
                    echo "Data added to database successfully"."<br>";
                ?>
                    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/delete_journals.php">
                <?php                    
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            fclose($handle);
        }
    }
    
    $conn->close();
}
?>
