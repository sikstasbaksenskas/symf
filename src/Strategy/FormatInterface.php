<?php

namespace App\Strategy;

interface FormatInterface
{
    public const SERVICE_TAG = 'strategy';
    public function canProcess($type);
    public function process($all_orders);
}
