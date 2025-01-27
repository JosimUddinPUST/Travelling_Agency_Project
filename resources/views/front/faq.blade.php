@extends('front.layout.master')
@section('main_content')
<div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>FAQ</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="faq pt_70 pb_40">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="accordion" id="accordionExample">
                    @foreach($faqs as $faq)
                    <div class="accordion-item mb_30">
                        <h2 class="accordion-header" id="heading_{!! $faq->id !!}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{!!$faq->id!!}" aria-expanded="false" aria-controls="collapse_{!!$faq->id!!}">
                                {{$faq->question}}
                            </button>
                        </h2>
                        <div id="collapse_{!!$faq->id!!}" class="accordion-collapse collapse" aria-labelledby="heading_{!!$faq->id!!}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection