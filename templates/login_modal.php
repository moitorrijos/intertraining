<div id="login-modal" class="login-modal">
	<div class="login-modal-content">
		<span class="login-modal-close">&times;</span>
		<h2>Please Log In</h2>
		<?php wp_login_form(array(
			'redirect' => get_permalink(),
			'form_id' => 'loginform-modal',
			'label_username' => 'Username',
			'label_password' => 'Password',
			'label_remember' => 'Remember Me',
			'label_log_in' => 'Log In',
			'remember' => true
		)); ?>
	</div>
</div>

<style>
.login-modal {
	display: block;
	position: fixed;
	z-index: 1000;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.5);
}
.login-modal-content {
	background-color: #fefefe;
	margin: 10% auto;
	padding: 20px;
	border: 1px solid #888;
	border-radius: 5px;
	width: 400px;
	max-width: 90%;
	position: relative;
}
.login-modal-close {
	color: #aaa;
	float: right;
	font-size: 28px;
	font-weight: bold;
	cursor: pointer;
	position: absolute;
	right: 15px;
	top: 10px;
}
.login-modal-close:hover {
	color: black;
}
#loginform-modal {
	text-align: left;
}
#loginform-modal p {
	margin: 15px 0;
}
#loginform-modal label {
	display: block;
	margin-bottom: 5px;
	font-weight: bold;
}
#loginform-modal input[type="text"],
#loginform-modal input[type="password"] {
	width: 100%;
	padding: 8px;
	border: 1px solid #ddd;
	border-radius: 3px;
	box-sizing: border-box;
}
#loginform-modal input[type="submit"] {
	background-color: #0073aa;
	color: white;
	padding: 10px 20px;
	border: none;
	border-radius: 3px;
	cursor: pointer;
}
#loginform-modal input[type="submit"]:hover {
	background-color: #005a87;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const modal = document.getElementById('login-modal');
	const closeBtn = document.querySelector('.login-modal-close');
	
	closeBtn.onclick = function() {
		window.location.href = '<?php echo home_url(); ?>';
	}
	
	window.onclick = function(event) {
		if (event.target == modal) {
			window.location.href = '<?php echo home_url(); ?>';
		}
	}
});
</script>
