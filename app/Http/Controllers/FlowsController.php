<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlowsFormRequest;
use App\Models\Flow;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlowsController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the flows.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $auth = Auth::user();

        if ($auth->tipo_usuario == '1') {
            $flows = Flow::paginate(25);
        }else{
            $flows = Flow::where('userId','=',$auth->id)->paginate(25);
        }




        return view('flows.index', compact('flows', 'auth'));
    }

    /**
     * Show the form for creating a new flow.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('flows.create');
    }

    /**
     * Store a new flow in the storage.
     *
     * @param App\Http\Requests\FlowsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(FlowsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Flow::create($data);

            return redirect()->route('flows.flow.index')
                ->with('success_message', 'Flow was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified flow.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $flow = Flow::findOrFail($id);
        $auth = Auth::user();

        $messages = DB::table('flow_messages')->where('flowid','=', $id)->get();

        return view('flows.show', compact('flow', 'auth', 'messages'));
    }

    /**
     * Show the form for editing the specified flow.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $flow = Flow::findOrFail($id);
        

        return view('flows.edit', compact('flow'));
    }

    /**
     * Update the specified flow in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\FlowsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, FlowsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $flow = Flow::findOrFail($id);
            $flow->update($data);

            return redirect()->route('flows.flow.index')
                ->with('success_message', 'Flow was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified flow from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $flow = Flow::findOrFail($id);
            $flow->delete();

            return redirect()->route('flows.flow.index')
                ->with('success_message', 'Flow was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
