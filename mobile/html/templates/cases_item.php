<?php 
require('includes/Cases_Item.php');

switch ($type) {
    case 'case_notes':echo"shit";?> 
    
    <div data-role="page" id="case_notes" data-title="Case Notes">

        <?php require_once('nav_head.php'); ?>

        <div data-role="content">
        <?php

            foreach($items as $i){
            echo "<p>" . $i->description . "</p>";
            };
        


        ?>
        </div>

        <?php require_once('nav_foot.php'); ?>

    </div>
    <?php break;

    case 'case_docs': ?>


        <?php break;

    default:
        // code...
        break;
        
}?>
