<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndpointsFormRequest;
use App\Models\Endpoint;
use Exception;

class EndpointsController extends Controller
{

    /**
     * Display a listing of the endpoints.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $endpoints = Endpoint::paginate(15);

        return view('endpoints.index', compact('endpoints'));
    }

    /**
     * Show the form for creating a new endpoint.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('endpoints.create');
    }

    /**
     * Store a new endpoint in the storage.
     *
     * @param App\Http\Requests\EndpointsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(EndpointsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Endpoint::create($data);

            return redirect()->route('endpoints.endpoint.index')
                ->with('success_message', 'Endpoint was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified endpoint.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $endpoint = Endpoint::findOrFail($id);

        return view('endpoints.show', compact('endpoint'));
    }

    /**
     * Show the form for editing the specified endpoint.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $endpoint = Endpoint::findOrFail($id);
        

        return view('endpoints.edit', compact('endpoint'));
    }

    /**
     * Update the specified endpoint in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\EndpointsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, EndpointsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $endpoint = Endpoint::findOrFail($id);
            $endpoint->update($data);

            return redirect()->route('endpoints.endpoint.index')
                ->with('success_message', 'Endpoint was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified endpoint from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $endpoint = Endpoint::findOrFail($id);
            $endpoint->delete();

            return redirect()->route('endpoints.endpoint.index')
                ->with('success_message', 'Endpoint was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
