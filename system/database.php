<?php
	class online_connection
	{
		public $verificator;
		
		public function __Connect($ip, $db, $user, $pass)
		{
			$this->verificator = null;
			try
			{
				$this->verificator = new PDO("mysql:host=".$ip.";dbname=".$db, $user, $pass);
			}
			catch(PDOException $exception)
			{
				global $server_offline;
				$server_offline = 1;
			}
			return $this->verificator;
		}
	}
	if($server_offline!=1)
	{
		class Connection
		{
			private $account;
			private $player;
			private $verificator;

			
			public function __construct($ip, $user, $pass)
			{
				$online_connection = new online_connection();
				
				$account = $online_connection->__Connect($ip, "account", $user, $pass);
				$this->account = $account;
				
				$player = $online_connection->__Connect($ip, "player", $user, $pass);
				$this->player = $player;
				
				$common = $online_connection->__Connect($ip, "common", $user, $pass);
				$this->common = $common;
			}
			
			public function Account($sql)
			{
				$stmt = $this->account->prepare($sql);
				return $stmt;
			}
			
			public function Player($sql)
			{
				$stmt = $this->player->prepare($sql);
				return $stmt;
			}
			
			public function Common($sql)
			{
				$stmt = $this->common->prepare($sql);
				return $stmt;
			}
		}
	}
	
	class Call
	{
		public static function URL()
		{
			$get_url = URL;
			if (substr($get_url , -1)!='/')
				$get_url.='/';
			return $get_url;
		}
		
		public static function Style()
		{
			$style = Call::URL();
			$style.= 'assets/';
			return $style;
		}
	}
	
	class Statistics
	{
		
		public static function Table($table)
		{
			global $database;
			
			$stmt = $database->Player("SHOW TABLES LIKE ?");
			$stmt->bindParam(1, $table, PDO::PARAM_STR);
			$stmt->execute(); 
			$result = $stmt->fetchAll(PDO::FETCH_COLUMN);
			
			if(count($result))
				return true;
			else return false;
		}
		
		public static function Players_Online($time)
		{
			global $database;
			
			$stmt = $database->Player("SELECT count(*) FROM player WHERE DATE_SUB(NOW(), INTERVAL ? MINUTE) < last_play");
			$stmt->bindParam(1, $time, PDO::PARAM_INT);
			$stmt->execute(); 
			$count = $stmt->fetchColumn(); 

			return $count;
		}
		
		public static function Guilds()
		{
			global $database;
		
			$stmt = $database->Player("SELECT count(*) FROM guild"); 
			$stmt->execute(); 
			$count = $stmt->fetchColumn(); 

			return $count;
		}
		
		public static function Shops()
		{
			global $database;
		
			if(!Statistics::Table('offline_shop_npc'))
			{
				if(!Statistics::Table('offlineshop_shops'))
					return 0;
				else
				{
					$stmt = $database->Player("SELECT count(*) FROM offlineshop_shops"); 
					$stmt->execute(); 
					$count = $stmt->fetchColumn(); 

					return $count;
				}
			}
			else
			{
				$stmt = $database->Player("SELECT count(*) FROM offline_shop_npc"); 
				$stmt->execute(); 
				$count = $stmt->fetchColumn(); 

				return $count;
			}
		}
		
		public static function Characters()
		{
			global $database;
			
			$stmt = $database->Player("SELECT count(id) FROM player");
			$stmt->execute(); 
			$count = $stmt->fetchColumn(); 

			return $count;
		}
		
		public static function Accounts()
		{
			global $database;
			
			$stmt = $database->Account("SELECT count(id) FROM account");
			$stmt->execute(); 
			$count = $stmt->fetchColumn(); 

			return $count;
		}
	}
	
	class Register
	{
		public static function Uniq($username)
		{
			global $database;
			
			$stmt = $database->Account("SELECT count(*) FROM account WHERE login=?");
			$stmt->bindParam(1, $username, PDO::PARAM_STR);
			$stmt->execute(); 
			$count = $stmt->fetchColumn(); 

			if($count>0)
				return false;
			else
				return true;
		}
		
		public static function Status()
		{
			global $server_offline;
			
			if($server_offline==1)
				return 'disabled';
			else
				return 'required';
		}
		
		public static function Button()
		{
			global $server_offline;
			
			if($server_offline==1)
				return '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
			else
				return '<button type="submit" class="btn btn-soft-success">Register</button>';
		}
	}
	
	class TOP10
	{
		
		public static function Banned()
		{
			global $database;
			
			$status = 'BLOCK';
			
			$stmt = $database->Account("SELECT id FROM account WHERE status=?");
			$stmt->bindParam(1, $status, PDO::PARAM_STR);
			$stmt->execute();
			$banned = $stmt->fetchAll();
			
			$banned_array = array();
			foreach($banned as $id)
				$banned_array[] = $id['id'].' ';
			
			$ids = join(',',$banned_array);
			
			return $ids;
		}
		
		public static function Players()
		{
			global $database;
			
			$bid = TOP10::Banned();
			if($bid)
				$stmt = $database->Player("SELECT id, name, account_id, level FROM player WHERE name NOT LIKE '[%]%' AND account_id NOT IN (".$bid.") ORDER BY level DESC, exp DESC, playtime DESC, name ASC limit 10");
			else
				$stmt = $database->Player("SELECT id, name, account_id, level FROM player WHERE name NOT LIKE '[%]%' ORDER BY level DESC, exp DESC, playtime DESC, name ASC limit 10");
			$stmt->execute();
			$top = $stmt->fetchAll();
			
			return $top;
			
		}
		
		public static function Empire($id)
		{
			global $database;
			
			$stmt = $database->Player("SELECT empire FROM player_index WHERE id = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			if(isset($result['empire']))
				return $result['empire'];
		}
		
		public static function Color($id)
		{
			switch ($id)
			{
				case 1:
					return 'danger';
					break;
				case 2:
					return 'warning';
					break;
				case 3:
					return 'info';
					break;
			}
		}
		
		public static function EmpireName($id)
		{
			switch ($id)
			{
				case 1:
					return 'Shinsoo Empire';
					break;
				case 2:
					return 'Chunjo Empire';
					break;
				case 3:
					return 'Jinno Empire';
					break;
			}
		}
		
	}