<?php
/**
 * Created by PhpStorm.
 * Project: lunar-api
 * User: Miguel Cerejo
 * Date: 03/05/2023
 * Time: 00:29
 *
 * File: ColourPicker.php
 */

namespace App\FieldTypes;

use Lunar\Base\FieldType;

class ColourPicker implements FieldType
{

    public function getValue()
    {
        // TODO: Implement getValue() method.
    }

    public function setValue($value)
    {
        if ($this->hex($value)) {
            $value = $this->convertToRgb($value);
        }

        $this->value = $value;
    }

    public function getLabel(): string
    {
        // TODO: Implement getLabel() method.
    }

    public function getConfig(): array
    {
        return [
            'options' => [
                'available_colours' => 'nullable',
            ],
        ];
    }

    public function getSettingsView(): string
    {
        // TODO: Implement getSettingsView() method.
    }

    public function getView(): string
    {
        // TODO: Implement getView() method.
    }
}
