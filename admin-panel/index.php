<?php require "../admin-panel/layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php  

if(!isset($_SESSION['email'])){
  header("location: ".ADMINURL."admins/login-admins.php");
}

#fetching the total number of topics created from the db
$topics = $conn->query("SELECT COUNT(*) AS count_topics FROM `topics`");
$topics->execute();
$allTopics = $topics->fetch(PDO::FETCH_OBJ);

#fetching the total number of categories created from the db
$categories = $conn->query("SELECT COUNT(*) AS count_category FROM `categories`");
$categories->execute();
$allCategories = $categories->fetch(PDO::FETCH_OBJ);

#fetching the total number of admins created from the db
$admins = $conn->query("SELECT COUNT(*) AS count_admin FROM `admins`");
$admins->execute();
$allAdmins = $admins->fetch(PDO::FETCH_OBJ);

#fetching the total number of replies created from the db
$replies = $conn->query("SELECT COUNT(*) AS count_reply FROM `replies`");
$replies->execute();
$allReplies = $replies->fetch(PDO::FETCH_OBJ);



?>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Topics</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">number of topics: <?php echo $allTopics->count_topics; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Categories</h5>

        <p class="card-text">number of categories: <?php echo $allCategories->count_category; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Admins</h5>

        <p class="card-text">number of admins: <?php echo $allAdmins->count_admin; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Replies</h5>

        <p class="card-text">number of replies: <?php echo $allReplies->count_reply; ?></p>
      </div>
    </div>
  </div>
</div>

<?php require "../admin-panel/layouts/footer.php"; ?>
