<?php


namespace Modules\Privilege\Blocks;


use Modules\Privilege\Models\Privilege;
use Modules\Template\Blocks\BaseBlock;

class MemberPackage extends BaseBlock
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
            'category'=>__("Privilege")
        ]);
    }
    public function getName()
    {
        return __('Privilege: Member packages');
    }

    public function content($model = [])
    {
        $listPrivilege = Privilege::where('status','publish')->get();
        return view('Privilege::frontend.blocks.index',compact('listPrivilege'));
    }
    public function query($model){

    }

}
