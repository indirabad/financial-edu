<?php
$id = $info['id'];
$option_name = $info['option_name'];
?>
<input 
    type="text" 
    name="<?= $option_name ?>" 
    id="<?= $id ?>" 
    value="<?= esc_attr( get_option($option_name) ) ?>" 
/> 