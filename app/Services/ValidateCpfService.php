<?php

declare(strict_types=1);

namespace App\Services;

class ValidateCpfService
{
    public function validateCpf(string $str): bool
    {
        if ($str !== null) {
            if ($str !== null) {
                if (strlen($str) >= 11 && strlen($str) <= 14) {
                    // cleaning cpf
                    $str = str_replace('.', '', $str);
                    $str = str_replace('.', '', $str);
                    $str = str_replace('-', '', $str);
                    $str = str_replace(' ', '', $str);

                    // tudo igual
                    $chars = str_split($str);
                    $allEqual = true;
                    foreach ($chars as $char) {
                        if ($char !== $chars[0]) {
                            $allEqual = false;
                            break;
                        }
                    }

                    if (!$allEqual) {
                        try {
                            $d1 = 0;
                            $d2 = 0;
                            $dg1 = 0;
                            $dg2 = 0;
                            $rest = 0;
//                            $digito;
//                            $nDigResult;

                            for ($nCount = 1; $nCount < strlen($str) - 1; $nCount++) {
                                $digito = intval(substr($str, $nCount - 1, 1));
                                $d1 = $d1 + (11 - $nCount) * $digito;
                                $d2 = $d2 + (12 - $nCount) * $digito;
                            }

                            $rest = ($d1 % 11);

                            // se for menor que 2 é 0, senão é 11 menos o resto
                            $dg1 = ($rest < 2) ? 0 : 11 - $rest;
                            $d2 += 2 * $dg1;
                            $rest = ($d2 % 11);

                            if ($rest < 2)
                                $dg2 = 0;
                            else
                                $dg2 = 11 - $rest;

                            $nDigVerific = substr($str, strlen($str) - 2, 2);
                            $nDigResult = $dg1 . $dg2;

                            return $nDigVerific == $nDigResult;

                            // se der problema...
                        } catch (\Exception $e) {
                            error_log("Erro!" . $e->getMessage());
                            return false;
                        }
                    } else return false;

                } else return false;
            } else return false;
        } else return false;
    }
}
