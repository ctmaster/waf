<?php

namespace Waf\Logger\Processor;

class HostNameProcessor
{

    public function __invoke(array $record)
    {
        $record['extra']['host'] = gethostname();
        return $record;
    }

}
