<?php require('includes/Cases.php');?>

<ul data-role="listview" data-filter="true">

<?php foreach ($cases as $c) {extract($c); 

   echo "<li>" . $c['last_name'] . ", " . $c['first_name'] ."</li>";
}?>

</ul>
