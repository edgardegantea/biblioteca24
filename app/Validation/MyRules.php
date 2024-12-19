<?php

namespace App\Validation;

class MyRules
{
    public function after_or_equal(string $str, string $field, array $data, string &$error = null): bool
    {
        $date1 = strtotime($str);
        $date2 = strtotime($data[$field]);

        if ($date1 < $date2) {
            $error = "La fecha de devolución debe ser posterior o igual a la fecha de préstamo.";
            return false;
        }

        return true;
    }
}