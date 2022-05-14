<?php

namespace mrmuminov\eskizuz\types;

interface TypeInterface
{

    public function toArray();

    public function validateArguments();

}