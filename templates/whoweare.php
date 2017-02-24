<div class="panel">
    <h2>Who We Are</h2>
    <p>
        We are a small, but select group of IT consultants, collectively with a diverse set of expertise.  Extremely passionate about hackathon and the open startup community, with a range
        of awards to our name.
    </p>
    <div class="bios">
        <?php
        $people = getCustomTypeData('person');
        $count  = 0;
        foreach ($people as $p) {
            $count++;
            $description = explode("\r\n", $p["description"]);
        ?>
        <div class="person">
            <a href="#" data-featherlight="#person_<?php echo $count; ?>">
                <img src="<?php echo getGuid((int) $p["avatar"]); ?>" />
            </a>
            <div id="person_<?php echo $count; ?>">
                <div class="left">
                    <img src="<?php echo getGuid((int) $p["avatar"]); ?>" />
                </div>
                <div class="right">
                    <h3><?php echo $p["fullname"] ?></h3>
                    <h4><?php echo $p["tag_line"] ?></h4>
                    <?php foreach ($description as $d) echo "<p>$d</p>"; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>