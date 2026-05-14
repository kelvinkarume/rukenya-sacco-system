<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'sacco_information' => Setting::getValue('sacco_information', 'Modern Fintech SACCO'),
            'interest_rate' => Setting::getValue('interest_rate', '12%'),
            'loan_rules' => Setting::getValue('loan_rules', 'Standard Loan Rules'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['sacco_information', 'interest_rate', 'loan_rules']);

        $rules = [];
        if (isset($data['sacco_information'])) {
            $rules['sacco_information'] = 'required|string';
        }
        if (isset($data['interest_rate'])) {
            $rules['interest_rate'] = 'required|string';
        }
        if (isset($data['loan_rules'])) {
            $rules['loan_rules'] = 'required|string';
        }

        $validated = $request->validate($rules);

        foreach ($validated as $key => $value) {
            Setting::setValue($key, $value);
        }

        return back()->with('success', 'SACCO settings updated successfully.');
    }
}