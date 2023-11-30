<?php 

namespace Tickets\Utils;
class FunctionsUtils{

   public static function print_pre($variavel) {
        echo '<pre>';
        print_r($variavel);
        echo '</pre>';
    }
}
