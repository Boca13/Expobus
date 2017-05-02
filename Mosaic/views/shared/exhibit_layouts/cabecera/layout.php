<?php
$titulo = isset($options['title'])
    ? html_escape($options['title'])
    : '';
$subtitulo = isset($options['subtitle'])
? html_escape($options['subtitle'])
: '';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
?>
<div class="exhibit-items cabecera <?php echo $size; ?>">
    <?php foreach ($attachments as $attachment): ?>
    <div class="fondo parallax-window" data-parallax="scroll" data-image-src="<?php echo ($attachment->getFile()->getProperty("fullsize_uri"));?>">
        <h2><?php echo($titulo);?></h2>
        <h3><?php echo($subtitulo);?></h3>
        <div class="caption"><?php echo($attachment->caption);?></div>
    </div>
    <?php endforeach; ?>
</div>
<?php echo $text; ?>
