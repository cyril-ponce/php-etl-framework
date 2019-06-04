<?php

namespace Camillebaronnet\ETL\Extractors;

use Camillebaronnet\ETL\Exceptions\MissingParameter;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class Csv extends AbstractExtractor
{
    /**
     * @param array $context
     * @return iterable
     * @throws MissingParameter
     */
    public function __invoke(array $context = []): iterable
    {
        $this->requiredParameters(['filename'], $context);

        return (new CsvEncoder($context))->decode(
            file_get_contents($context['filename']),
            CsvEncoder::FORMAT
        );
    }
}
