<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>

<?php 

#prevents the user from accessing the login page and register page if the inputs the file url in the browsers search box
if(!isset($_SESSION['username'])){
	header("location: ".APPURL."");
  }

  #grabbing the data
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = $conn->query("SELECT * FROM `replies` WHERE `id` = '$id'");
    $select->execute();

    $reply = $select->fetch(PDO::FETCH_OBJ);

    if($reply->user_id !== $_SESSION['user_id']){
        header("location: ".APPURL."");
    }
  }

# validating the users input
if(isset($_POST['submit'])){
	if(empty($_POST['reply'])){
		echo "<script>alert('One or more inputs are empty');</script>";
	}
	else{
		# storing the users data from the form in variables
		$reply = $_POST['reply'];

		# so now storing all the data in our database;
		$update = $conn->prepare("UPDATE `replies` SET `reply` = :reply WHERE `id` = '$id'" );
		$update->execute([
			":reply" => $reply,
		]);

		# after successfully creating a topic, i should be redirected to the home page;
		header("location: ".APPURL."");
	}
}
  ?>

    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="main-col">
            <div class="block">
              <h1 class="pull-left">Edit your reply</h1>
              <h4 class="pull-right">A Simple Forum</h4>
              <div class="clearfix"></div>
              <hr />
              <form role="form" method="post" action="update.php?id=<?php echo $id; ?>">
                <div class="form-group">
                  <label>Reply</label>
                  <input
                    type="text"
                    value="<?php echo $reply->reply; ?>"
                    class="form-control"
                    name="reply"
                    placeholder="Enter Reply"
                  />
                </div>
                <button type="submit" name="submit" class="color btn btn-default">
                  Update
                </button>
              </form>
            </div>
          </div>
        </div>

    
<?php require "../includes/footer.php" ?>