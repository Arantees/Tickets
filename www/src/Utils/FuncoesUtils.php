<?php 

namespace Tickets\Utils;
class FuncoesUtils{

   public static function print_pre($variavel) {
        echo '<pre>';
        print_r($variavel);
        echo '</pre>';
    }
}
