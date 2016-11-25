<html>

<head>
    <meta charset = 'UTF-8'>
    <title>留言板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/angular-material.min.css">
</head>

<body ng-app="BlankApp" ng-cloak>

<?php 

    require("db.php");

    $conn = mysqli_connect($host,$username,$password);
    if (!$conn)
        die('无法连接mysql:' . mysqli_connect_error());
    
    mysqli_query($conn,"CREATE database board");

    $conn = mysqli_connect($host,$username,$password,"board");
    $sql = "CREATE TABLE msg (
    id INT(10),
    name VARCHAR(30),
    content VARCHAR(1000)
    )"; 
    mysqli_query($conn, $sql);

?>


<md-toolbar md-scroll-shrink>
    <div class="md-toolbar-tools">留言板</div>
</md-toolbar>


<?php
    $sql = "SELECT name,content FROM msg order by id desc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
        {
            ?>
<md-card>
<md-card-title>
    <md-card-title-media>
      <div class="md-media-sm card-media layout-row" layout="">
        <md-icon>
        <svg xmlns="http://www.w3.org/2000/svg" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" focusable="false"><g id="person"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></g></svg>
        </md-icon>
      </div>
    </md-card-title-media>
    <md-card-title-text>
      <span class="md-headline ng-binding"><?php echo $row["name"]?></span>
      <span class="md-subhead description ng-binding"><?php echo $row["content"]; ?></span>
    </md-card-title-text>
  </md-card-title>
</md-card>
        
            <?php
        }
    
    else
        echo "<p style='margin:2px;padding:4px'>还没有留言……</p>";
?>

<md-card>
  <md-content layout-padding>
    <p style="margin:0px;">新的留言</p>
    <form name="projectForm" action="insert.php" method="get" traget="_blank">

      <md-input-container class="md-block">
        <label>Name</label>
        <input md-maxlength="15" required md-no-asterisk name="Name" ng-model="project.Name">
        <div ng-messages="projectForm.Name.$error">
          <div ng-message="required">您要填一下自己的名字…….</div>
          <div ng-message="md-maxlength">哪有这么长的名字……</div>
        </div>
      </md-input-container>

      <md-input-container class="md-block">
          <label>Content</label>
            <textarea name="Cont" ng-model="user.biography" md-maxlength="150" rows="5" md-select-on-focus></textarea>
        </md-input-container>

      <md-button class="md-raised" type="submit" style="float:right; margin:20px">Submit!</md-button>

    </form>
  </md-content>
</md-card>




<!-- Angular Material requires Angular.js Libraries -->
  <script src="js/angular.min.js"></script>
  <script src="js/angular-animate.min.js"></script>
  <script src="js/angular-aria.min.js"></script>
  <script src="js/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="js/angular-material.min.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    

    angular.module('BlankApp', ['ngMaterial', 'ngMessages'])

.controller('BlankApp', function($scope) {
  $scope.project = {
    description: 'Nuclear Missile Defense System',
    rate: 500
  };
});
  </script>
  
</body>
</html>
