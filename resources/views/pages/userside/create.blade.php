@extends('layouts.user')

@section('title')
    {{$book->title}} | Rezerviši
@endsection


@section('main')
    <main id="main" style="padding-top: 3%; !important;">

        <section id="books" class="values">
            <div class="container-xxl" data-aos="fade-up">
                <div class="container mb-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('rezervisi.knjigu', $book->id) }}" method="post">
                                @csrf
                                <div class="row g-0">
                                    <div id="border" class="col-md-6 border-end">
                                            <div class="mb-3">
                                                <div class="row pb-5">
                                                    <div class="col">
                                                        <label class="form-label">Datum rezervacije<span class="text-red">*</span></label>
                                                        <input type="date" name="action_start" id="datumRezervisanja"
                                                               value="{{ old('action_start', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                                               min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                                        @error('action_start')
                                                        <p class="invalid-feedback" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                                                            {{ $message }}</p>
                                                        @enderror
                                                        <div id="actionStartValidation"></div>
                                                    </div>
                                                </div>
                                                <div class="row pt-5">
                                                    <p class="text-gray text-sm">Rezervacijom knjige šaljete zahtjev bibliotekaru koji je u mogućnosti da odobri zahtjev. Tok rezervacije možete pratiti u sekciji za <a href="{{route('rezervacije.index')}}" class="text-primary">rezervacije</a>.</p>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row pb-5">
                                            <div class="col-auto ms-1">
                                                <img style="height: 110px;width: 80px;border: 1px solid rgb(0,0,0, 0.2)" src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif" alt="">
                                            </div>
                                            <div class="col-auto mt-1">
                                                <h2>{{$book->title}}</h2>
                                                <p>{!! Str::limit($book->description, 25)!!}</p>
                                            </div>
                                        </div>
                                       <div class="row m-1">
                                           <button type="submit" class="btn btn-primary">Rezerviši</button>
                                       </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </section>


    </main>
@endsection


@section('scripts')
    <script>
        if ($(window).width() < 768){
            $("#border").removeClass('border-end');
        } else {
            $("#border").addClass('border-end');
        }

        $(window).resize(function() {
            if ($(window).width() < 768){
                $("#border").removeClass('border-end');
            } else {
                $("#border").addClass('border-end');
            }
        })
    </script>
@endsection


