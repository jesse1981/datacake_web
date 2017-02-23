<?php global $current_user;
    get_currentuserinfo();
    $offline	= "$theme_dir/img/blank-avatar.png";
    $online     = "$theme_dir/img/blank-avatar-online.png";
?>
<div class="collapse navbar-collapse header" id="navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <?php
        $pages = getAllPages();

        foreach ($pages as $link) {
            if ($link->post_title!="Posts") {
                $children = getPageChildren($link->ID);
                $active = ($link->ID==$page_id) ? "active":"";

                $hasDropDown = (count($children)) ? true:false;
                $liClassDropDown = ($hasDropDown) ? "dropdown":"";

                $postTitle = ($hasDropDown) ? $link->post_title." &raquo;":$link->post_title;

                echo '<li class="pages '.$active.'">'.'<a href="?page_id='.$link->ID.'">'.$postTitle.'</a>';
                if ($hasDropDown) {
                    echo '<ul class="dropdown">';
                    foreach ($children as $child) {
                        echo '<li><a href="?page_id='.$child->ID.'">'.$child->post_title.'</a></li>';
                    }
                    echo "</ul>";
                }
                echo '</li>';
            }
        }
        ?>
    </ul>
</div>

<?php
$links  = getCustomTypeData("account_link");
$links  = sortCustom($links, "sort_order", "number", "asce");
$token  = (isset($_SESSION["data"]["token"])) ? trim($_SESSION["data"]["token"]):"";
?>
<!--
<div class="popr" data-id="1" style="position: absolute; top: 70px; right: 50px;">
        <img src="<?php echo ($token=="") ? $offline:$online ?>" style="width: 40px; border-radius: 20px; margin: -30px 70px 0px;">
        <div class="popr-box" data-box-id="1">
                <?php
                foreach ($links as $l) { ?>
                        <?php if ((((int)$l["is-online"]==1) && ($token!="")) || 
                                  (((int)$l["is-online"]==0) && ($token==""))) { ?>
                                    <a href="http://www.lifestyledirections.net.au/index.php/account-link/<?php echo $l["name"]; ?>">
                                        <div class="popr-item"><?php echo $l["title"]; ?></div>
                                    </a>
                  <?php } }
                ?>
        </div>
</div>
-->