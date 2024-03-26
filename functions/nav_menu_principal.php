<?php
function menu_principal($menu_name){
    // echo $menu_name;
    // die;
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {

        $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

        // var_dump($menu_items);
            
        $queried_object = get_queried_object();
        // var_dump( $queried_object );
        if (isset($queried_object->post_title)) {
            $menuCorrente = $queried_object->post_title;
        } else {
            $menuCorrente = $queried_object->name;
        }
        // echo $menuCorrente;
        // exit;

        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        $cai = '';
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_list = '<nav class="header-nav">';
        $menu_list .= '<ul class="header-nav__menu">';
        $count = 0;
        $submenu = false;$cpi=get_the_id();
        // echo "<pre>";
        //     var_dump($menu_items);
        // echo "<pre>";
        // exit;
        foreach( $menu_items as $current ) {
            if($cpi == $current->object_id ){ if ( !$current->menu_item_parent ) { $cpi=$current->ID; }else{ $cpi=$current->menu_item_parent; } $cai=$current->ID; break;}
        }
        foreach( $menu_items as $menu_item ) {
            // var_dump($menu_item->url);
            // exit;
            // var_dump($menu_item);
            // exit;

            $link = $menu_item->url;
            $title = $menu_item->title;
            if (!empty($menu_item->target)) {
                $target = "target= '".$menu_item->target."'";
            } else {
                $target = "";
            }
            // echo $menu_item->object;
            // exit;
            $menu_item->ID==$cai ? $ac2=' current_menu' : $ac2='';
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID; $parent_id==$cpi ? $ac=' current_item' : $ac='';
                // var_dump($cpi);
                // exit;
                if(!empty($menu_items[$count + 1]) && $menu_items[ $count + 1 ]->menu_item_parent == $parent_id ){//Checking has child
                    $menu_list .= '<li class="main-header__principal-menu-link header-primary-menu__item--dropdown'.$ac.'">
                    <a href="'.$link.'" '.$target.' class="main-header__principal-menu-link '.$ac2.'" data-menu="'.$menu_item->object.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$title.'</a>';
                }else{
                    if ($menuCorrente == $title) {
                        // echo $menuCorrente;
                        $menu_list .= '<li class=" active '.$ac.'">' ."\n";$menu_list .= '<a '.$target.' href="'.$link. '" class="header-nav__menu-link header-nav__menu-link--active '.$ac2. " " .$menu_item->classes[0] .'" data-menu="'.$menu_item->attr_title.'">'.$title.'</a>' ."\n";
                    } elseif ($menu_item->object == $menuCorrente) {
                        $menu_list .= '<li class=" active '.$ac.'">' ."\n";$menu_list .= '<a href="'.$link.'" '.$target. ' class="header-nav__menu-link header-nav__menu-link--active '.$ac2. " " .$menu_item->classes[0] .'" data-menu="'.$menu_item->attr_title.'">'.$title.'</a>' ."\n";
                    } else {
                        $menu_list .= '<li class="'.$ac.'">' ."\n"; $menu_list .= '<a href="'.$link.'" '.$target. ' class="header-nav__menu-link '.$ac2. " " .$menu_item->classes[0] .'" data-menu="'.$menu_item->attr_title.'">'.$title.'</a>' ."\n";
                    }
                }

            }
            // Cria o dropdown
            if ( $parent_id == $menu_item->menu_item_parent ) {
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<div class="header-primary-menu__dropdown-content">';
                    $menu_list .= '<ul class="header-primary-menu__dropdown-list">' ."\n";
                }
                    $menu_list .= '<li class="header-primary-menu__dropdown-item">' ."\n";
                    $menu_list .= '<a href="'.$link.'" class="header-primary-menu__dropdown-link '.$ac2.'" >'.$title.'</a>' ."\n";
                    $menu_list .= '</li>' ."\n";
                if(empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu){
                    $menu_list .= '</ul>' ."\n";
                    $menu_list .= '</div>';
                    $submenu = false;
                }
            }

            if (empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) {
                $menu_list .= '</li>' ."\n";
                $submenu = false;
            }
            $count++;
        }
    } else {
        $menu_list = '<li>Menu "' . $menu_name . '" not defined.</li>';
    }
    $menu_list .= '</ul>';
    $menu_list .= '</nav>';

    // var_dump($menu_list);

    return $menu_list;
}

// function menu_responsivo($menu_name){
//     if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {

//         $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
//         $cai = '';
//         $menu_items = wp_get_nav_menu_items($menu->term_id);
//         $menu_list = '<div class="responsive-menu__principal-menu">';
//         $menu_list .= '<ul>';
//         $count = 0;
//         $submenu = false;$cpi=get_the_id();
//         foreach( $menu_items as $current ) {
//             if($cpi == $current->object_id ){if ( !$current->menu_item_parent ) {$cpi=$current->ID;}else{$cpi=$current->menu_item_parent;}$cai=$current->ID;break;}
//         }
//         foreach( $menu_items as $menu_item ) {
//             $link = $menu_item->url;
//             $title = $menu_item->title;
//             $menu_item->ID==$cai ? $ac2=' current_menu' : $ac2='';
//             if ( !$menu_item->menu_item_parent ) {
//                 $parent_id = $menu_item->ID;$parent_id==$cpi ? $ac=' current_item' : $ac='';
//                 if(!empty($menu_items[$count + 1]) && $menu_items[ $count + 1 ]->menu_item_parent == $parent_id ){//Checking has child
//                     $menu_list .= '<div class="responsive-primary-menu__item responsive-primary-menu__item--dropdown'.$ac.'">'."\n";
//                     $menu_list .= '<div class="responsive-primary-menu__item-header">'."\n";
//                     $menu_list .= '<a href="'.$link.'" class="responsive-primary-menu__item-link'.$ac2.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$title.'</a>';
//                     $menu_list .= '<div class="responsive-primary-menu__dropdown-button"></div>'."\n";
//                     $menu_list .= '</div>';
//                 }else{
//                     $menu_list .= '<li class="responsive-primary-menu__item '.$ac.'">' ."\n";
//                     $menu_list .= '<a href="'.$link.'" class="responsive-menu__principal-menu-link'.$ac2.'">'.$title.'</a>' ."\n";
//                 }

//             }
//             if ( $parent_id == $menu_item->menu_item_parent ) {
//                 if ( !$submenu ) {
//                     $submenu = true;
//                     $menu_list .= '<div class="responsive-primary-menu__dropdown-content">';
//                 }
//                   $menu_list .= '<div class="responsive-primary-menu__item">' ."\n";
//                     $menu_list .= '<a href="'.$link.'" class="responsive-primary-menu__item-link '.$ac2.'" >'.$title.'</a>' ."\n";
//                   $menu_list .= '</div>' ."\n";
//                 if(empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu){
//                     $menu_list .= '</div>';
//                     $submenu = false;
//                 }
//             }
//             if (empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) {
//                 $menu_list .= '</li>' ."\n";
//                 $submenu = false;
//             }
//             $count++;
//         }
//     } else {
//         $menu_list = '<li>Menu "' . $menu_name . '" not defined.</li>';
//     }
//     $menu_list .= '</ul>';
//     $menu_list .= '</div>';

//     return $menu_list;
//   }
