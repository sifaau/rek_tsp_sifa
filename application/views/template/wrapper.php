<?php echo $header;?>
<?php echo $menu_header;?>
<div class="row">
<?php if ($sidebar):?>
<div class="large-3 columns">
<?php echo $sidebar;?>
</div>
<div class="large-9 columns">
<?php echo $content;?>
</div>
<?php else:?>
<?php echo $content;?>
<?php endif;?>
</div>
<?php 
if (isset($bottom_content)){
 echo $bottom_content;
}
;?>
<?php echo $footer;?>