@extends('front.layouts.master')

@section('content')
    <h1>Hello, World!</h1>

    <h2>Service Variables</h2>
    <pre>{{ dd( $global_setting, $global_other_page_items, $services, $pdfs) }}</pre>
@endsection
