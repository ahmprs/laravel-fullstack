@extends('master')
@section('page_title', $page_title)
@section('content')
    <h1 class="alert alert-danger center">ACCESS DENIED</h1>
    <h3>
        Your access is restricted to the requesting source. We are sorry for any inconveniences.
    </h3>
    <h4 class="alert alert-primary">
        <em>Hint:</em> Sign in as a promoted user may fix this problem.
        <br>
        <br>
        <a href="/sign-in">sign-in</a>
    </h4>
@stop