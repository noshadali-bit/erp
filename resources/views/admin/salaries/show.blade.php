@extends('admin.layouts.simple.master')
@section('title', 'Managers')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Salary Details</h1>
        <div class="space-x-2">
            <a href="{{ route('salaries.edit', $salary->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('salaries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">user Name</label>
                <p class="text-gray-900">{{ $salary->user->name }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Month</label>
                <p class="text-gray-900">{{ date('F Y', strtotime($salary->month)) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Base Salary</label>
                <p class="text-gray-900">{{ number_format($salary->base_salary, 2) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Allowances</label>
                <p class="text-gray-900">{{ number_format($salary->allowances, 2) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deductions</label>
                <p class="text-gray-900">{{ number_format($salary->deductions, 2) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Working Days</label>
                <p class="text-gray-900">{{ $salary->working_days }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Present Days</label>
                <p class="text-gray-900">{{ $salary->present_days }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Total Salary</label>
                <p class="text-gray-900 font-bold">{{ number_format($salary->total_salary, 2) }}</p>
            </div>

            @if($salary->remarks)
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Remarks</label>
                <p class="text-gray-900">{{ $salary->remarks }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection