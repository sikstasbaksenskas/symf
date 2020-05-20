<?php

namespace App\Strategy;

class Format
{
    private $formats;

    public function addStrategy(FormatInterface $format): void
    {
        $this->formats[] = $format;
    }

    public function handle(string $type, $all_orders)
    {
        /** @var FormatInterface $strategy */
        foreach ($this->formats as $format) {
            if ($format->canProcess($type)) {
                $response = $format->process($all_orders);
                return $response;
            }
        }
    }
}
