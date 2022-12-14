<?php

namespace App\Http\Controllers;

use App\Models\Format;
use App\Http\Requests\StoreFormatRequest;
use App\Http\Requests\UpdateFormatRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $formats = Format::orderBy('id', 'DESC')->get();
        return view('..pages.settings.formats', compact('formats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addFormat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFormatRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFormatRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.\sŠšĐđŽžČčĆć])+$/|min:2|max:25'
        ]);

        try {
            // Generate new category model
            $model = new Format();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.formats.index')->with('successMessage', 'Novi format je uspješno dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Format $format
     * @return \Illuminate\Http\Response
     */
    public function show(Format $format)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Format $format
     * @return Application|Factory|View
     */
    public function edit(Format $format): View|Factory|Application
    {
        return view('..pages.settings.editFormat', compact('format'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormatRequest $request
     * @param Format $format
     * @return RedirectResponse
     */
    public function update(UpdateFormatRequest $request, Format $format): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.\sŠšĐđŽžČčĆć])+$/|min:2|max:25'
        ]);

        try {
            // Generate new category model
            $format->name = $input['name'];
            $format->update();

            return to_route('settings.formats.index')->with('successMessage', 'Informacije o formatu su uspješno izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Format $format
     * @return RedirectResponse
     */
    public function destroy(Format $format): RedirectResponse
    {
        //TODO: Add check if this genre is used in some of existing books before delete action (if exists, return error message)
        if ($format->books->isNotEmpty()) {
            return to_route('settings.formats.index')->with('errorMessage', 'U biblioteci se nalaze knjige u ovom formatu.');
        }

        try {
            $format->delete();

            return to_route('settings.formats.index')->with('successMessage', 'Format je uspješno obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {

        try {

            foreach ($request->id as $format){
                $format = Format::findOrFail($format);
                if ($format->books->isNotEmpty()) {
                    return to_route('settings.formats.index')->with('errorMessage', 'U biblioteci se nalaze knjige u ovom formatu.');
                }

                $format->delete();
            }

            return to_route('settings.formats.index')->with('successMessage', 'Svi slobodni formati su uspješno obirsani.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
