<?php include("layout/header.php"); ?>
<?php $databases = $mongoDB->getDatabases();?>
<h2>Databases</h2>
<hr>
<h4>Manage sharding for a database</h4>
    <div class="row">
        <div class="col-md-6">
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
        </div>
        <div class="col-md-6">
            <form action="sharding.php" method="post" role="form" class="form-inline">
                <div class="form-group">
                    <label for="dbName">Create a database:</label>
                    <input class="form-control" name="dbName"/>
                </div>
                <button type="submit" class="btn btn-success" name="createDatabase" value="ok">Create</button>
            </form>
        </div>
    </div>
<hr>
<h4>List of databases</h4>
    <table class="table table-striped">
        <tr>
            <th>Database</th>
            <th>Partitioned</th>
            <th>Primary</th>
            <th>Drop</th>
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
            <td><a onclick="return confirm('Are you sure?');" href="sharding.php?deleteDB=<?php echo $database['name']; ?>">x</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php include("layout/footer.php"); ?>