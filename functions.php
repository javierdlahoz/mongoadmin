<?php include("layout/header.php"); ?>
<?php
if(!empty($_POST['createIndex'])){
    $dbName = $_POST['dbName'];
    $collection = $_POST['collectionName'];
    $index = $_POST['indexName'];
  
    $result = $mongoDB->ensureIndex($dbName, $collection, $index);

    if((is_bool($result))&&($result)){		
        header("Location: collections.php?success=The index was ensured succesfully"."&db=".$dbName);
        
    }
    else{
        header("Location: collections.php?error=There was an error while ensuring index&db=".$dbName);
    }
}

if(!empty($_GET['dropCollection'])){
    $dbName = $_GET['db'];
    $collection = $_GET['dropCollection'];
    $result = $mongoDB->dropCollection($dbName, $collection);

    if($result){		
        header("Location: collections.php?success=The collection was succesfully dropped"."&db=".$dbName);
        
    }
    else{
        header("Location: collections.php?error=There was an error&db=".$dbName);
    }
}

if(!empty($_POST['shardCollection'])){
    $dbName = $_POST['dbName'];
    $collection = $_POST['collectionName'];
    $index = $_POST['indexName'];
    $result = $mongoDB->shardCollection($dbName, $collection, $index);

    if($result['ok']==1){		
        header("Location: collections.php?success=The collection was succesfully sharded"."&db=".$dbName);
    }
    else{
        header("Location: collections.php?error=".$result["errmsg"]."&db=".$dbName);
    }
}

if(!empty($_POST['createDocument'])){
    $dbName = $_POST['dbName'];
    $collection = $_POST['collectionName'];
    $document = $_POST['document'];
    $result = $mongoDB->createDocument($dbName, $collection, $document);

    if($result){       
        header("Location: 
        documents.php?success=The document was succesfully created"."&db=".$dbName."&collection=".$collection);
    }
    else{
        header("Location: 
        collections.php?error=There was an error while creating the document&db=".$dbName."&collection=".$collection);
    }
}
?>
<?php include("layout/footer.php"); ?>