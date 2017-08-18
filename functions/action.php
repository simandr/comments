<?
	include 'config.php';
	include 'Database.php';
	
	$db = new Database(HOST,USER,PASS,DB);
	//print_r($db);
	$post = (!empty($_POST)) ? true : false;
	
	//print_r($_POST);
	if($post){
		$arr=array();
		
		//
        
        if (isset($_POST['action'])) {
			//если добавить
			if ($_POST['action']=='add') {
				if (isset($_POST['user'])) {$arr['user'] = $_POST['user'];}
				if (isset($_POST['comment'])) {$arr['comment'] = $_POST['comment'];}
				if (isset($_POST['comment_date'])) {$arr['comment_date'] = $_POST['comment_date'];}
				$id = $db->insert_db($arr);
				if ($id > 0)
				{
					echo '<div class="comment_item comment_item_'.$id.'">';
					echo '<p><span><b>Пользователь:</b>'.$arr['user'].'</span> <b>Дата:</b>'.$arr['comment_date'].'</p>';
					echo '<p><b>Комментарий:</b><br>'.$arr['comment'].'</p>';
					echo '<a href="" class="del_button" id="del-'.$id.'">Удалить</a>';
					echo '</div>';
				}
			}
			//если удалить
			if ($_POST['action']=='delete') {
				//print_r($_POST);
				// очищаем значение переменной, PHP фильтр FILTER_SANITIZE_NUMBER_INT
				// Удаляет все символы, кроме цифр и знаков плюса и минуса
				$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT);
				$arr['id'] = $idToDelete;
				$id = $db->delete_db($arr);
				if ($id > 0)
				{
					echo $idToDelete;
				}	
			}
		}
		
		
	}
?>