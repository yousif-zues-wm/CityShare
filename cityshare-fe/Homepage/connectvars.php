<?php
    try
    {
        $dbc = new PDO('mysql:host=localhost;dbname=cityshare', 'root', '');

        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    date_default_timezone_set('America/Phoenix');

    if(@$_COOKIE['user'])
    {
        $currentUser = $_COOKIE['user'];

        $sql = "SELECT step FROM users WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$currentUser));
        $result = $stmt->fetch();
        $step = $result['step'];
    }
    else
    {
        $currentUser = 0;
        $step = 0;
    }
    if($currentUser == 0)
        $who = "Sign In";
    else
        $who = "Profile";
