<?php

namespace mrmuminov\eskizuz\components;

trait NormalizerTrait
{

    private function phoneNormalise($phoneNumber)
    {
        return (int)preg_replace('/[^\d]/', '', $phoneNumber);
    }

    private function userSmsIdNormalize($userSmsId)
    {
        return preg_replace('/[^\da-zA-Z]/', '', $userSmsId);
    }
}