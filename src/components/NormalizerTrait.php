<?php

namespace mrmuminov\eskizuz\components;

/**
 * @author Bahriddin Mo'minov
 */
trait NormalizerTrait
{

    private function phoneNormalise(string $phoneNumber): int
    {
        return (int)preg_replace('/\D/', '', $phoneNumber);
    }

    private function userSmsIdNormalize(string $userSmsId): string
    {
        return (string)preg_replace('/[^\da-zA-Z]/', '', $userSmsId);
    }
}