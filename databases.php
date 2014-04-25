<?php include("layout/header.php"); ?>
<?php $databases = $mongoDB->getDatabases();?>
<h1>Databases</h1>
<hr>
<h4>Manage sharding for a database</h4>
    <form action="sharding.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="dbName">Database:</label>
            <select class="form-control" name="dbName">
                <?php foreach($databases as $database): ?>
                    <option value="<?php echo $database['name']; ?>"><?php echo $database['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="enableSharding" value="ok">Enable</button>
    </form>
<hr>
<h4>List of databases</h4>
    <table class="table table-striped">
        <tr>
            <th>Database</th>
            <th>Partitioned</th>
            <th>Primary</th>
        </tr>
        <?php foreach($databases as $database): ?>
        <tr>
            <td><a href="collections.php?db=<?php echo $database['name']; ?>"><?php echo $database['name']; ?></a></td>
            <td>
            <?php
                if($database['partitioned'])
                    echo "true";
                else
                    echo "false";
            ?>
            </td>
            <td>
                <?php echo $database['primary']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php include("layout/footer.php"); ?>