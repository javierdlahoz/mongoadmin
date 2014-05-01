<?php include("layout/header.php"); ?>
<?php
        $db = $_GET['db'];
        $collection  = $_GET['collection'];
?>
<h1>Documents for <?php echo $db.".".$collection; ?></h1>
<hr>
    <a  class="btn btn-info rounded_btn"
        href="collections.php?db=<?php echo $db; ?>&collection=<?php echo $collection; ?>">
    Back to <?php echo $collection; ?>
    </a>
    <h4>Create a document (JSON)</h4>
    <form action="functions.php" method="post" role="form" class="form">
        <div class="form-group">
            <label for="document">Document: </label>
            <textarea name="document" rows="6" class="form-control"></textarea>
            <input name="dbName" value="<?php echo $db; ?>" type="hidden">
            <input name="collectionName" value="<?php echo $collection; ?>" type="hidden">
        </div>
        <button type="submit" class="btn btn-success" name="createDocument" value="ok">Create</button>
    </form>
<hr>
    <form action="documents.php?db=<?php echo $db; ?>&collection=<?php echo $collection; ?>" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="document">Find (JSON): </label>
            <input name="dbName" value="<?php echo $db; ?>" type="hidden">
            <input name="collectionName" value="<?php echo $collection; ?>" type="hidden">
            <input name="query" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="findDocument" value="ok">Find</button>
    </form>
<?php
    
if(!empty($_POST['findDocument'])){
    $dbName = $_POST['dbName'];
    $collection = $_POST['collectionName'];
    $query = $_POST['query'];
    $result = $mongoDB->findDocument($dbName, $collection, $query);
?>
<hr>
<h4>Results</h4>
<table class="table table-striped">
<?php 
    foreach ($result as $document) {
    ?>
    <tr>
        <td><?php echo json_encode($document); ?></td>
        <td width="3%">
        <a onclick="return confirm('Are you sure?')" 
            href="functions.php?deleteDocument=<?php 
            echo $document['_id']; ?>&db=<?php 
            echo $db; ?>&collection=<?php echo $collection; ?>">x</a></td>
    </tr>
    <?php } ?>
</table>   
<?php } ?>

<?php include("layout/footer.php"); ?>