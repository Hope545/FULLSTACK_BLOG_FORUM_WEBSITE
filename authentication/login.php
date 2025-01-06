<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>


<?php  

#prevents the user from accessing the login page and register page if the inputs the file url in the browsers search box
if(isset($_SESSION['username'])){
  header("location: ".APPURL."");
}

if(isset($_POST['submit'])){
	if(empty($_POST['email']) && empty($_POST['password'])){
		echo "<script>alert('Incorrect credentials');</script>";
	}
	else{
    #fectching the data from the from the login form;
    $email = $_POST["email"];
    $password = $_POST["password"];

    #writing the query to confirm if the user is a member;
    $login = $conn->query("SELECT * FROM `users` WHERE `email` = '$email'");
    $login->execute();
    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    # checking if the email entered actually exists in the db
    if($login->rowCount() > 0){
      
      #validating the password
      if(password_verify($password, $fetch['password'])){
        // echo "<script>alert('LOGGED IN');</script>";
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['user_id'] = $fetch['id'];
        $_SESSION['name'] = $fetch['name'];
        $_SESSION['user_image'] = $fetch['avatar'];

        header("location: ".APPURL."");
      }
      else{
        echo "<script>alert('Email or Password is wrong.');</script>";
      }
    }
    else{
      echo "<script>alert('Email or Password is wrong.');</script>";
    }

  }
}



?>

    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="main-col">
            <div class="block">
              <h1 class="pull-left">Login</h1>
              <h4 class="pull-right">A Simple Forum</h4>
              <div class="clearfix"></div>
              <hr />

              <form role="form" method="post" action="login.php">
                <div class="form-group">
                  <label>Email Address*</label>
                  <input  type="email"  class="form-control"  name="email"  placeholder="Enter Your Email Address" />
                </div>

                <div class="form-group">
                  <label>Password*</label>
                  <input  type="password"  class="form-control"  name="password" placeholder="Enter A Password"/>
                </div>

                <input  name="submit"  type="submit"  class="color btn btn-default"  value="Register" />
              </form>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div id="sidebar">
            <div class="block">
              <h3>Categories</h3>
              <div class="list-group">
                <a href="#" class="list-group-item active"
                  >All Topics <span class="color badge pull-right">14</span></a
                >
                <a href="#" class="list-group-item"
                  >Design<span class="color badge pull-right">4</span></a
                >
                <a href="#" class="list-group-item"
                  >Development<span class="color badge pull-right">9</span></a
                >
                <a href="#" class="list-group-item"
                  >Business & Marketing
                  <span class="color badge pull-right">12</span></a
                >
                <a href="#" class="list-group-item"
                  >Search Engines<span class="color badge pull-right"
                    >7</span
                  ></a
                >
                <a href="#" class="list-group-item"
                  >Cloud & Hosting
                  <span class="color badge pull-right">3</span></a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php  require "../includes/footer.php"; ?>
