<?php 
function generate_avatar($dbh,$user,$size)
{
    //get the user's id
    $q = $dbh->prepare("SELECT id from cm_users WHERE username = ?");
    $q->bindParam(1,$user);
    $q->execute();
    $r = $q->fetch(PDO::FETCH_OBJ);

    if (isset($size))
    {
        $prefix = 'tn_';
    }
    else
    {
        $prefix = '';
    }
    return '../people/' . $prefix . $r->id . '.jpg'; 
}
