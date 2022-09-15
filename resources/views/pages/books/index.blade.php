@extends('app')

@section('page_title')
    Knjige
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px] border-b-[1px] border-[#e4dfdf] ">
                Knjige
            </h1>
        </div>
        <!-- Space for content -->
        <div class="scroll height-evidencija">
            <div class="flex items-center justify-between px-[30px] py-4 space-x-3 rounded-lg">
                <a href="{{ route('books.create') }}"
                    class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                    <i class="fas fa-plus mr-[15px]"></i> Nova knjiga
                </a>
            </div>
            <!-- Space for content -->
            <div class="px-[30px] pt-2 bg-white">
                <div class="w-full mt-2">
                    <!-- Table -->
                    <table class="w-full overflow-hidden shadow-lg rounded-xl" id="myTable">
                        <!-- Table head-->
                        <thead class="bg-[#EFF3F6]">
                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox checkAll">
                                    </label>
                                </th>
                                <th class="flex items-center px-4 py-4 leading-4 tracking-wider text-left">
                                    Naziv knjige
                                    <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                            onclick="sortTable()"></i>
                                    </a>
                                </th>

                                <!-- Autor + dropdown filter for autor -->
                                <th id="autoriMenu"
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                    Autor<i class="ml-2 fas fa-filter"></i>

                                    <div id="autoriDropdown"
                                        class="autoriMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchAutori', 'autoriDropdown')"
                                                    id="searchAutori"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll font-normal">
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 2
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 3
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 4
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 5
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 6
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>

                                <!-- Kategorija + dropdown filter for kategorija -->
                                <th id="kategorijeMenu"
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left">Kategorija<i
                                        class="ml-2 fas fa-filter"></i>
                                    <div id="kategorijeDropdown"
                                        class="kategorijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchKategorije', 'kategorijeDropdown')"
                                                    id="searchKategorije"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll font-normal">
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Romani
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Udzbenici
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Drame
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Naucna fantastika
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Romedije
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Trileri
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Na raspolaganju
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Rezervisano</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">U prekoracenju</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Ukupna kolicina
                                </th>
                                <th class="px-4 py-4"> </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($books as $book)
                                <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                    <td class="px-4 py-4 whitespace-no-wrap">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox checkOthers">
                                        </label>
                                    </td>
                                    <td class="flex flex-row items-center px-4 py-4">
                                        <img style="width: 35px; height: 35px;"
                                            class="object-cover w-8 mr-2 h-11 rounded-full"
                                            src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif"
                                            alt="" />
                                        <a href="{{ route('books.show', $book->id) }}">
                                            <span class="font-medium text-center">{{ $book->title }}</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                        @foreach ($book->authors as $author)
                                            {{ $author->full_name }} @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                        @foreach ($book->categories as $category)
                                            {{ $category->title }} @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">6</td>
                                    <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap"><a
                                            href="aktivneRezervacije.php">5</a></td>
                                    <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap"><a
                                            href="{{ route('books.issues.issues', ['books' => $book->id]) }}">{{ $issuedBooksCount[$book->id] ?? 0 }}</a>
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap"><a
                                            href="{{ route('books.issues.breached', ['books' => $book->id]) }}">{{ $booksWithBreachedDeadlines[$book->id] ?? 0 }}</a>
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                        {{ $book->total_copies - ($writtenOffBooks[$book->id] ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                                        <p
                                            class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsKnjige hover:text-[#606FC7]">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </p>
                                        <div
                                            class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-knjige">
                                            <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                                role="menu">
                                                <div class="py-1">
                                                    <a href="{{ route('books.show', $book->id) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Pogledaj</span>
                                                    </a>

                                                    <a href="{{ route('books.edit', $book->id) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fas fa-edit mr-[6px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Izmijeni</span>
                                                    </a>

                                                    <a href="otpisiKnjigu.php" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Otpiši</span>
                                                    </a>

                                                    <a href="{{ route('books.issues', $book->id) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Izdaj</span>
                                                    </a>

                                                    <a href="vratiKnjigu.php" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Vrati</span>
                                                    </a>

                                                    <a href="rezervisiKnjigu.php" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Rezerviši</span>
                                                    </a>

                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                        onSubmit="if(!confirm('Da li ste sigurni da želite da obrišete ovu knjigu?')){return false;}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fa fa-trash mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izbriši</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                    <label class="inline-flex items-center">

                                    </label>
                                </th>
                                <th class="flex items-center px-4 py-4 leading-4 tracking-wider text-left">
                                    Naziv knjige
                                    <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                            onclick="sortTable()"></i>
                                    </a>
                                </th>

                                <!-- Autor + dropdown filter for autor -->
                                <th id="autoriMenu"
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                    Autor<i class="ml-2 fas fa-filter"></i>

                                    <div id="autoriDropdown"
                                        class="autoriMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchAutori', 'autoriDropdown')"
                                                    id="searchAutori"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll font-normal">
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 2
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 3
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 4
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 5
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Autor Autorovic 6
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>

                                <!-- Kategorija + dropdown filter for kategorija -->
                                <th id="kategorijeMenu"
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left">Kategorija<i
                                        class="ml-2 fas fa-filter"></i>
                                    <div id="kategorijeDropdown"
                                        class="kategorijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchKategorije', 'kategorijeDropdown')"
                                                    id="searchKategorije"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll font-normal">
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Romani
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Udzbenici
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Drame
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Naucna fantastika
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Romedije
                                                    </p>
                                                </li>
                                                <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Trileri
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Na raspolaganju
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Rezervisano</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">U prekoracenju</th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Ukupna kolicina
                                </th>
                                <th class="px-4 py-4"> </th>
                            </tr>
                            </tf>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection
