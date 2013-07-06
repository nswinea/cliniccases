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
                <ul data-role="listview">
                <?php
                    foreach($items as $i){ ?>
                    <li>
                        <img src="<?php echo generate_avatar($dbh,$i->username,false); ?>">
                        <h3>
                            <?php echo username_to_fullname($dbh,$i->username);?>
                        </h3>
                        <p class="ui-li-aside">
                            <strong><?php echo  extract_date($i->date); ?></strong>
                            &nbsp; &nbsp;
                            <?php $t = convert_case_time($i->time); echo $t[0] . " " . $t[1]; ?>
                        </p>
                        <p class="no-ellipses"><?php echo  nl2br(htmlentities($i->description)); ?> </p>
                    </li>
                    <?php }; ?>
                </ul>
            </div>

        </div>
    <?php break;

    case 'case_docs': ?>

        <div data-role="page" id="case_docs" data-title="Case Documents">

            <?php require_once('nav_head.php'); ?>

            <div data-role="content">
                <ul data-role="listview">
                <?php
                    require('includes/utilities.php');
                    foreach($items as $i){ ?>
                    <li>
                        <img src="<?php echo($i->local_file_name == ''? '../html/ico/folder.png' : get_document_icon($i->extension)); ?>">
                        <h3>
                            <?php echo urldecode($i->local_file_name == '' ? $i->folder : $i->name);?>
                        </h3>
                        <p class="ui-li-aside">
                            <strong><?php echo  extract_date($i->date_modified); ?></strong>
                        </p>
                    </li>
                    <?php }; ?>
                </ul>
            </div>
        </div>

    <?php break;

    case 'case_data': ?>

        <div data-role="page" id="case_docs" data-title="Case Documents">

            <?php require_once('nav_head.php'); ?>

            <div data-role="content">

                <ul data-role="listview">
                    <?php
                    foreach ($items as $i) { ?>
                        <li><label class="muted"><?php echo $i['display_name']; ?>:</label> <?php echo $i['value']; ?></li>
                    <?php } ?>

                </ul>
            </div>
        
        </div>
    <?php
    default:
        // code...
        break;
        
}?>
