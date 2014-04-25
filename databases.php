<?php include("layout/header.php"); ?>

<h1>Databases</h1>
<hr>
<h4>Manage sharding for a database</h4>
    <form action="databases.php" method="post" role="form" class="form-inline">
        <div class="form-group">
            <label for="databaseName">Database</label>
            <select class="form-control" id="databaseName">
                <option value="testing">testing</option>
                <option value="otteny">otteny</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enable/Disable</button>
    </form>
<hr>
<h4>Databases status</h4>
    <table class="table table-striped">
        <tr>
            <th>Database</th>
            <th>Status</th>
        </tr>
        <tr>
            <td><a href="collections.php?db=testing">testing</a></td>
            <td>active</td>
        </tr>
        <tr>
            <td><a href="collections.php?db=otteny">otteny</a></td>
            <td>active</td>
        </tr>
    </table>
<?php include("layout/footer.php"); ?>