@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow text-center">

    <h2 class="text-xl font-bold mb-4">Total Profit (Interest Earned)</h2>

    <p class="text-3xl font-bold text-green-600">
        KES {{ number_format($profit) }}
    </p>

</div>

@endsection