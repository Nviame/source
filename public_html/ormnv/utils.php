<?php
    class Utils {
        public static function randomHash()
        {
            $length = 16;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $hash = '';
            for ($i = 0; $i < $length; $i++) {
                $hash .= $characters[rand(0, $charactersLength - 1)];
            }
            return $hash;
        }

        public static function segsToReadable($segs) {
            $bit = array(
                'y' => $segs / 31556926 % 12,
                'w' => $segs / 604800 % 52,
                'd' => $segs / 86400 % 7,
                'h' => $segs / 3600 % 24,
                'm' => $segs / 60 % 60
            );

            $ret = array();
               
            foreach($bit as $k => $v) {
                if($v > 0) {
                    $ret[] = "$v $k";
                }
            }
               
            return join(' ', $ret);
        }

        public static function shortAddress($str) {
            $tokens = explode(",", $str);
            //$str = str_replace(", Argentina", "", $str);
            //$str = str_replace("Provincia de ", "", $str);
            //return $str;
            return $tokens[0];
        }

        public static function shipmentStatusDescription($status) {
            $list = array('Esperando pago', 'Pago realizado', 'Paquete retirado', 'En viaje', 'Paquete entregado', 'Pendiente por devolución', 'Devuelto');
            return $list[$status - 1];
        }

        public static function moneyFormat($str) {
            return "$ " . number_format(floatval($str), 2);
        }
    }