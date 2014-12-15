<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

    public function arrayFromDB($dbarr) {
        $arr = substr($dbarr, 1, strlen($dbarr) - 2);
        $elements = array();
        $i = $j = 0;
        $in_quotes = false;
        while ($i < strlen($arr)) {
            $char = substr($arr, $i, 1);
            if ($char == '"' && ($i == 0 || substr($arr, $i - 1, 1) != '\\')) {
                $in_quotes = !$in_quotes;
            } else if ($char == ',' && !$in_quotes) {
                $elements[] = substr($arr, $j, $i - $j);
                $j = $i + 1;
            }
            $i++;
        }
        $elements[] = substr($arr, $j);
        for ($i = 0; $i < sizeof($elements); $i++) {
            $v = $elements[$i];
            if (strpos($v, '"') === 0) {
                $v = substr($v, 1, strlen($v) - 2);
                $v = str_replace('\\"', '"', $v);
                $v = str_replace('\\\\', '\\', $v);
                $elements[$i] = $v;
            }
        }
        return $elements;
    }

}
