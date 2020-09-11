<?php


namespace App\Services;


class SendMailService
{
    static function contentForBeneficiary($email)
    {
        return [
            'title' => 'Notify For Beneficiary',
            'body' => "No Content",
            'email' => $email,
        ];
    }

    static function contentForResiduaryGift($email)
    {
        return [
            'title' => 'Notify For Residuary Gift',
            'body' => "No Content",
            'email' => $email,
        ];
    }
}
