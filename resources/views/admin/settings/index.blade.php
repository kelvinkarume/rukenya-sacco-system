@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl overflow-hidden bg-gradient-to-r from-slate-900 via-violet-700 to-sky-500 p-8 text-white shadow-xl">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold tracking-tight">SACCO Settings</h1>
            <p class="mt-3 max-w-2xl text-slate-200 text-sm leading-6">Configure your SACCO information, loan rules and interest behavior from a modern fintech settings panel.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-3">
        <form action="{{ route('admin.settings.save') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <div class="flex items-center gap-3 mb-5">
                <div class="rounded-2xl bg-slate-900 p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.866 0-7 1.343-7 3v4h14v-4c0-1.657-3.134-3-7-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 18h14" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">SACCO Information</h2>
                    <p class="text-sm text-slate-500">Choose the active SACCO profile used across the dashboard.</p>
                </div>
            </div>
            <label class="block text-sm font-medium text-slate-700">SACCO Profile</label>
            <select name="sacco_information" class="mt-2 block w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                <option value="Modern Fintech SACCO" {{ $settings['sacco_information'] === 'Modern Fintech SACCO' ? 'selected' : '' }}>Modern Fintech SACCO</option>
                <option value="Community Savings SACCO" {{ $settings['sacco_information'] === 'Community Savings SACCO' ? 'selected' : '' }}>Community Savings SACCO</option>
                <option value="Digital Growth SACCO" {{ $settings['sacco_information'] === 'Digital Growth SACCO' ? 'selected' : '' }}>Digital Growth SACCO</option>
                <option value="Urban Credit SACCO" {{ $settings['sacco_information'] === 'Urban Credit SACCO' ? 'selected' : '' }}>Urban Credit SACCO</option>
            </select>
            <button type="submit" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-slate-700">Update SACCO Info</button>
        </form>

        <form action="{{ route('admin.settings.save') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <div class="flex items-center gap-3 mb-5">
                <div class="rounded-2xl bg-slate-900 p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.866 0-7 1.343-7 3v4h14v-4c0-1.657-3.134-3-7-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Interest Rate</h2>
                    <p class="text-sm text-slate-500">Select the default lending rate for new loans.</p>
                </div>
            </div>
            <label class="block text-sm font-medium text-slate-700">Rate Plan</label>
            <select name="interest_rate" class="mt-2 block w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                <option value="10%" {{ $settings['interest_rate'] === '10%' ? 'selected' : '' }}>10% - Starter</option>
                <option value="12%" {{ $settings['interest_rate'] === '12%' ? 'selected' : '' }}>12% - Standard</option>
                <option value="14%" {{ $settings['interest_rate'] === '14%' ? 'selected' : '' }}>14% - Growth</option>
                <option value="16%" {{ $settings['interest_rate'] === '16%' ? 'selected' : '' }}>16% - Premium</option>
                <option value="18%" {{ $settings['interest_rate'] === '18%' ? 'selected' : '' }}>18% - High Yield</option>
            </select>
            <button type="submit" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-slate-700">Update Interest Rate</button>
        </form>

        <form action="{{ route('admin.settings.save') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <div class="flex items-center gap-3 mb-5">
                <div class="rounded-2xl bg-slate-900 p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Loan Rules</h2>
                    <p class="text-sm text-slate-500">Pick the rule set that governs loan approval and repayment.</p>
                </div>
            </div>
            <label class="block text-sm font-medium text-slate-700">Rule Set</label>
            <select name="loan_rules" class="mt-2 block w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                <option value="Standard Loan Rules" {{ $settings['loan_rules'] === 'Standard Loan Rules' ? 'selected' : '' }}>Standard Loan Rules</option>
                <option value="Flexible Loan Rules" {{ $settings['loan_rules'] === 'Flexible Loan Rules' ? 'selected' : '' }}>Flexible Loan Rules</option>
                <option value="Strict Loan Rules" {{ $settings['loan_rules'] === 'Strict Loan Rules' ? 'selected' : '' }}>Strict Loan Rules</option>
                <option value="Innovative Loan Rules" {{ $settings['loan_rules'] === 'Innovative Loan Rules' ? 'selected' : '' }}>Innovative Loan Rules</option>
            </select>
            <button type="submit" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-slate-700">Update Loan Rules</button>
        </form>
    </div>
</div>
@endsection
