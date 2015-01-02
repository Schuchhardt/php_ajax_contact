<?php
// Debug on browser console
include 'vendor/ChromePhp.php';

//Database Config
require 'db_config.php';

// Create a new message with AJAX POST request
if($_POST)
{
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    
        //exit script outputting json data
        $output = json_encode(
        array(
            'type'=>'error', 
            'text' => 'Request must come from Ajax'
        ));
        
        die($output);
    } 

    //check $_POST vars are set, exit if any missing
    if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userMessage"]))
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Los campos están vacios!'));
        die($output);
    }

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);

    //check if email is valid
    if (!filter_var($user_Email, FILTER_VALIDATE_EMAIL)){
        $output = json_encode(array('type'=>'error', 'text' => 'El Correo no es valido!'));
        die($output);
    }


    if(DB === "mysql"){
        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "INSERT INTO sebastian_schuchhardt (nombre, email, message)
        VALUES ('$user_Name','$user_Email','$user_Message' )";

        
        if($conn->query($sql) === TRUE)
        {
            $output = json_encode(array('type'=>'error', 'text' => 'No se pudo enviar tu mensaje. u.u'));
            die($output);
        }else{
            $output = json_encode(array('type'=>'success', 'text' => 'Gracias por contactarte con nosotros!'));
            die($output);
        }

        $conn->close();
    }
   if(DB ==="postgres"){

       $dbconn = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD)
         or die(json_encode($dbconn));

        //perform the insert using pg_query
        $result = pg_query($dbconn, "INSERT INTO contacto(id, nombre, email, mensaje) VALUES(nextval('idcontacto_pk_seq'),'$user_Name','$user_Email','$user_Message' );");

        $output = json_encode(array('type'=>'success', 'text' => 'Gracias por contactarte con nosotros!'));
            die($output);
        // Closing connection
        pg_close($dbconn);
    }

    
}


// Show a list of messages with AJAX GET request
if(isset($_GET))
{
        $result_obj = array();
        $dbconn = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD);
        //  or die(json_encode($dbconn));
        
        //perform the selecy using pg_query
        $result = pg_query($dbconn, "SELECT * FROM contacto;");

        while ($row = pg_fetch_row($result)) {
          $result_obj[] = $row;
        }
        $output = json_encode($result_obj);
            die($output);
        // Closing connection
        pg_close($dbconn);

}
?>