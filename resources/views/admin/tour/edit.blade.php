@extends('admin.layout.master')

@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

    <div class="main-content">
        
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Tour</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_tour_index') }}" class="btn btn-primary"><i class="fas fa-plus">View All</i></a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <form action="{{ route('admin_tour_edit_submit',$tour->id) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Select Package</label>
                                        <select class="form-select" name="package_id">
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" @if($tour->package_id == $package->id) selected @endif>{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tour Start Date</label>
                                        <input id="datepicker1" type="text" class="form-control" name="tour_start_date" value="{{ $tour->tour_start_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tour End Date</label>
                                        <input id="datepicker1" type="text" class="form-control" name="tour_end_date" value="{{ $tour->tour_end_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Booking End Date</label>
                                        <input id="datepicker1" type="text" class="form-control" name="booking_end_date" value="{{ $tour->booking_end_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total Seats</label>
                                        <input type="number" class="form-control" name="total_seats" value="{{ $tour->total_seats }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
