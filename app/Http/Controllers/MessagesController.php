<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesFormRequest;
use App\Models\Messages;
use Exception;

class MessagesController extends Controller
{

    /**
     * Display a listing of the messages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $messagesObjects = Messages::paginate(25);

        return view('messages.index', compact('messagesObjects'));
    }

    /**
     * Show the form for creating a new messages.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('messages.create');
    }

    /**
     * Store a new messages in the storage.
     *
     * @param App\Http\Requests\MessagesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(MessagesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Messages::create($data);

            return redirect()->route('messages.messages.index')
                ->with('success_message', 'Messages was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified messages.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $messages = Messages::findOrFail($id);

        return view('messages.show', compact('messages'));
    }

    /**
     * Show the form for editing the specified messages.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $messages = Messages::findOrFail($id);
        

        return view('messages.edit', compact('messages'));
    }

    /**
     * Update the specified messages in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\MessagesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, MessagesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $messages = Messages::findOrFail($id);
            $messages->update($data);

            return redirect()->route('messages.messages.index')
                ->with('success_message', 'Messages was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified messages from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $messages = Messages::findOrFail($id);
            $messages->delete();

            return redirect()->route('messages.messages.index')
                ->with('success_message', 'Messages was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
