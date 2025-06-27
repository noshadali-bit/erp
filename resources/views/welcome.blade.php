@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">Textile ERP System</h1>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Yarn Management</h5>
                                    <p class="card-text">Yarn purchase orders aur inventory ka management.</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('yarn.purchase.index') }}" class="btn btn-primary">Purchase Orders</a>
                                        <a href="{{ route('yarn.inventory.index') }}" class="btn btn-outline-primary">Inventory</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Dyeing Department</h5>
                                    <p class="card-text">Dyeing batches aur color management.</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('dyeing.index') }}" class="btn btn-primary">Manage Batches</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reports</h5>
                                    <p class="card-text">System reports aur analytics.</p>
                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-primary">View Reports</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>Quick Guide</h4>
                        <div class="list-group">
                            <div class="list-group-item">
                                <h5 class="mb-1">1. Yarn Purchase</h5>
                                <p class="mb-1">- Purchase orders create karein<br>- Suppliers manage karein<br>- Yarn receive karein</p>
                            </div>
                            <div class="list-group-item">
                                <h5 class="mb-1">2. Inventory Management</h5>
                                <p class="mb-1">- Stock levels check karein<br>- Yarn movements record karein<br>- Alerts check karein</p>
                            </div>
                            <div class="list-group-item">
                                <h5 class="mb-1">3. Dyeing Process</h5>
                                <p class="mb-1">- Dyeing batches create karein<br>- Process status update karein<br>- Completion track karein</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection