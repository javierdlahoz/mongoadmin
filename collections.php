<?php include("layout/header.php"); ?>
<?php $db = $_GET['db']; ?>
<h1>Collections of <?php echo $db; ?></h1>
<hr>
    <h4>Create an index</h4>
    <form action="collections.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="collectionName">Collection</label>
            <select class="form-control" id="collectionName">
                <option value="testing1">testing1</option>
                <option value="testing2">testing2</option>
            </select>
        </div>
            <div class="form-group">
                <label for="indexName">Index</label>
                <input type="text" class="form-control" id="indexName" placeholder="_id">
            </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
<hr>
<h4>Manage sharding for collections</h4>
    <form action="collections.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="collectionName">Collection</label>
            <select class="form-control" id="collectionName">
                <option value="testing1">testing1</option>
                <option value="testing2">testing2</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enable/Disable</button>
    </form>
<hr>
<h4>Collection status</h4>
    <table class="table table-striped">
        <tr>
            <th>Collection</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>testing1</td>
            <td>active</td>
        </tr>
        <tr>
            <td>testing2</td>
            <td>active</td>
        </tr>
    </table>
<?php include("layout/footer.php"); ?>