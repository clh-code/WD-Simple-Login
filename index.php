<?php
include('class.validate.php');
$auth = new Validate();
$questions_dropdown = $auth->questionsDropDown('reg_questions');

//Get $_POST (start)
$action = array_key_exists('action',$_POST)?$_POST['action']:'';
$username = array_key_exists('username',$_POST)?$_POST['username']:'';
$password = array_key_exists('password',$_POST)?$_POST['password']:'';
$reg_firstname = array_key_exists('reg_firstname',$_POST)?$_POST['reg_firstname']:'';
$reg_lastname = array_key_exists('reg_lastname',$_POST)?$_POST['reg_lastname']:'';
$reg_username = array_key_exists('reg_username',$_POST)?$_POST['reg_username']:'';
$reg_password = array_key_exists('reg_password',$_POST)?$_POST['reg_password']:'';
$reg_confirm_password = array_key_exists('reg_confirm_password',$_POST)?$_POST['reg_confirm_password']:'';
$reg_question = array_key_exists('reg_questions',$_POST)?$_POST['reg_questions']:'';
$reg_answer = array_key_exists('reg_answer',$_POST)?$_POST['reg_answer']:'';
//Get $_POST (end)

//Set action and output messages (start)
switch($action){
	case 'login':
		if($username&&$password) $auth->login($username,$password);
		$message = '';
	break;
	case 'logout':
		$auth->logout();
		$message = '';

	break;
	case 'register':
		$confirm_register = $auth->register($reg_username,$reg_password,$reg_firstname,$reg_lastname,$reg_question,$reg_answer);
		$message = $confirm_register ? "<span id='response' style='color:#009900;font-weight:bold;'>$reg_firstname, your registration is complete. Please login below.</span>" : '';
	break;
	case 'confirm_secret':
		$password = $auth->confirmsecret($reg_username,$reg_question,$reg_answer);
		$message = $password ? "<span id='response' style='color:#009900;font-weight:bold;'>Your password is '$password'. Please login below.</span>":'';
	break;
}
//Set action and output messages (end)
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lava Serpent</title>
<style type="text/css">
#login,#login_head,#register,#coming_soon,#register_login_getpass_links{
	width: 400px;
	margin: 0 auto;	
}
#submit{
	clear: both;
	width:100px;
	margin:0 auto;	
}
#user_pass_form{
	clear: both;
	width:400px;
	margin:0px auto 10px auto;
	border: 1px #999 solid;
	background: #cecece;
}
#login_head{
	clear: both;
	text-align:center;	
	
}
#register_login_getpass_links{
	clear: both;
	margin:10px auto 10px auto;
	text-align:center;
}
.clickme{
	cursor:pointer;
	text-decoration:underline;
}
#user,#pass{
	text-align:center;
}
</style>
</head>

<body>
<!--Login Page (start) -->
<div id='login'>
    <form action="/" method="post">
        <div id="login_head">
        	<h3>Lava Serpent Login</h3>
        	<?=$message?>
        </div>
        <div id="user_pass_form">
            <table width="100%" cellpadding="10" cellspacing="0">
                <tbody>
                    <tr>
                    	<td align="right">User Name:</td><td align="center">
                    	<input id="user" name="username" type="text" value="">
                    	</td>
                    </tr>
                    <tr>
                        <td align="right">Password:</td><td align="center">
                            <input id="pass" name="password" type="password" value="">
                            <input id="action" name="action" type="hidden" value="login">
                        </td>
                    </tr>
               </tbody>    
            </table>
        </div>
        <div id="submit"><input id="submit" type="submit" title="Log In" value="Log In"></div>
    </form>
	<div id="register_login_getpass_links"><a class="clickme login_register">Register</a> | <a id="do_get_password" class="clickme">Forgot Password?</a></div>
<!--Login Page (end) -->
<!--Register Page (start) -->
</div>
<div id='register'>
	<form action="/" method="post">
        <div id="login_head"><h3>Lava Serpent Registration</h3></div>
        <div id="user_pass_form">
            <table width="100%" cellpadding="10" cellspacing="0">
                <tbody>
                	<tr>
                    	<td align="right">First Name:</td><td align="center">
                    	<input id="reg_firstname" name="reg_firstname" type="text" value="">
                    	</td>
                    </tr>
                    <tr>
                        <td align="right">Last Name:</td><td align="center">
                            <input id="reg_lastname" name="reg_lastname" type="text" value="">
                        </td>
                    </tr>
                    <tr>
                    	<td align="right">User Name:</td><td align="center">
                    	<input id="reg_username" name="reg_username" type="text" value="">
                    	</td>
                    </tr>
                    <tr>
                        <td align="right">Password:</td><td align="center">
                            <input id="reg_password" name="reg_password" type="password" value="">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Comfirm Password:</td><td align="center">
                            <input id="reg_confirm_password" name="reg_confirm_password" type="password" value="">
                        </td>
                    </tr>
                    <tr>
                    	<td align="center" colspan="2">Secret Question (choose one):<br>
                    	<?=$questions_dropdown?>
                    	</td>
                    </tr>
                    <tr>
                        <td align="right">Secret Answer:</td><td align="center">
                            <input id="reg_answer" name="reg_answer" type="text" value="">
                        </td>
                    </tr>
               </tbody>    
            </table>
        </div>
        <div id="submit">
        	<input id="action" name="action" type="hidden" value="register">
        	<input id="submit" type="submit" title="Register" value="Register">
        </div>
    </form>
	<div id="register_login_getpass_links"><a class="clickme login_register">Return To Login</a> | <a id="do_get_password" class="clickme">Forgot Password?</a></div>
</div>
<!--Register Page (end) -->
<!--Coming Soon Page (start) -->
<div id='coming_soon'>
	<center>
    	<h3>Login was successful <?=ucfirst($_SESSION['First_Name'])?>. Coming Soon!</h3><br>
        <form action="/" method="post">
            
         <input id="action" name="action" type="hidden" value="logout">
       
        <div id="submit"><input id="submit" type="submit" title="Log Out" value="Log Out"></div>
		</form>
    </center>
</div>
<!--Coming Soon Page (end) -->
<!--Lost Password Page (start) -->
<div id='lost_password'>
	<form action="/" method="post">
        <div id="login_head"><h3>Lava Serpent Password Retrieval</h3></div>
        <div id="user_pass_form">
            <table width="100%" cellpadding="10" cellspacing="0">
                <tbody>
                	<tr>
                    	<td align="right">User Name:</td><td align="center">
                    	<input id="reg_username" name="reg_username" type="text" value="">
                    	</td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">Secret Question (choose one):<br>
                        <?=$questions_dropdown?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Secret Answer:</td><td align="center">
                            <input id="reg_answer" name="reg_answer" type="text" value="">
                        </td>
                    </tr>
               </tbody>    
            </table>
        </div>
        <div id="submit">
            <input id="action" name="action" type="hidden" value="confirm_secret">
            <input id="submit" type="submit" title="Confirm" value="Confirm">
        </div>
    </form>
    <div id="register_login_getpass_links"><a id="do_login" class="clickme">Return To Login</a></div>
</div>
<!--Lost Password Page (end) -->
<script type="text/javascript" language="javascript">

function showHide(id){
	var el = document.getElementById(id);
	if(el && (el.style.display != 'none')){
		el.style.display = 'none';
	}else if(el && (el.style.display == 'none')){
		el.style.display = 'block';
	}
}

function show(id){
	var el = document.getElementById(id);
	if(el){
		el.style.display = 'block';
	}
}

function hide(id){
	var el = document.getElementById(id);
	if(el){
		el.style.display = 'none';
	}
}

// Login/Register Toggle (start)
var els = document.getElementsByClassName('login_register');
for(var i=0;i<els.length;i++){
	els[i].onclick = function(){
		showHide('login');
		showHide('register');	
	}
}
// Login/Register Toggle (end)

// Events (start)
// Password
 document.getElementById('do_get_password').onclick = function(){
	 //alert('Get Password');
	 hide('login');
	 show('lost_password');
 };
 //Login
 document.getElementById('do_login').onclick = function(){
	 //alert('Get Password');
	 show('login');
	 hide('lost_password');
 };
// Events (end)
<?php
	if(!$_SESSION['Authorized']){ //Session is active and confirmed
		echo "hide('register');";
		echo "hide('coming_soon');";
		echo "hide('lost_password');";
	}else{
		echo "hide('register');";
		echo "hide('login');";
		echo "hide('lost_password');";
	}
?>
</script>
</body>
</html>