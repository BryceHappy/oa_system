<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /***
 Version: 1.11 ($Rev: 175 $)
 Website: http://sourceforge.net/projects/simplehtmldom/
***/
// get html dom form file
function file_get_html() {
    $dom = new simple_html_dom;
    $args = func_get_args();
    $dom->load(call_user_func_array('file_get_contents', $args), true);
    return $dom;
}

// get html dom form string
function str_get_html($str, $lowercase=true) {
    $dom = new simple_html_dom;
    $dom->load($str, $lowercase);
    return $dom;
}

// dump html dom tree
function dump_html_tree($node, $show_attr=true, $deep=0) {
    $lead = str_repeat('    ', $deep);
    echo $lead.$node->tag;
    if ($show_attr && count($node->attr)>0) {
        echo '(';
        foreach($node->attr as $k=>$v)
            echo "[$k]=>\"".$node->$k.'", ';
        echo ')';
    }
    echo "\n";

    foreach($node->nodes as $c)
        dump_html_tree($c, $show_attr, $deep+1);
}

// get dom form file (deprecated)
function file_get_dom() {
   $dom = new simple_html_dom;
   $args = func_get_args();
   $dom->load(call_user_func_array('file_get_contents', $args), true);
    return $dom;
}

// get dom form string (deprecated)
function str_get_dom($str, $lowercase=true) {
    $dom = new simple_html_dom;
    $dom->load($str, $lowercase);
    return $dom;
}

// simple html dom node

 class simple_html_dom_node {
     public $nodetype = HDOM_TYPE_TEXT;
     public $tag = 'text';

     function previousSibling() {return $this->prev_sibling();}
 }

// simple html dom parser

class Simple_html_dom
{
     public $root = null;
     public $nodes = array();
     public $callback = null;

                 $this->load_file($str);
             else
                 $this->load($str);
        }
        }
     }

     function __destruct() {
         $this->clear();
     }

    // get html dom form file
    function file_get_html()
    {
        $args = func_get_args();
        $this->load(call_user_func_array('file_get_contents', $args), true);
        return $this;
    }

    // get html dom form string
    function str_get_html($str, $lowercase=true)
    {
        $this->load($str, $lowercase);
        return $this;
    }

    // dump html dom tree
    function dump_html_tree($node, $show_attr=true, $deep=0)
    {
        $lead = str_repeat('    ', $deep);
        echo $lead.$node->tag;
        if ($show_attr && count($node->attr)>0) {
            echo '(';
            foreach($node->attr as $k=>$v)
                echo "[$k]=>\"".$node->$k.'", ';
            echo ')';
        }
        echo "\n";

        foreach($node->nodes as $c)
            $this->dump_html_tree($c, $show_attr, $deep+1);
    }

    // get dom form file (deprecated)
    function file_get_dom()
    {
        $args = func_get_args();
        $this->load(call_user_func_array('file_get_contents', $args), true);
        return $this;
    }

    // get dom form string (deprecated)
    function str_get_dom($str, $lowercase=true)
    {
        $this->load($str, $lowercase);
        return $this;
    }

     // load html from string
     function load($str, $lowercase=true) {
         // prepare

     function getElementByTagName($name) {return $this->find($name, 0);}
     function getElementsByTagName($name, $idx=-1) {return $this->find($name, $idx);}
     function loadFile() {$args = func_get_args();$this->load(call_user_func_array('file_get_contents', $args), true);}
}
?>
