<div class="panel">
    <h2>Activities</h2>
    <div class="activities">
        <?php
        $activities = getCustomTypeData('activity');
        foreach($activities as $a) {
            ?><div class="activity-row"><?php
            ?><div class="activity-date"><?php echo date('F, Y',strtotime($a["event_date"])); ?></div><?php
            ?><div class="activity-name"><?php echo $a["event_name"]; ?></div><?php
            ?><div class="activity-award"><?php echo $a["award"]; ?></div><?php
            ?></div><?php
        }
        ?>
    </div>
</div>