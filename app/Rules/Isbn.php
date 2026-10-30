<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Isbn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^\d{9}[\dX]$/', $value)) {
            $somme = 0;
            for ($i = 0; $i < 10; $i++) {
                $chiffre = ($value[$i] === 'X') ? 10 : (int) $value[$i];
                $somme += $chiffre * (10 - $i);
            }
            if ($somme % 11 === 0) {
                return;
            }
        }

        if (preg_match('/^\d{13}$/', $value)) {
            $somme = 0;
            for ($i = 0; $i < 13; $i++) {
                $poids = ($i % 2 === 0) ? 1 : 3;
                $somme += (int) $value[$i] * $poids;
            }
            if ($somme % 10 === 0) {
                return;
            }
        }

        $fail('Le champ :attribute n\'est pas un ISBN-10 ou ISBN-13 valide.');
    }
}
