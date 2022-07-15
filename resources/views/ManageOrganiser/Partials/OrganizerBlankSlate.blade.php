@extends('Shared.Layouts.BlankSlate')

@section('blankslate-icon-class')
    ico-ticket
@stop

@section('blankslate-title')
    @lang("Event.no_events_yet")
@stop

@section('blankslate-text')
    @lang("Event.no_events_yet_text")
@stop

@section('blankslate-body')
    <a href="{{route('showCreateOrganiser')}}" class="btn btn-success" type="button">
        <i class="ico ico-plus"></i>
        @lang("Top.create_organiser")
    </a>
@stop


