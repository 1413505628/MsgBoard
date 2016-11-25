<script>
    window.location.href="./"; 
</script>

<?php

    function check_input($value)
    {
        if (get_magic_quotes_gpc())
            $value = stripslashes($value);

        if (!is_numeric($value))
            $value = "'" . mysql_real_escape_string($value) . "'";
        
        return $value;
    }

    require("db.php");

    $Name=check_input($_GET['Name']);
    $Cont=check_input($_GET['Cont']);
    // for SQL

    $Time=time();

    // echo $Name." : ".$Cont;

    $Name = htmlspecialchars($Name);
    $Cont = htmlspecialchars($Cont);
    // for XSS
    
    $conn = mysqli_connect($host,$username,$password,"board");

    $sql = "INSERT INTO msg (id,name,content) VALUES (".$Time.",'".$Name."','".$Cont."')";

    echo $sql;

    if(mysqli_query($conn, $sql))
        echo "<br>Success!";

    else
        echo "<br>Fuck!";
    
?>


