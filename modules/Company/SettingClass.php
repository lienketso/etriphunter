<?php


namespace Modules\Company;
use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'company',
                'title' => __("Company Settings"),

        ]];
    }
}
