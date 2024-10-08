<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>
<body>
    <style>
        body{
            background-color: #E7ECEF;
            font-family: "Quicksand", sans-serif;
        }

        .date{
            color: #272932;
            font-size: 40px;
            padding: 0;
            margin: 0;
        }
    </style>

    <?php 
    //date
    date_default_timezone_set("Europe/London");
    echo '<div class="date">'.date("d-m-y")."</div>";

    //read file, and write back +=1
    $fileContent = file("test.txt");
    $times = (int)$fileContent[1];
    $times+=1;
    $fileContent[1] = $times; 
    file_put_contents("test.txt", implode("",$fileContent));
    echo("<br>since making this line i have visited this page " . $times . " times!");
    
    /*
    //basic append to screen
    echo "<br>hello!<br>";

    //variable declaration and use
    $food =  "cheese";
    echo "i love " . $food . "<br>";

    //open file, read, and append to screen
    $testFile = fopen("test.txt", "r");
    echo fread($testFile, filesize("test.txt")-3);
    fclose($testFile);
    */
    ?>
    <br><br><br>
    <?php
        $connection = new mysqli("localhost","root","","test");
        $result = $connection->query("SELECT * FROM people");
        echo "<table border='1'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password<th></tr>";

        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $connection->close();
        echo "<br> table inserted from connected database"
    ?>

</body>
</html>