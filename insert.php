<script>
    window.location.href="./"; 
</script>

<?php

    require("db.php");

    $Name=$_GET['Name'];
    $Cont=$_GET['Cont'];
    $Time=time();

    // echo $Name." : ".$Cont;

    $conn = mysqli_connect($host,$username,$password,"board");

    $sql = "INSERT INTO msg (id,name,content) VALUES (".$Time.",'".$Name."','".$Cont."')";

    echo $sql;

    if(mysqli_query($conn, $sql))
        echo "<br>Success!";

    else
        echo "<br>Fuck!";
    
?>


