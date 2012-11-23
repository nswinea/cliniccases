<?php 
function generate_avatar($dbh,$user,$small)
{
    //get the user's id
    $q = $dbh->prepare("SELECT id from cm_users WHERE username = ?");
    $q->bindParam(1,$user);
    $q->execute();
    $r = $q->fetch(PDO::FETCH_OBJ);

    if ($small)
    {
        $prefix = 'tn_';
    }
    else
    {
        $prefix = '';
    }

    $avatar=  '../people/' . $prefix . $r->id . '.jpg'; 

    if (file_exists($avatar))
        {return $avatar;}
    else
        {return '../people/' . $prefix . 'no_picture.png';}
}
