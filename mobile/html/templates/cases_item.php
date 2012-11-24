<?php 
require('includes/Cases_Item.php');

switch ($type) {
    case 'sections':?> 

        <div data-role="page" id="case_sections" data-title="Case Contents">
            <?php require_once('nav_head.php'); ?>

            <div data-role="content">
                <h2><?php if($items->first_name ==  '' &&  $items->last_name == '')
                    {echo $items->organization;}
                    else {echo $items->first_name . " " . $items->last_name;} ?>
                </h2>
                <p>
                <?php 
                if ($items->address1 !== '')
                    {echo $items->address1 . "<br />";}
                if ($items->address2 !== '')
                    {echo $items->address2 . "<br />";}
                if ($items->city !== '' || $items->state !== '' || $items->zip !== '')
                    {echo $items->city . "  " . $items->state . " " . $items->zip . "<br />"; }
                if (!empty($items->phone))
                {
                    $phone = unserialize($items->phone);
                    foreach($phone as $key=>$value)
                    {
                        echo "<a href='tel:" . $key . "' data-role='button'>" . $key . " (" . $value . ")</a><br />";      
                    }
                }
                if (!empty($items->email))
                {
                    $email = unserialize($items->email);
                    foreach($email as $key=>$value)
                    {
                        echo "<a href='mailto:" . $key . "' data-role='button'>" . $key . " (" . $value . ")</a><br />";      
                    }
                }
                ?>    
                </p>
                <ul data-role="listview">
                    <li><a href="index.php?i=cases_item&type=case_notes&id=<?php echo $id; ?>">Case Notes</a></li>
                    <li><a href="index.php?i=cases_item&type=case_data&id=<?php echo $id; ?>">Case Data</a></li>
                    <li><a href="index.php?i=cases_item&type=case_docs&id=<?php echo $id; ?>">Documents</a></li>
                    <li><a href="index.php?i=cases_item&type=case_contacts&id=<?php echo $id; ?>">Contacts</a></li>
                    <li><a href="index.php?i=cases_item&type=case_events&id=<?php echo $id; ?>">Events</a></li>
            </div>
            <?php require_once('nav_foot.php'); ?>
        </div>

    <?php break;

    case 'case_notes':?> 
    
        <div data-role="page" id="case_notes" data-title="Case Notes">

            <?php require_once('nav_head.php'); ?>

            <div data-role="content">
            <?php

                foreach($items as $i){ ?>
                <p><?php echo  $i->description; ?> </p>
                <?php }; ?>
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
