<script>
	document.title = "Admin: Add Book";
</script>

<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';

	$bookNameError=$authorNameError=$priceError=$categoryError=$descError=$coverFileError="";
	$bookName=$author=$price=$category=$isbn=$desc=$imgfile="";
	$status="";

	if(isset($_POST['add-book-submit'])){
		//validate book
		$bookName = check($_POST['bookName']);
		if(empty($bookName)){
			$bookNameError="Enter a book name";
		}
		//validate author
		$author = check($_POST['authorName']);
		if(empty($author)){
			$authorNameError="Enter author name";
		}
		else{
			$authorpattern='/^[a-zA-Z ]+$/';
			if(!preg_match($authorpattern, $author)){
				$authorNameError="Incorret author name";
			}
		}
		//price validation
		$price = (int)$_POST['price'];
		if($price<0){
			$priceError="Price can not be negative";
		}
		//category validation
		$category = $_POST['category'];
		if($category==""){
			$categoryError="Invalid Category";
		}
		//isbn
		$isbn = check($_POST['isbn']);
		//desc validation
		$desc = check($_POST['desc']);
		if(empty($desc)){
			$descError="Enter Book Description";
		}
		//file validation
		if(!isset($_FILES['imgfile'])){
			$coverFileError="Please select a image";
		}
		else{
			$folder="../resourses/books/";
			$file_name = time()."-".$_FILES['imgfile']['name'];
			$file_type = $_FILES['imgfile']['type'];
			$file_size = $_FILES['imgfile']['size'];
			$tmp_name = $_FILES['imgfile']['tmp_name'];
			$allowed = array('jpg' => 'image/jpg' , 'jpeg' => 'image/jpeg' , 'png' => 'image/png' , 'jfif' => 'image/jfif');

			if(!in_array($file_type, $allowed)){
				$coverFileError = "Allowed File Format: JPG/JPEG/PNG/JFIF";
			}
			$maxsize = 50*1024*1024;
			if($file_size > $maxsize){
				$coverFileError .= " Maximum File Size: 50MB";
			}
			if($_FILES['imgfile']['error']===0){
				$new_file_name = strtolower($file_name);
				$final_file = str_replace(' ', '-', $new_file_name);
				$imgfile = $folder.$final_file;
			}
			else{
				$coverFileError = "Something wrong with image.";
			}
		}
		if($bookNameError == "" && $authorNameError == "" && $priceError == "" && $categoryError == "" && $descError == "" && $coverFileError == ""){
			if(move_uploaded_file($tmp_name,$folder.$final_file)){
				$sql = "INSERT INTO bookdetails (bookname, author, price, category, isbn, description, image) VALUES ('$bookName','$author','$price','$category','$isbn','$desc','$imgfile') ";
				if(mysqli_query($conn, $sql)){
					$status = '<div class="alert alert-success">Book Added Successfully </div>';
				}
				else{
					$status = '<div class="alert alert-warning">Failed to add. Bookname/ISBN already exists.</div>';
				}
			}
			else{
				$coverFileError = "Something went wrong. Try again";
			}
		}
	}

	function check($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}
?>

<div class="container mb-auto">
	<div class="row">
		<div class="col-lg-2">
			<div id="" class="alter alert success">
				<h5>Categories</h5>
			</div>
			<div class="container">
				<?php
				$sql = "SELECT categories FROM categories";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						?>
						<p><?= $row['categories'] ?></p>
						<?php
					}
				}
				?>
			</div>
		</div>
		<div class="col-lg-10 ">
			<div class="container px-5 my-5">
				<h3>Book Details</h3>
				<span><?= $status ?></span>
    			<form id="contactForm" method="post" enctype="multipart/form-data">
        		<div class="form-floating mb-3">
            		<input class="form-control" name="bookName" id="bookName" type="text" placeholder="Book Name" required>
            		<label for="bookName">Book Name</label>
            		<span class="text-danger"><?= $bookNameError ?></span>
        		</div>
        		<div class="form-floating mb-3">
		            <input class="form-control" name="authorName" id="authorName" type="text" placeholder="Author" required>
		            <label for="author">Author</label>
		            <span class="text-danger"><?= $authorNameError ?></span>
		        </div>
		        <div class="form-floating mb-3">
		            <input class="form-control" name="price" id="price" type="number" placeholder="Price" required>
		            <label for="price">Price</label>
		            <span class="text-danger"><?= $priceError ?></span>
		        </div>
		        <div class="form-floating mb-3">
		            <select class="form-select" name="category" id="category" aria-label="Category">
		            	<?php
		            	$sql = "SELECT categories FROM categories";
						$result = mysqli_query($conn, $sql);
		            		if(mysqli_num_rows($result)>0){
		            			?>
		            			<option value="" selected>--Select a Category--</option>
		            			<?php
			            		while($row = mysqli_fetch_assoc($result)){
									?>
									<option value="<?= $row['categories'] ?>"><?= $row['categories'] ?></option>
									<?php
								}
							}
							else{
								?>
								<option value="" selected>--Select a Category--</option>
								<?php
							}
		            	?>
		            </select>
		            <label for="category">Category</label>
		            <span class="text-danger"><?= $categoryError ?></span>
		        </div>
		        <div class="form-floating mb-3">
		            <input class="form-control" name="isbn" id="isbn" type="text" placeholder="ISBN">
		            <label for="isbn">ISBN</label>
		        </div>
		        <div class="form-floating mb-3">
		            <textarea class="form-control" name="desc" id="description" type="text"  style="height: 9rem;" required></textarea>
		            <label for="description">Description</label>
		            <span class="text-danger"><?= $descError ?></span>
		        </div>
		        <div class="input-group">
  					<label class="input-group-text"  for="inputGroupFile01">Image File</label>
  					<input type="file" class="form-control" name="imgfile" id="cover">
				</div>
				<div class="input-group mb-3">
  					<span class="text-danger"><?= $coverFileError ?></span>
				</div>
		        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
		            <button class="btn btn-secondary btn-lg" name="reset-book-submit" id="resetButton" type="reset">Reset</button>
		            <button class="btn btn-dark btn-lg" name="add-book-submit" id="submitButton" type="submit">Submit</button>
		        </div>
    			</form>
			</div>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>