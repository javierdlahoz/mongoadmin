<?php include("layout/header.php"); ?>
<?php
if(!empty($_POST['addShard'])){
    $hostIP = $_POST['shardIP'];
    $shardName = $_POST['shardName'];
    $result = $mongoDB->addShard($hostIP, $shardName);
    if($result['ok']==0){
        header("Location: index.php?error=".$result['errmsg']);
    }
    else{
        header("Location: index.php?success=The shard was added succesfully");
    }
}

if(!empty($_GET['delete'])){
    $shardId = $_GET['delete'];
    $result = $mongoDB->deleteShard($shardId);
    $mongoDB->deleteShard($shardId);

    if($result['ok']==0){
        header("Location: index.php?error=".$result['errmsg']);
    }
    else{
       header("Location: index.php?success=The shard was removed succesfully");
    }
}

if(!empty($_POST['enableSharding'])){
    $dbName = $_POST['dbName'];
    $result = $mongoDB->enableSharding($dbName);
    if($result['ok']==1){
        header("Location: databases.php?success=Successfuly enabled sharding for ".$dbName);
    }
    else{
        header("Location: databases.php?error=".$result['errmsg']);
    }
}

if(!empty($_POST['createDatabase'])){
    $dbName = $_POST['dbName'];
    $result = $mongoDB->createDatabase($dbName);
    if($result){
        header("Location: databases.php?success=Successfuly created: ".$dbName);
    }
    else{
        header("Location: databases.php?error=Can't create the database");
    }
}

if(!empty($_GET['deleteDB'])){
    $dbName = $_GET['deleteDB'];
    $result = $mongoDB->dropDatabase($dbName);
    if($result){
        header("Location: databases.php?success=Successfuly dropped: ".$dbName);
    }
    else{
        header("Location: databases.php?error=Can't drop the database");
    }
}
?>
<?php include("layout/footer.php"); ?>