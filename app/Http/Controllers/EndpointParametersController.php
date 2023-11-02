<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndpointParametersFormRequest;
use App\Models\EndpointParameter;
use Exception;

class EndpointParametersController extends Controller
{

    /**
     * Display a listing of the endpoint parameters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $endpointParameters = EndpointParameter::paginate(15);

        return view('endpoint_parameters.index', compact('endpointParameters'));
    }

    /**
     * Show the form for creating a new endpoint parameter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('endpoint_parameters.create');
    }

    /**
     * Store a new endpoint parameter in the storage.
     *
     * @param App\Http\Requests\EndpointParametersFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(EndpointParametersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            EndpointParameter::create($data);

            return redirect()->route('endpoint_parameters.endpoint_parameter.index')
                ->with('success_message', 'Endpoint Parameter was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified endpoint parameter.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $endpointParameter = EndpointParameter::findOrFail($id);

        return view('endpoint_parameters.show', compact('endpointParameter'));
    }

    /**
     * Show the form for editing the specified endpoint parameter.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $endpointParameter = EndpointParameter::findOrFail($id);
        

        return view('endpoint_parameters.edit', compact('endpointParameter'));
    }

    /**
     * Update the specified endpoint parameter in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\EndpointParametersFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, EndpointParametersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $endpointParameter = EndpointParameter::findOrFail($id);
            $endpointParameter->update($data);

            return redirect()->route('endpoint_parameters.endpoint_parameter.index')
                ->with('success_message', 'Endpoint Parameter was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified endpoint parameter from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $endpointParameter = EndpointParameter::findOrFail($id);
            $endpointParameter->delete();

            return redirect()->route('endpoint_parameters.endpoint_parameter.index')
                ->with('success_message', 'Endpoint Parameter was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
