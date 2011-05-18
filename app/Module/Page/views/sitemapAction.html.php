<?php
// Use generic TreeView to recursively display links
$tree = $view->generic('treeview')
    ->data($pages)
    ->item(function($page) use($view) {
        return "<li>" . $page->title . "</li>";
    })
    ->itemChildren(function($page) {
        return $page->children;
    });
echo $tree->content();
?>