<?php

namespace App\Strategy;

use Symfony\Component\HttpFoundation\Response;

class XmlFormat implements FormatInterface
{
    private $key = 'xml';

    public function canProcess($type)
    {
        return $type === $this->key;
    }

    public function process($all_orders)
    {
        //content for xml
        $xml_content = '';
        foreach ($all_orders as $order) {
            $xml_content .= '
            <order>
                <location>' . $order['location'] . '</location>
                <deliver>' . $order['deliver'] . '</deliver>
            </order>';
        }

        //xml response
        $xml = '
        <mynode>
            <orders>' . $xml_content . '</orders>
        </mynode>
        ';

        $response = new Response($xml);
        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        return $response;
    }
}
