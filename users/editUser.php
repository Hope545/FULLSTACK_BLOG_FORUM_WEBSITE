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

    $select = $conn->query("SELECT * FROM `users` WHERE `id` = '$id'");
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);

    #making sure that other users don't use a URL to access another user's data or files
    if($user->id !== $_SESSION['user_id']){
        header("location: ".APPURL."");
    }
  }

# validating the users input
if(isset($_POST['submit'])){
	if(empty($_POST['email']) OR empty($_POST['about'])){
		echo "<script>alert('One or more inputs are empty');</script>";
	}
	else{
		# storing the users data from the form in variables
		$email = $_POST['email'];
		$about = $_POST['about'];


		# so now storing all the data in our database;
		$update = $conn->prepare("UPDATE `users` SET `email` = :email, `about` = :about WHERE `id` = '$id'");
		$update->execute([
			":email" => $email,
			":about" => $about,
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
              <h1 class="pull-left">Create A Topic</h1>
              <h4 class="pull-right">A Simple Forum</h4>
              <div class="clearfix"></div>
              <hr />
              <form role="form" method="post" action="editUser.php?id=<?php echo $id; ?>">
                <div class="form-group">
                  <label>Email</label>
                  <input
                    type="text"
                    value="<?php echo $user->email; ?>"
                    class="form-control"
                    name="email"
                    placeholder="Enter email"
                  />
                </div>
                
                <div class="form-group">
                  <label>About</label>
                  <textarea
                    id="body"
                    rows="10"
                    cols="80"
                    class="form-control"
                    name="about"
                  ><?php echo $user->about; ?></textarea>
                  <script>
                    CKEDITOR.replace("body");
                  </script>
                </div>
                <button type="submit" name="submit" class="color btn btn-default">
                  Update
                </button>
              </form>
            </div>
          </div>
        </div>

    
<?php require "../includes/footer.php" ?>