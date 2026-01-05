@extends('manufacturer.layout')

@section('title', 'Profile - ShopInKarts')

@section('content')
<div style="padding: 20px;">
    <h2>👤 Profile Page</h2>
    <div style="margin-top: 20px;">
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Mobile:</strong> {{ auth()->user()->mobile }}</p>
        <p><strong>Role:</strong> Manufacturer</p>
    </div>
    <a href="{{ route('manufacturer.dashboard') }}">← Back to Dashboard</a>
</div>
@endsection