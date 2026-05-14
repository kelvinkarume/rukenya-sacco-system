<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // VIEW ALL MEMBERS
    public function index()
    {
        $members = User::where('role', 'member')
            ->latest()
            ->get();

        return view('admin.members.index', compact('members'));
    }

    // VIEW SINGLE MEMBER DETAILS
    public function show($id)
    {
        $member = User::findOrFail($id);

        $loans = $member->loans()->latest()->get();
        $savings = $member->savings()->latest()->get();
        $loanPayments = $member->loanPayments()->latest()->get();

        return view('admin.members.show', compact('member', 'loans', 'savings', 'loanPayments'));
    }

    // TOGGLE MEMBER STATUS (ACTIVE / INACTIVE)
    public function toggleStatus($id)
    {
        $member = User::findOrFail($id);

        if ($member->status === 'active') {
            $member->status = 'inactive';
        } else {
            $member->status = 'active';
        }

        $member->save();

        return redirect()->back()->with('success', 'Member status updated successfully.');
    }
}