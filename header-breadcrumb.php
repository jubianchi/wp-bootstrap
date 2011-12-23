<?php
/**
 * @var array $entries
 */
?>
<ul class="breadcrumb">
    <?php foreach($entries as $k => $entry) : ?>
        <li<?php if(is_null($entry['link']) || $k == count($entries) - 1) : ?> class="active"<?php endif; ?>>
            <?php if(!is_null($entry['link']) && $k < count($entries) - 1) : ?>
                <a href="<?php echo $entry['link']; ?>"><?php echo $entry['title']; ?></a>
            <?php else : ?>
                <?php echo $entry['title']; ?>
            <?php endif; ?>
            <?php if($k < count($entries) - 1) : ?><span class="divider">/</span><?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>