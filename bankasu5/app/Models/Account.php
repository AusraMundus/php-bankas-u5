<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    // IBAN
    static public function generateLithuanianIBAN() {
        $countryCode = 'LT';
        $bankAccountNumber = sprintf('%016d', mt_rand(0, 99999999999999));
    
        $iban = $countryCode . '00' . $bankAccountNumber;
    
        // Calculate the checksum digits
        $ibanDigits = str_split($iban);
        $checksum = 0;

        foreach ($ibanDigits as $digit) {
            $checksum = ($checksum * 10 + intval($digit)) % 97;
        }
        $checksumDigits = sprintf('%02d', 98 - $checksum);
    
        // Replace the placeholder checksum with the calculated checksum digits
        $iban = substr_replace($iban, $checksumDigits, 2, 2);
    
        return $iban;
    }

    // static public function newId(){
    //     $id = hexdec(uniqid());
    //     return $id;
    // }

}
