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
    email VARCHAR(50),
    ip VARCHAR(30),
    content VARCHAR(1000)
    )"; 
    mysqli_query($conn, $sql);

?>


<md-toolbar md-scroll-shrink>
    <div class="md-toolbar-tools">留言板</div>
</md-toolbar>


<?php
    $sql = "SELECT name,content,email FROM msg order by id desc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
        {
            ?>
<md-card>
<md-card-title>
    <md-card-title-media>
      <div class="md-media-sm card-media layout-row" layout="" style="padding:10px">
        <img style="border-radius: 9px;" src="http://cn.gravatar.com/avatar/<?php echo $row["email"]; ?>?s=256" height=100%>
      </div>
    </md-card-title-media>
    <md-card-title-text>
      <span class="md-headline ng-binding" style="word-break:break-all;">
        <?php echo $row["name"]?>
      </span>
      <span class="md-subhead description ng-binding" style="word-break:break-all;">
        <?php echo $row["content"]; ?>
      </span>
    </md-card-title-text>
  </md-card-title>
</md-card>
        
            <?php
        }
?>

<md-card>
  <md-content layout-padding>
    <p style="margin:0px;">新的留言</p><?php echo $row["name"]?>
    <form name="projectForm" action="insert.php" method="get">


    <div layout="row">
      <md-input-container class="md-block" flex="30">
        <label>Name</label>
        <input required md-no-asterisk name="Name" ng-model="project.Name">
        <div ng-messages="projectForm.Name.$error">
          <div ng-message="required">您要填一下自己的名字…….</div>
        </div>
      </md-input-container>
      <md-input-container class="md-block" flex="70">
        <label>Email</label>
        <input required md-no-asterisk name="Email" ng-model="project.Email">
        <div ng-messages="projectForm.Email.$error">
          <div ng-message="required">您要填一下自己的Email…….</div>
        </div>
      </md-input-container>
    </div>

      <md-input-container class="md-block">
          <label>Content</label>
            <textarea name="Cont" ng-model="user.biography" required  rows="5" md-select-on-focus ng-model="project.Cont"></textarea>
            <div ng-messages="projectForm.Cont.$error">
                <div ng-message="required">您要说几句话吧…….</div>
            </div>
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
