<?php
require __DIR__.'/bootstrap/autoload.php';

    $servername = 'localhost';
    $username = $_POST['db_user'];
    $password = $_POST['db_pass'];
    $dbname = $_POST['db_name'];

    $app_name = $_POST['app_name'];
    $email = $_POST['email'];
    $hash = password_hash($_POST["password"], PASSWORD_BCRYPT,
        array('cost' => 10));

    $content = [
        29 => "'default' => 'mysql',",
        74 => "'host'     => 'localhost',",
        75 => "'database'  => '$dbname',",
        76 => "'username'  => '$username',",
        77 => "'password'  => '$password',",
    ];


    function edit($content){
        $filename = __DIR__.'/config/database.php';
        chmod($filename, 0777);
        foreach($content as $line => $modifiedContent ) {
            $line_i_am_looking_for = $line-1;
            $lines = file( $filename , FILE_IGNORE_NEW_LINES );
            $lines[$line_i_am_looking_for] = $modifiedContent;
            file_put_contents( $filename , implode( "\n", $lines ) );
        }
    }

    edit($content);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to create table
    $sql = "devless_production.sql";

    $templine = '';
    $lines = file($sql);

    foreach ($lines as $line)
    {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

      // Add this line to the current segment
      $templine .= $line;
      // If it has a semicolon at the end, it's the end of the query
      if (substr(trim($line), -1, 1) == ';')
      {

        if ($conn->query($templine) != TRUE) {
          echo "Error creating tables: " . $conn->error;
        }

        $templine = '';
      }

    }

    $db = "INSERT INTO users (email, password, role, status)
        VALUES ('$email', '$hash', 1, 0);";

    $db .= "INSERT INTO apps (name)
        VALUES ('$app_name');";

    $conn->multi_query($db);

    $conn->close();

    header("Location: http://".$_SERVER["HTTP_HOST"].'/');
