<?php

namespace App\Http\Helpers;

use App\Http\Models\Menus;

class MenusHelper {
    /*
     * This function generates the HTML of the main (sidebar) menú
     * 
     * @return {String} HTML code with the menu
     */

    public static function getMenu() {
        //Get the topLevel menus
        $topLevel = MenusHelper::fetchTopLevelMenus();
        //Iterate over all the menu entries and set the children
        for ($i = 0; $i < count($topLevel); $i++) {
            $topLevel[$i]->children = MenusHelper::fetchChildrenMenus($topLevel[$i]->menu->uuid);
        }
        $html = MenusHelper::generateHTML($topLevel);
        return $html;
    }

    /*
     * This function fetch's the top level menú entries of the db and
     * returns it as a object array
     * 
     * @return {Mixed[]} Top level menus
     */

    public static function fetchTopLevelMenus() {
        $topLevel = Menus::where('type', '=', 'top')->get();
        $topLevelMenus = [];
        foreach ($topLevel as $menuTop) {
            $tmpObj = new \stdClass();
            $tmpObj->menu = $menuTop;
            $tmpObj->children = [];
            $topLevelMenus[] = $tmpObj;
        }
        //Return the data
        return $topLevelMenus;
    }

    /*
     * This function get's the children entries for the top level parent
     * 
     * @param {String} $parent - The parent uuid
     * 
     * @return {Mixed[]} The Children menus 
     */

    public static function fetchChildrenMenus($parent) {
        return Menus::where('parent', '=', $parent)->get();
    }

    /*
     * Generates the HTML code to write into the DOM and show the menu
     * 
     * @param {Mixed[]} $topLevel - The TopLevel - with - children meny array
     * 
     * @return {String} The HTML to output
     */

    public static function generateHTML($topLevel) {
        $html = '';
        foreach ($topLevel as $top) {
            //Check if have children or not
            if (count($top->children) > 0) {
                //Has sub-items
                $html.='<li class="treeview">
                 <a href="#">
                   <i class="' . $top->menu->icon . '"></i>
                   <span>' . $top->menu->title . '</span>
                   <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">';
                foreach ($top->children as $child) {
                    $html.= '<li><a href="'.\URL::to($child->url).'"><i class="fa fa-circle-o"></i> '.$child->title.'</a></li>';
                }
                $html.='</ul>
               </li>';
            } else {
                //Doesn't have children, is a link
                $html.='<li>
                    <a href="' . \URL::to($top->menu->url) . '">
                      <i class="' . $top->menu->icon . '"></i> <span>' . $top->menu->title . '</span>
                    </a>
                  </li>';
            }
        }
        //return the generated HTML
        return $html;
    }

}
