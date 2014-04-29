<?php include("layout/header.php"); ?>
<?php
        $db = $_GET['db'];
        $collections  = $mongoDB->getCollections($db);
        $stats = $mongoDB->getStats($db);
?>
<h1>Collections of <?php echo $db; ?></h1>
<hr>
    <h4>Database stats</h4>
    <table class="table table-striped">
    <tr>
        <th>Host</th>
        <th>Collections</th>
        <th>Objects</th>
        <th>Avg. Obj. size (KB)</th>
        <th>Data size (KB)</th>
        <th>Storage size (KB)</th>
        <th>Extents</th>
        <th>Indexes</th>
        <th>Index size (KB)</th>
        <th>File size (KB)</th>
    </tr>
    <?php 
        $i=0;
        foreach ($stats as $stat): ?>
        <tr>
            <td><?php echo array_keys($stats)[$i]; ?></td>
            <td><?php echo $stat['collections']; ?></td>
            <td><?php echo $stat['objects']; ?></td>
            <td><?php echo number_format($stat['avgObjSize']/1024, 2); ?></td>
            <td><?php echo number_format($stat['dataSize']/1024, 2); ?></td>
            <td><?php echo number_format($stat['storageSize']/1024, 2); ?></td>
            <td><?php echo $stat['numExtents']; ?></td>
            <td><?php echo $stat['indexes']; ?></td>
            <td><?php echo number_format($stat['indexSize']/1024, 2); ?></td>
            <td><?php echo number_format($stat['fileSize']/1024, 2); ?></td>
        </tr>
    <?php 
        $i++;
        endforeach; ?>
    </table>
<hr>
    <h4>Create an index</h4>
    <form action="functions.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="collectionName">Collection: </label>
            <select class="form-control" name="collectionName">
                <?php foreach($collections as $collection): ?>
                <option value="<?php echo $collection; ?>"><?php echo $collection; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
            <div class="form-group">
                <label for="indexName">Index: </label>
                <input type="text" class="form-control" name="indexName" placeholder="_id">
                <input type="hidden" name="dbName" value="<?php echo $db; ?>">
            </div>
        <button type="submit" class="btn btn-success" name="createIndex" value="ok">Create</button>
    </form>
<hr>
<h4>Manage sharding for collections</h4>
    <form action="functions.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="collectionName">Collection: </label>
            <select class="form-control" id="collectionName" name="collectionName">
                <?php foreach($collections as $collection): ?>
                    <option value="<?php echo $collection; ?>"><?php echo $collection; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
                <label for="indexName">Index: </label>
                <input type="text" class="form-control" name="indexName" placeholder="_id">
                <input type="hidden" name="dbName" value="<?php echo $db; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="shardCollection" value="ok">Enable/Disable</button>
    </form>
<hr>
<h4>Collection status</h4>
    <table class="table table-striped">
        <tr>
            <th>Collection</th>
            <th>Delete</th>
        </tr>
        <?php foreach($collections as $collection): ?>
        <tr>
            <td><?php echo $collection; ?></td>
            <td><a onclick="return confirm('Are you sure?')" href="functions.php?dropCollection=<?php echo $collection; ?>&db=<?php echo $db; ?>">x</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php include("layout/footer.php"); ?>