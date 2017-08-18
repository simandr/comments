<?php

class Database {
	public $db;
	
	public function __construct($host,$user,$pass,$db) {
		
		$this->db = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pass);
		
		if(!$this->db) {
			exit('No connection with database');
		}
		
		
		return $this->db;
	}
	
	public function get_all_comments() {
		//формируем запрос к таблице
		$sql = "SELECT * FROM Comments";
		//выполняем запрос
		$res = $this->db->query($sql);
		//если неудачный возвращаем false
		if(!$res) {
			return FALSE;
		}
		//возвращаем результат запроса
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function get_one_comment($id) {
		
		
	}

	public function insert_db($data) {
		$arr = array('user'=>null,'comment'=>null,'comment_date'=>null);	
		
		foreach ($arr as $key => $value) {
			
			$arr[$key] = $data[$key];
		}
		$this->db->exec("INSERT INTO `Comments` (`user`,`comment`, `comment_date`) VALUES ('$arr[user]', '$arr[comment]','$arr[comment_date]')");

		return $this->db->lastInsertId();
	}
	
	public function delete_db($id) {
		$arr = array('id'=>null);	
		
		foreach ($arr as $key => $value) {
			
			$arr[$key] = $id[$key];
		}
		
		$count = $this->db->exec("DELETE FROM `Comments` where `id_comment` = '$arr[id]'");

		return $count;
	}
}
?>