<div class="row">
    <div class="col-lg-4 col-xl-3 col-md-12">
        @include('Tour::frontend.layouts.search.filter-search')
    </div>
    <div class="col-lg-8 col-xl-9 col-md-12">
        <div class="bravo-list-item">
            <div class="d-flex justify-content-between align-items-center mb-4 topbar-search">
                <h3 class="font-size-21 font-weight-bold mb-0 text-lh-1">
                    @if($rows->total() > 1)
                        {{ __(":count tours found",['count'=>$rows->total()]) }}
                    @else
                        {{ __(":count tour found",['count'=>$rows->total()]) }}
                    @endif
                </h3>
                <div class="control">
                    @include('Tour::frontend.layouts.search.orderby')
                </div>
            </div>
            <div class="list-item">
{{--                <div class="row">--}}
{{--                    @if($rows->total() > 0)--}}
{{--                        @foreach($rows as $row)--}}
{{--                            <div class="col-md-6 col-xl-4 mb-3 mb-md-4 pb-1">--}}
{{--                                @include('Tour::frontend.layouts.search.loop-grid')--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                        <div class="col-lg-12">--}}
{{--                            {{__("Tour not found")}}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
@if($rows->total() > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th > {{__('Tour Name')}}</th>
                <th width="80px"> Giá từ</th>
                <th width="200px"> Ngày khởi hành</th>
                <th width="80px"> Số chỗ</th>
                <th width="100px"></th>
            </tr>
        </thead>
                <tbody>
        @foreach($rows as $row)
            <tr>
                <td >
                    {{$row->title}}
                    <p style="margin-bottom: 0; font-size: 14px;"><strong>Đơn vị </strong> : {{(!is_null($row->company_id) ? $row->company->name : 'Chưa rõ')}}</p>
                </td>
                <td > {{format_money_main($row->price)}}</td>
                <td class="text-center">
                    <a href="javascript::void" data-toggle="modal" data-target="#modelId{{$row->id}}"><i class="flaticon-calendar text-primary font-weight-semi-bold"></i></a>
                </td>
                <td > {{$row->max_people}}</td>
                <td>
                    <div class="book-button">
                        <a class="book-list-tour" href="{{$row->getDetailUrl($include_param ?? true)}}">{{__('Book')}}</a>
                    </div>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modelId{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lịch khởi hành</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-kh">
                                <div class="item-shedule">
                                    @if(!empty($row->tourDate))
                                        @foreach($row->tourDate as $d)
                                            <span>{{showVNdate($d->start_date)}}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

                                    @else
                                        <div class="col-lg-12">
                                            {{__("Tour not found")}}
                                        </div>
                                    @endif

            </div>
            @if($rows->total() > 0)
                <div class="text-center text-md-left font-size-14 mb-3 text-lh-1">{{ __("Showing :from - :to of :total Tours",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</div>
            @endif
            {{$rows->appends(request()->query())->links()}}
        </div>
    </div>
</div>
