<?php
add_theme_support("menus");//para que a funcao manu seja reconhecida la no dashboard;
function menu_principal($nome)
{
    $menu=wpse_nav_menu_2_tree($nome);
    foreach($menu as $item)
    {
        echo "<a href='".$item->url."'>";
        echo $item->title;
        echo "</a>";
    }
}
function register_meuMenu()
{
    register_nav_menu("menu-principal",__("Menu Principal"));
}
add_action("init","register_meuMenu");
function buildTree( array &$elements, $parentId = 0 )
	{
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->wpse_children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
    }
    
function wpse_nav_menu_2_tree( $menu_id )
	{
	    $items = wp_get_nav_menu_items( $menu_id );
	    return  $items ? buildTree( $items, 0 ) : null;
    }
function getMenuByLocation($location)
{
	    $theme_locations = get_nav_menu_locations();
	    $menu_obj = wp_get_nav_menu_object( $theme_locations[$location] );
	    return $menu_obj->name;
}
?>
