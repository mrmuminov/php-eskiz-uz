<?php

namespace mrmuminov\eskizuz\types;

/**
 * @author Bahriddin Mo'minov
 */
interface TypeInterface
{

    public function toArray(): bool|array;

    public function validateArguments(): bool;

}