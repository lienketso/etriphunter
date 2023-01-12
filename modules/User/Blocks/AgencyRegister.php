<?php


namespace Modules\User\Blocks;


use Modules\Template\Blocks\BaseBlock;

class AgencyRegister extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ],

            ],
            'category'=>__("Other Block")
        ]);
    }
    public function getName()
    {
        return __('Agency Register Form');
    }
    public function content($model = [])
    {
        return view('User::frontend.agency.form-register', $model);
    }


}
