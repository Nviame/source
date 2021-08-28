<?php
    class Crypt {
        public static function gHashPwd($pwd) {
            $PASSWORD_SALT_A = '^t?uFZqn%tH6XqY5';
            $PASSWORD_SALT_B = 'fyTZjt^*2w$9Jx?9';
            return strlen($pwd) > 0 ? sha1(md5($PASSWORD_SALT_A . $pwd . $PASSWORD_SALT_B)) : null;
        }
        public static function cHashPwd($pwd, $hash) {
            return Crypt::gHashPwd($pwd) == $hash;
        }
    }