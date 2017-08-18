<? 
	include 'functions/config.php';
	include 'functions/Database.php';
	$db = new Database(HOST,USER,PASS,DB);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Комментарии</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Список комментариев</h1>
				
					<? $all_comments = $db->get_all_comments();
						//print_r($all_comments);
					?>
					<div class="comment_list">
						<?foreach ($all_comments as $key=>$values):?>
							<div class="comment_item comment_item_<?=$all_comments[$key]['id_comment'];?>">
								<p><span><b>Пользователь:</b><?=$all_comments[$key]['user'];?></span> <b>Дата:</b><?=$all_comments[$key]['comment_date'];?></p>
								<p><b>Комментарий:</b><br><?=$all_comments[$key]['comment'];?></p>
								<a href="" class="del_button" id="del-<?=$all_comments[$key]['id_comment'];?>">Удалить</a>
							</div>
						<?endforeach;?>
					</div>
				
			</div>	
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form role="form" action="/" method="post">
					<div class="form-group">
						<label for="name">Имя*</label>
						<input type="text" name="user" class="form-control" id="user" placeholder="Enter Name">
					</div>
					<div class="form-group">
						<label for="Comment">Комментарий*</label>
						<textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Enter comment"></textarea>
					</div>
					
					<input type="hidden" name="comment_date" value="<?=date("Y-m-d H:i:s");?>">
					
					<input type="hidden" name="action" value="add">
					<button type="submit" class="btn btn-default">Отправить</button>
				</form>
			</div>
		</div>
	</div>	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/ajax.js"></script>
  </body>
</html>