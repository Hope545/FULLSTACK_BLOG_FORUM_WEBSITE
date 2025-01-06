<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php  

if(isset($_SESSION['email'])){
  header("location: ".ADMINURL."");
}

if(isset($_POST['submit'])){
	if(empty($_POST['email']) && empty($_POST['password'])){
		echo "<script>alert('Incorrect credentials');</script>";
	}
	else{
    #fectching the data from the from the admin login form;
    $email = $_POST["email"];
    $password = $_POST["password"];

    #writing the query to confirm if the user is a member;
    $login = $conn->query("SELECT * FROM `admins` WHERE `email` = '$email'");
    $login->execute();
    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    # checking if the email entered actually exists in the admin db
    if($login->rowCount() > 0){
      
      #validating the password
      if(password_verify($password, $fetch['password'])){
        
        $_SESSION['adminname'] = $fetch['adminname'];
        $_SESSION['email'] = $fetch['email'];


         header("location: ".ADMINURL."");
        // echo "<script>alert('Logged In');</script>";
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
 
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>

<?php require "../layouts/footer.php"; ?>