<?php
    $completeItem = $_POST['completeItem'];

    $dsn = 'mysql:host=localhost;dbname=PHPToDo;charset=utf8';
    $username = 'root';
    $pass = 'root';
    
    try{
        $dbh = new \PDO($dsn, $username, $pass,[
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        $dbh->beginTransaction();
        $sql = "UPDATE todoItem SET completeFlg=1, completedAt =(:completedAt) WHERE id=(:id)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $completeItem, PDO::PARAM_INT);
        date_default_timezone_set('Asia/Tokyo');
        $stmt->bindValue(':completedAt', date("Y/m/d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $res = $dbh->commit();
    }
    catch(PDOException $e){
        echo 'FALSE!'.$e->getMessage();
        echo '<a href="http://localhost:8888/PHPToDo/index.php">前画面へ戻る</a>';
        $dbh->rollback();
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($res): ?>
        <p>完了しました。</p>
        <a href="http://localhost:8888/PHPToDo/index.php">前画面へ戻る</a>
    <?php endif; ?>
</body>
</html>