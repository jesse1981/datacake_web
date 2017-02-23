<!-- jquery + ui -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Skrollr -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/skrollr.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var s = skrollr.init({
        forceHeight: false
    });
});
</script>

<!-- Featherlight -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/featherlight.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.person a').featherlight();
});
</script>

<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/custom.js"></script>