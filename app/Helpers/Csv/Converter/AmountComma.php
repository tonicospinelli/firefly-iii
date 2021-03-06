<?php
declare(strict_types = 1);
namespace FireflyIII\Helpers\Csv\Converter;

/**
 * Class AmountComma
 *
 * Parses the input as the amount with a comma as decimal separator
 *
 * @package FireflyIII\Helpers\Csv\Converter
 */
class AmountComma extends BasicConverter implements ConverterInterface
{

    /**
     * @return float|int
     */
    public function convert(): string
    {
        $value = str_replace(',', '.', strval($this->value));

        if (is_numeric($value)) {
            return strval($value);
        }

        return '0';
    }
}
