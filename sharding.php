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

?>
<?php include("layout/footer.php"); ?>