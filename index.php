<?php include("layout/header.php"); ?>
<h1>Welcome to MongoAdmin for sharding</h1>
<hr>
<?php if(!empty($_GET['error'])){ ?>
    <div class="alert alert-block alert-danger"><?php echo $_GET['error']; ?></div>
<?php } ?>
<?php if(!empty($_GET['success'])){ ?>
    <div class="alert alert-block alert-success"><?php echo $_GET['success']; ?></div>
<?php } ?>
<?php $results = $mongoDB->getShards(); ?>
<h4>Add a shard</h4>
    <form action="sharding.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="shardIp">IP</label>
            <input type="text" class="form-control" id="shardIp" name="shardIP" placeholder="127.0.0.1">
        </div>
        <div class="form-group">
            <label for="shardName">Name</label>
            <input type="text" class="form-control" id="shardName" name="shardName" placeholder="myShard">
        </div>
        <button type="submit" class="btn btn-success" name="addShard" value="ok">Add</button>
    </form>
<hr>
<h4>Added shards</h4>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>IP</th>
            <th>Delete</th>
        </tr>
        <?php foreach($results as $shard) { ?>
        <tr>
            <td><?php echo $shard['_id']; ?></td>
            <td><?php echo $shard['host']; ?></td>
            <td><a href="sharding.php?delete=<?php echo $shard['_id']; ?>">x</a></td>
        </tr>
        <?php } ?>
    </table>
<?php include("layout/footer.php"); ?>