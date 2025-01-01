@extends('admin.layout.master')

@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

    <div class="main-content">
        
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Slider</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_slider_index') }}" class="btn btn-primary"><i class="fas fa-plus">View All</i></a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <form action="{{ route('admin_slider_edit_submit',$slider->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Exsiting Photo</label>
                                        <div><img src="{{ asset('uploads/'.$slider->photo) }}" alt="No Photo Exist" class="w_200"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Change Photo</label>
                                        <div><input type="file" name="photo"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Heading</label>
                                        <input type="text" class="form-control" name="heading" value="{{ $slider->heading }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Text</label>
                                        <textarea name="text" class="form-control h_100" cols="30" rows="30">{{ $slider->text }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" class="form-control" name="button_text" value="{{ $slider->button_text }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Button Link</label>
                                        <input type="text" class="form-control" name="button_link" value="{{ $slider->button_link }}">
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

