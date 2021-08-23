<!DOCTYPE html>
<html>
<head>
<title>Documents</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class='container'>
<h1>Courses:</h1>    
<div class='table-responsive'>
        <table class='table'>
            <tr>
            <th>Id</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Course</th>
            <th>Delete Course</th>
            <th>Add</th>
            </tr>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "myDB";
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql="SELECT * FROM students INNER JOIN studentcourse ON students.Id = studentcourse.StudentId INNER JOIN courses ON studentcourse.Subjects = courses.CourseID WHERE Id=$_GET[id] GROUP BY Subjects";
            $res = $conn->query($sql);
            if($res->num_rows > 0){
                while($rw=$res->fetch_assoc()){
                    echo "<tr id='".$rw["Id"]."'><td>".$rw["Id"]."</td><td data-target='firstName'>".$rw["FirstName"]."</td><td data-target='lastName'>".$rw["LastName"]."</td><td>".$rw["Subject"]."</td><td><a href='http://localhost/files/removecourse.php?subject=$rw[Subjects]&id=$rw[Id]'>"."Remove"."</a>"."</td><td><button id='".$rw["Id"]."' type='button' class='btn btn-default update' data-toggle='modal' data-target='#myModal'>"."Open Modal"."</button></td></tr>";
                }
            }
            ?>
    </table>
        </div>

        <script>
        $(document).on('click','.update',function(){
            var id=$(this).attr('id');
        var firstName=$('#'+id).children('td[data-target=firstName]').text();
        var lastName=$('#'+id).children('td[data-target=lastName]').text();
        $('#userId').val(id);
        $('#firstName').val(firstName);
        $('#lastName').val(lastName);
        });
</script>
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        
      <div class="form-group">
        <label>Id :</label>
        <input type="text" id="userId" class="form-control" readonly name='si'>
        </div>
        <div class="form-group">
        <label>First Name :</label>
        <input type="text" id="firstName" class="form-control" readonly>
        </div>
        <div class="form-group">
        <label>Last Name :</label>
        <input type="text" id="lastName" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Select Subject:</label>
        <select name="ci" id="options">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myDB";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row=$result->fetch_assoc()){
        echo "<option value=$row[CourseID]>"."$row[Subject]"."</option>";
    }
}
$conn->close();
?>
</select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="send btn btn-primary pull-left">Ok</button> 
        <script>
        $('.send').click(function(){
          var ci=$('#options option:selected').attr('value');
          var si=$('.update').attr('id');
          $.ajax({
            url:'selection.php',
            method:'GET',
            data:{ci,si},
            success: function(response){
              
              $('#myModal').modal('toggle');
              
            }
          });
        });
        </script>
    </div>
    </div>

  </div>
</div>   
</div>
</body>
</html>