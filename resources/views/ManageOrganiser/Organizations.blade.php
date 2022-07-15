@extends('Shared.Layouts.Master')

@section('title')
@parent
@lang("Organization.organizations")
@stop


@section('page_title')
<i class="ico ico-building"></i> &nbsp;
@lang("Organization.organizations")
@stop

@section('top_nav')
@include('ManageOrganiser.Partials.TopNav')
@stop

@section('menu')
@include('ManageOrganiser.Partials.Sidebar')
@stop


@section('head')

@stop

@section('page_header')

<div class="col-md-9">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group btn-group-responsive">
            @if(Gate::allows('create-organization'))
                <a href="{{route('showCreateOrganiser')}}" class="btn btn-success" type="button">
                    <i class="ico ico-plus"></i>
                    @lang("Top.create_organiser")
                </a>
            @endif
        </div>
    </div>
</div>
<div class="col-md-3">

</div>
@stop


@section('content')

<!--Start Attendees table-->
<div class="row">
    <div class="col-md-12">
        @if($organizations->count())
        <div class="panel">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                {{ trans("Organization.logo") }}
                            </th>
                            <th>
                               {!!Html::sortable_link(trans("Organization.name"), $sort_by, 'name', $sort_order, ['q' => $q , 'page' => $organizations->currentPage()])!!}
                            </th>
                            <th>
                               {!!Html::sortable_link(trans("Organization.email"), $sort_by, 'email', $sort_order, ['q' => $q , 'page' => $organizations->currentPage()])!!}
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($organizations as $organization)
                        <tr class="organizer_{{$organization->id}}">
                            <td>
                                <img style="height: 80px" src="/{{$organization->logo_path}}" alt="{{$organization->name}}">
                            </td>
                            <td>{{{$organization->name}}}</td>
                            <td>
                                <a href="{{route('showOrganiserDashboard', ['organiser_id'=>$organization->id])}}"
                                    > {{$organization->email}}</a>
                            </td>
                            <td class="text-center">
                                @if(Gate::allows('create-organization'))
                                    <a
                                        href="{{route('postEditOrganiser', ['organiser_id'=>$organization->id])}}"
                                        class="btn btn-xs btn-primary"
                                    > @lang("basic.edit")</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else

        @if(!empty($q))
        @include('Shared.Partials.NoSearchResults')
        @else
        @include('ManageOrganiser.Partials.OrganizerBlankSlate')
        @endif

        @endif
    </div>
    <div class="col-md-12">
        {!!$organizations->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render()!!}
    </div>
</div>    <!--/End attendees table-->

@stop


