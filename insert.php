<script>
    window.location.href="./"; 
</script>


<?php

    require("db.php");
    $conn = mysqli_connect($host,$username,$password,"board");
    

    $Name=mysqli_real_escape_string($conn,$_GET['Name']);
    $Cont=mysqli_real_escape_string($conn,$_GET['Cont']);
    // for SQL

    $Email=md5(strtolower(trim($_GET['Email'])));
    $Time=time();

    // echo $Name." : ".$Cont;

    $Name = htmlspecialchars($Name);
    $Cont = htmlspecialchars($Cont);
    // for XSS
    
    

    $sql = "INSERT INTO msg (id,name,content,email) VALUES (".$Time.",'".$Name."','".$Cont."','".$Email."')";

    echo $sql;

    if(mysqli_query($conn, $sql))
        echo "<br>Success!";

    else
        echo "<br>Fuck!";
    
?>