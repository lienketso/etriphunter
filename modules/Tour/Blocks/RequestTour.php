<?php


namespace Modules\Tour\Blocks;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Template\Blocks\BaseBlock;

class RequestTour extends BaseBlock
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
            'category'=>__("Service Tour")
        ]);
    }

    public function getName()
    {
        return __('Tour: Request a tour');
    }

    public function content($model = [])
    {
        $user = $this->query($model);
        $listVendor = User::where('is_vendor',1)->get();
        $data = [
            'listVendor'=>$listVendor,
            'user'       => $user,
            'title'      => $model['title'] ?? "",
            'desc'      => $model['desc'] ?? "",
        ];
        return view('Tour::frontend.blocks.request-tour.index', $data);
    }
    public function query($model){
        $user = Auth::user();
        return $user;
    }


}
