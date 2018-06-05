@extends('layouts.app')

@section('content')
    <tabs>
        <tab name="Entry" :selected="true">
            <entry></entry>
        </tab>

        <tab name="Circulation">
            <dashboard></dashboard>
        </tab>

        <tab name="Reports">
            <reports></reports>
        </tab>
    </tabs>


@endsection
