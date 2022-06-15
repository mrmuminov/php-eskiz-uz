<?php

namespace mrmuminov\eskizuz\components;

/**
 * Trait NormalizerTrait
 */
trait NormalizerTrait
{

    /**
     * @param $phoneNumber
     * @return int
     */
    private function phoneNormalise($phoneNumber)
    {
        return preg_replace('/\D/', '', $phoneNumber);
    }

    /**
     * @param $userSmsId
     * @return array|string|string[]|null
     */
    private function userSmsIdNormalize($userSmsId)
    {
        return preg_replace('/[^\da-zA-Z]/', '', $userSmsId);
    }
}