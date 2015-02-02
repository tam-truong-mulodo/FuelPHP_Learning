￼￼
<?php

class MyValidationRules {

    /**
     * 改行コードやタブが含まれていないかの検証ルール 
     *
     * @param string $value
     * @return boolean
     */
    public static function _validation_no_tab_and_newline($value) {
        echo "tam_test: " . __METHOD__ . "(line: " . __LINE__ . ")" . "<br>\n";
        var_dump($value);
        echo "<br>\n";
        // 改行コードやタブが含まれていないか
        if (preg_match('/\A[^\r\n\t]*\z/u', $value) === 1) {
            echo "tam_test: " . __METHOD__ . "(line: " . __LINE__ . ")" . "<br>\n";
            // 含まれていない場合はtrueを返す
            return true;
        } else {
            echo "tam_test: " . __METHOD__ . "(line: " . __LINE__ . ")" . "<br>\n";
            return false;
        }
    }
}
