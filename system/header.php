<?php
	header('Cache-control: private');
	include 'config.php';
	$server_offline = 0;
	require_once("database.php");
	$database = new Connection(SERVER_IP, SERVER_ID, SERVER_PW, array(PDO::ATTR_TIMEOUT => 5, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	if(isset($_POST['username'], $_POST['password'], $_POST['rpassword'], $_POST['email'], $_POST['delete']))
	{
		$username	= $_POST['username'];
		$password	= $_POST['password'];
		$rpassword	= $_POST['rpassword'];
		$email		= $_POST['email'];
		$delete		= $_POST['delete'];
		
		if($password!=$rpassword)
			$register_message = '<div class="alert alert-danger">Password not match</div>';
		elseif(Register::Uniq($username))
		{
			$hash_pw			= sha1(sha1($password,true));
			$password			= '*'.strtoupper($hash_pw);
			$safebox_password	= "000000";
			$status 			= "OK";
			$safebox_size		= 1;

			$register_account = $database->Account("INSERT INTO account (login, password, social_id, email, create_time, status) VALUES(:login, :password, :social_id, :email, NOW(), :status)");
			$register_account->bindparam(":login", $username);
			$register_account->bindparam(":password", $password);
			$register_account->bindparam(":social_id", $delete);
			$register_account->bindparam(":email", $email);
			$register_account->bindparam(":status", $status);
			if($register_account->execute())
			{
				$lastID = $database->Account("SELECT max(id) as max FROM account");
				$lastID-> execute();
				$last = $lastID->fetch(PDO::FETCH_ASSOC)['max'];
				
				$safebox = $database->Player("INSERT INTO safebox(account_id, size, password) VALUES(?,?,?)");
				$safebox->bindParam(1, $last, PDO::PARAM_INT);
				$safebox->bindParam(2, $safebox_size, PDO::PARAM_INT);
				$safebox->bindParam(3, $safebox_password, PDO::PARAM_STR);
				if($safebox->execute())
					$register_message = '<div class="alert alert-success">Succesfully registered!</div>';
			}
		}
		else
			$register_message = '<div class="alert alert-danger">This username already exists!</div>';
	}
?>