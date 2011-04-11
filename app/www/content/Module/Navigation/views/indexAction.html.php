<?php
/**
 * Wrap everything in a function for now so we can display subpages recursively
 * Kind of a hack... There are *much* better ways to do this but I'm under deadline...
 * @todo Fix this garbage and replace with view helpers and proper decorators, etc.
 */
if(!function_exists('renderNavigation')) { // Can't even believe I am doing this...
function renderNavigation($pages) {
    global $kernel;
    if(!$pages || count($pages) == 0) {
        echo 'NO PAGES';
        return;
    }
?>
<ul>
<?php foreach($pages as $page): ?>
    <li>
    <a href="<?php echo $kernel->url(array('page' => ltrim($page->url, '/')), 'page'); ?>" title="<?php echo $page->title; ?>"><?php echo $page->title; ?></a>
    <?php
        $children = $page->children;
        if($children && count($children) > 0):
            echo renderNavigation($children);
        endif;
    ?>
    </li>
<?php endforeach; ?>
</ul>
<?php
}
}

// Render navigation
renderNavigation($pages);
?>