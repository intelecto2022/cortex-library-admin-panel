@extends('app')

@section('page_title')
    Nova kategorija
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            Nova kategorija
                        </h1>
                    </div>
                    <div>
                        <nav class="w-full rounded">
                            <ol class="flex list-reset">
                                <li>
                                    <a href="{{ route('settings.policies.index') }}"
                                       class="text-[#2196f3] hover:text-blue-600">
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <a href="{{ route('settings.categories.index') }}"
                                       class="text-[#2196f3] hover:text-blue-600">
                                        Kategorije
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <p class="text-gray-400 disabled">
                                        Nova kategorija
                                    </p>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Space for content -->
        <div class="scroll height-content section-content">
            <form method="POST" action="{{ route('settings.categories.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-row ml-[30px]">
                    <div class="w-[50%] mb-[100px]">
                        <div class="mt-[20px]">
                            <p>Naziv kategorije <span class="text-red-500">*</span></p>
                            <input id="categoryTitle" required minlength="4" maxlength="50" value="{{ old('title') }}"
                                   type="text" name="title"
                                   class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            />
                        </div>
                        @error("title")
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                        @enderror
                        <div id="categoryTitleValidationMessage"></div>

                        <div id="categoryIconValidationMessage"></div>

                        <div class="mt-[20px]">
                            <p class="inline-block">Opis</p>
                            <textarea required minlength="10" maxlength="512" id="categoryDescription"
                                      name="description" rows="10"
                                      class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">{{old('description')}}</textarea>
                        </div>
                        @error("description")
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                        @enderror
                        <div id="categoryDescriptionValidationMessage"></div>
                    </div>
                    <x-cropper></x-cropper>
                </div>
                <div class="absolute bottom-0 w-full">
                    <div class="flex flex-row">
                        <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                            <button type="reset"
                                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                            </button>
                            <button id="saveCategory" type="submit"
                                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
