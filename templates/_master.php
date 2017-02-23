<!DOCTYPE html>
<html hola_ext_inject="ready" class=" js no-touch csstransitions" lang="en"><!--<![endif]-->	
    <?php include 'head.php'; ?>
    <body hola-ext-player="1" class="front" id="page-id-<?php echo $page_id; ?>">
        <div class="page-wrapper">
            <?php include 'header.php'; ?>
            <?php
            // select the template by page
            switch ($page_id) {
                case 4:
                    include 'hero_whoweare.php';
                    include 'whoweare.php';
                    include 'hero_activities.php';
                    include 'activities.php';
                    include 'contact_form.php';
                    break;
                default:
                    echo $page->post_content;
                    break;
            }
            ?>
            <?php include 'footer.php'; ?>
        </div>
        <?php include 'jscripts.php'; ?>
    </body>
</html>