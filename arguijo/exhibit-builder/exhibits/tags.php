<?php
$title = __('Browse Exhibits by Tag');
echo head(array('title' => $title, 'bodyclass' => 'exhibits tags'));
?>
<style>body { background-image: url('<?php echo(get_theme_option('root')); ?>files/theme_uploads/<?php echo(get_theme_option('fondo')); ?>'); }</style>
<h1><?php echo $title; ?></h1>

<nav class="navigation exhibit-tags" id="secondary-nav">
    <?php echo nav(array(
            array(
                'label' => __('Browse All'),
                'uri' => url('exhibits/browse')
            ),
            array(
                'label' => __('Browse by Tag'),
                'uri' => url('exhibits/tags')
            )
        )
    ); ?>
</nav>

<?php echo tag_cloud($tags, 'exhibits/browse'); ?>

<?php echo foot(); ?>
