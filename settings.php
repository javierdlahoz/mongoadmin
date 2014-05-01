<?php include("layout/header.php"); ?>
<?php $connectionData = $mongoDB->getConnectionData(); ?>
<h3>Settings</h3>
<hr>
<form action="functions.php" method="post" role="form" class="form">
    <div class="form-group">
        <label for="host">Host:</label>
        <input class="form-control" name="host" value="<?php echo $connectionData['host']; ?>">
    </div>
    <div class="form-group">
        <label for="port">Port:</label>
        <input class="form-control" name="port" value="<?php echo $connectionData['port']; ?>">
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input class="form-control" name="username" value="<?php echo $connectionData['username']; ?>">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input class="form-control" type="password" name="password" value="<?php echo $connectionData['password']; ?>">
    </div>
    <button type="submit" class="btn btn-success" name="changeSettings" value="ok">Change</button>
</form>
<?php include("layout/footer.php"); ?>