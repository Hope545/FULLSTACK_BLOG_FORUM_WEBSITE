<?php 


#number of posts inside every category
$categories = $conn->query("SELECT categories.id as id, categories.name as name, 
COUNT(topics.category) as count_category FROM categories LEFT JOIN topics ON 
categories.name = topics.category GROUP BY(topics.category)");

$categories->execute();
$allCategories  = $categories->fetchAll(PDO::FETCH_OBJ);

#forum statistics
# counting the total number of users
$users = $conn->query("SELECT COUNT(*) AS count_users FROM `users`");
$users->execute();
$allUsers = $users->fetch(PDO::FETCH_OBJ);

#counting all the topics in the website
$topics = $conn->query("SELECT COUNT(*) AS all_topics FROM `topics`");
$topics->execute();

$allTopics = $topics->fetch(PDO::FETCH_OBJ);

#counting all the categories in the website
$category = $conn->query("SELECT COUNT(*) AS count_category FROM `categories`");
$category->execute();

$totalCategories = $category->fetch(PDO::FETCH_OBJ);


?>



<div class="col-md-4">
				<div class="sidebar">
					
					
					<div class="block">
					<h3>Categories</h3>
					<div class="list-group block ">
						<a href="#" class="list-group-item active">All Topics <span class="badge pull-right"><?php echo $allTopics->all_topics; ?></span></a> 

						<?php foreach($allCategories as $category) { ?>
						<a href="<?php echo APPURL; ?>/category/show.php?name=<?php echo $category->name; ?>" class="list-group-item"><?php echo $category->name;  ?><span class="color badge pull-right"><?php echo $category->count_category ?></span></a>
						<?php } ?>
					</div>
					</div>

					<div class="block" style="margin-top: 20px;">
						<h3 class="margin-top: 40px">Forum Statistics</h3>
						<div class="list-group">
							<a href="#" class="list-group-item">Total Number of Users:<span class="color badge pull-right"><?php echo $allUsers->count_users; ?></span></a>
							<a href="#" class="list-group-item">Total Number of Topics:<span class="color badge pull-right"><?php echo $allTopics->all_topics; ?></span></a>
							<a href="#" class="list-group-item">Total Number of Categories: <span class="color badge pull-right"><?php echo $totalCategories->count_category; ?></span></a>
							
						</div>
				    </div>
			    </div>	
				</div>
			</div>
		</div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo APPURL; ?>js/bootstrap.js"></script>

    </body>
</html>