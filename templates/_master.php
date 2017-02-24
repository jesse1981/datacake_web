<!DOCTYPE html>
<html lang="en">
    <?php include 'head.php'; ?>
    <body id="page-id-<?php echo $page_id; ?>">
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