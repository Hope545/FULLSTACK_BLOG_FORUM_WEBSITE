<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 

if(!isset($_SESSION['email'])){
  header("location: ".ADMINURL."admins/login-admins.php");
}

$topics = $conn->query("SELECT * FROM `topics`");
$topics->execute();
$allTopics = $topics->fetchAll(PDO::FETCH_OBJ);

?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Topics</h5>
            
              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">user</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>

                <?php foreach($allTopics as $topic){ ?>
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $topic->id; ?></th>
                    <td><?php echo $topic->title; ?></td>
                    <td><?php echo $topic->category; ?></td>
                    <td><?php echo $topic->user_name; ?></td>
                     <td><a href="delete-topics.php?id=<?php echo $topic->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                </tbody>
                <?php } ?>
                
              </table> 
            </div>
          </div>
        </div>
      </div>


<?php require "../layouts/footer.php"; ?>