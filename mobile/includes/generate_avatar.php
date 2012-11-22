<?php 
function generate_avatar($dbh,$user)
{
    //get the user's id
    $q = $dbh->prepare("SELECT id from cm_users WHERE username = ?");
    $q->bindParam(1,$user);
    $q->execute();
    $r = $q->fetch(PDO::FETCH_OBJ);
    return '../people/tn_' . $r->id . '.jpg'; 
}
