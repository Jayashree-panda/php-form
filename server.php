<? php session_start();
$username="";
$email="";
$errors=arrat();

//connect to database
$db=mysqli_connect('localhost','root','registration')

//register user
if(isset($_POST['reg_user'])){//when the register button is clicked
	$username=mysqli_real_escape_string($db,$POST['username']);
	$email=mysqli_real_escape_string($db,$POST['email']);
	$password_1=mysqli_real_escape_string($db,$POST['password_1']);
	$password_2=mysqli_real_escape_string($db,$POST['password_2']);

}

//form validation
if(empty($username)){
	array_push($errors,"Username is required");
}
if(empty($email)){
	array_push($errors,"Email is required");
}

if(empty($password_1)){
	array_push($errors,"Password is required");
}

if(empty($password_2)){
	array_push($errors,"Password is required");
}
if($password_1!=$password_2){
	array_push($errors,"The two passwords do not match");
}

//to check whether there is a previously existing username or email

$user_check_query="SELECT * from users where username='$username'";
$results=mysqli_query(db,$user_check_query);
$user=mysqli_fetch_assoc($results);
if($user)
{
	if($user['username']===$username)
	{
		array_push($errors,"Username already exists");
	}
	if($user['email']===$email)
	{
		array_push($errors,"Email already exists");
	}
}

if(count($errors)==0)
{
	$password=md5(password_1);
	$query="INSERT INTO users (username,email,password_1) 
	VALUES ('$username','$email','$password')";
	mysqli_query($db,$query);
	$_SESSION['username']=$username;
	$_SESSION['success']="You are now logged in";
	header('location:index.php');
}


//login a user
if(isset($_POST['login_user']))
{
	$username=mysqli_real_escape_string($db,$_POST['username']);
	$password=mysqli_real_escape_string($db,$_POST['password']);
	if(empty($username))
	{
		array_push($errors,"Username is required")
	}
	if(empty($password))
	{
		array_push($errors,"Password is required")
	}
	
}
if(count($errors)==0)
{
	$password=md5($password)
	$query=SELECT * from users WHERE username='$username' AND password='$password';
	$results=mysqli_query($db,$query);
	if(mysqli_num_rows($results)==1)
	{
		$_SESSION['username']=$username;
		$_SESSION['success']="You are now logged in";
		header(index.php)

	}
	else{
		array_push($errors,"Incorrect username/password combination");
	}
 ?>
}




