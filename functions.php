<?php

require("databaselogin.php");

function getUsersData($id)
{
    $array = array();
    $query = mysql_query("SELECT * FROM 'logins' WHERE 'officer'=".$officer);
    while($row = mysql_fetch_assoc($query))
    {
        $array['officer'] = $row['officer']
        $array['first_name'] = $row['first_name']
        $array['last_name'] = $row['last_name']
        $array['username'] = $row['username']
    }
    return $array;
}

function getName($username)
{
    $query = mysql_query("SELECT 'first_name' FROM 'logins' WHERE 'username'=".$username."'");
    while($row = mysql_fetch_assoc($query))
    {
        return $row['first_name'];
    }
}
?>
