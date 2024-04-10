<?php
$label ??= "";
$name ??= "";
$type ??="text";
$value ??="";
$multiple ??= false;
$notrequired ??= false;

?>

<div class="form-group">
    <label for="<?= $name?>"> <?= $label ?> </label>
    <?php if($type === "textarea"): ?>
    <textarea class="form-control"  id="<?=$name?>"  name="<?=$name?>" > <?=$value?></textarea>
    <?php else: ?>
        <input 
            <?= $multiple ?  "multiple" : "" ?> 
            autofocus 
            value="<?=$value?>" 
            class="form-control mb-2" 
            id="<?=$name?>" 
            type="<?=$type?>" 
            <?= $notrequired ?  "" : "required " ?>
            name="<?=$name?>" 
        >
    <?php  endif; ?>
</div>