<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>

<?php 

#prevents the user from accessing the login page and register page if the inputs the file url in the browsers search box
if(!isset($_SESSION['username'])){
	header("location: ".APPURL."");
  }

# validating the users input
if(isset($_POST['submit'])){
	if(empty($_POST['title']) OR empty($_POST['category']) OR empty($_POST['body'])){
		echo "<script>alert('One or more inputs are empty');</script>";
	}
	else{
		# storing the users data from the form in variables
		$title = $_POST['title'];
		$category = $_POST['category'];
		$body = $_POST['body'];
    $user_name = $_SESSION['name'];
    $user_image = $_SESSION['user_image'];


		# so now storing all the data in our database;
		$insert = $conn->prepare("INSERT INTO `topics` (`title`, `category`, `body`, `user_name`, `user_image`) VALUES (:title, :category, :body, :user_name, :user_image)");
		$insert->execute([
			":title" => $title,
			":category" => $category,
			":body" => $body,
      ":user_name" => $user_name,
      ":user_image"=> $user_image,
		]);
    

		# after successfully creating a topic, i should be redirected to the home page;
		header("location: ".APPURL."");
	}
}

  #grabbing categories dyamically
  $categories = $conn->prepare("SELECT * FROM `categories`");
  $categories->execute();

  $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);
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
              <form role="form" method="post" action="create.php">
                <div class="form-group">
                  <label>Topic Title</label>
                  <input
                    type="text"
                    class="form-control"
                    name="title"
                    placeholder="Enter Post Title"
                  />
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="category">
                    <?php foreach($allCategories as $category){ ?>
                      <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    
                    <?php } ?>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label>Topic Body</label>
                  <textarea
                    id="body"
                    rows="10"
                    cols="80"
                    class="form-control"
                    name="body"
                  ></textarea>
                  <script>
                    CKEDITOR.replace("body");
                  </script>
                </div>
                <button type="submit" name="submit" class="color btn btn-default">
                  Create
                </button>
              </form>
            </div>
          </div>
        </div>

    
<?php require "../includes/footer.php" ?>