<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketsFormRequest;
use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $auth = Auth::user();
        $tickets = DB::table('tickets')->where('userid','=',$auth->id)->orderBy('id', 'desc')->get();

        return view('tickets.index', compact('tickets', 'auth'));
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        $auth = Auth::user();
        return view('tickets.create', compact('auth'));
    }

    /**
     * Store a new ticket in the storage.
     *
     * @param App\Http\Requests\TicketsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(TicketsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Ticket::create($data);

            return redirect()->route('tickets.ticket.index')
                ->with('success_message', 'Ticket was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified ticket.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $ticket = DB::table('tickets')->where('userid','=',$auth->id)->get();
        $auth = Auth::user();

        return view('tickets.show', compact('ticket', 'auth'));
    }

    /**
     * Show the form for editing the specified ticket.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $auth = Auth::user();
        $tickets = DB::table('tickets')->where('userid','=',$auth->id)->orderBy('id', 'desc')->get();

        $mensajes = DB::table('messages')->where(['ticketid' => $id])->orderBy('id', 'asc')->get();
        return view('tickets.edit', compact('tickets', 'id', 'mensajes', 'auth'));
    }

    /**
     * Update the specified ticket in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\TicketsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, TicketsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $ticket = Ticket::findOrFail($id);
            $ticket->update($data);

            return redirect()->route('tickets.ticket.index')
                ->with('success_message', 'Ticket was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified ticket from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return redirect()->route('tickets.ticket.index')
                ->with('success_message', 'Ticket was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
