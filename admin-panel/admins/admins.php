<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 

#preventing the user from accessing this page is he is not logged in
if(!isset($_SESSION['email'])){
  header("location: ".ADMINURL."admins/login-admins.php");
}

$admins = $conn->query("SELECT * FROM `admins`");
$admins->execute();
$allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);


?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL; ?>admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <?php foreach ($allAdmins as $admin) { ?>
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                   
                  </tr>
                </tbody>
                <?php } ?>
              </table> 
            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>