<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlowMessagesFormRequest;
use App\Models\FlowMessages;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class FlowMessagesController extends Controller
{

    /**
     * Display a listing of the flow messages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $flowMessagesObjects = FlowMessages::paginate(25);

        return view('flow_messages.index', compact('flowMessagesObjects'));
    }

    /**
     * Show the form for creating a new flow messages.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('flow_messages.create');
    }

    /**
     * Store a new flow messages in the storage.
     *
     * @param App\Http\Requests\FlowMessagesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(FlowMessagesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            FlowMessages::create($data);

            return redirect()->route('flow_messages.flow_messages.index')
                ->with('success_message', 'Flow Messages was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified flow messages.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $flowMessages = FlowMessages::findOrFail($id);

        return view('flow_messages.show', compact('flowMessages'));
    }

    /**
     * Show the form for editing the specified flow messages.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $flowMessages = FlowMessages::findOrFail($request->value);
        $flow = $request->flow;
        return view('flow_messages.edit', compact('flowMessages', 'flow'));
    }

    /**
     * Update the specified flow messages in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\FlowMessagesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data['message'] = $request->message;

            $message = DB::table('flow_messages')
                ->where('id', '=', $request->id)
                ->get();

            FlowMessages::where('id', $request->id)
                ->update($data);
            
            return redirect()->route('flows.flow.show', $message[0]->flowid )
                ->with('success_message', 'Flow Messages was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified flow messages from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $flowMessages = FlowMessages::findOrFail($id);
            $flowMessages->delete();

            return redirect()->route('flow_messages.flow_messages.index')
                ->with('success_message', 'Flow Messages was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
