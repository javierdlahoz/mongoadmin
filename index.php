<?php include("layout/header.php"); ?>

<h1>Welcome to MongoAdmin for sharding</h1>
<hr>
<h4>Add a shard</h4>
    <form action="index.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="shardIp">IP</label>
            <input type="text" class="form-control" id="shardIp" placeholder="127.0.0.1">
        </div>
        <div class="form-group">
            <label for="shardName">Name</label>
            <input type="text" class="form-control" id="shardName" placeholder="myShard">
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
<hr>
<h4>Added shards</h4>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>IP</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
        <tr>
            <td>1</td>
            <td>localhost</td>
            <td>active</td>
            <td>x</td>
        </tr>
        <tr>
            <td>2</td>
            <td>192.168.1.1</td>
            <td>active</td>
            <td>x</td>
        </tr>
    </table>
<?php //echo phpinfo(); ?>

<?php include("layout/footer.php"); ?>