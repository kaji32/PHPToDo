<?php
    $dsn = 'mysql:host=localhost;dbname=PHPToDo;charset=utf8';
    $username = 'root';
    $pass = 'root';
        
    
    try{
        $dbh = new \PDO($dsn, $username, $pass,[
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        $sql = "select * from todoItem" ;
        $stmt = $dbh->query($sql);
        $results = $stmt->fetchAll();
        $dbh = null;
        $results;
    }
    catch(PDOException $e){
        echo 'FALSE!'.$e->getMessage();
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>ToDo List</h1>
    </header>
    <main>
        <div>
            <form action="add.php" method="POST">
                <input type="text" name="todoItem">
                <input type="submit" value="追加">
            </form>
        </div>
        
        <div>
            <div>
                <h2>ToDoリスト</h2>
                <table  border="1">
                    <thead>
                        <tr>
                            <td class="itemName">タスク名</td>
                            <td class="itemCreatedAt">作成日時</td>
                            <td class="itemComplete"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result): ?>
                            <?php if($result['completeFlg'] == 0): ?>
                                <form action="complete.php" method="POST">
                                    <tr>
                                        <td><?php echo $result['content']; ?></td>
                                        <td><?php echo $result['createdAt']; ?></td>
                                        <td><input type="submit" value="完了"></td>
                                        <input type="hidden" name="completeItem" value="<?php echo $result['id']; ?>">
                                    </tr>
                                </form> 
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div>
                <h2>完了済み</h2>
                <table  border="1">
                    <thead>
                        <tr>
                            <td class="itemName">タスク名</td>
                            <td class="itemCreatedAt">作成日時</td>
                            <td class="itemComplete">完了日時</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result): ?>
                            <?php if($result['completeFlg'] == 1): ?>
                                <tr>
                                    <td><?php echo $result['content']; ?></td>
                                    <td><?php echo $result['createdAt']; ?></td>
                                    <td><?php echo $result['completedAt']; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>