<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::where('is_close',0)->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('text', 'LIKE', "%{$request->search}%")
                    ->orWhere('full_name', 'LIKE', "%{$request->search}%");
            });
        })->latest()->paginate(10);
        if ($request->ajax()) {
            return view('admin.tickets.tickets-paginate', compact('tickets'));
        } else {
            return view('admin.tickets.index', compact('tickets'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $tickets = Ticket::when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('comment', 'LIKE', "%{$request->search}%")
                    ->orWhere('full_name', 'LIKE', "%{$request->search}%");
            });
        })->latest()->paginate(10);
        if ($request->ajax()) {
            return view('admin.tickets.tickets-paginate', compact('tickets'));
        } else {
            return view('admin.tickets.index', compact('tickets'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Ticket $ticket)
    {
        $request->validate([
            'message'=>['required','string'],
        ]);

        $ticket->messages()->create([
            'is_owner'=>0,
            'message'=>$request->message,
        ]);

        return view('admin.tickets.messages')->with([
            'ticket'=>$ticket,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show')->with([
            'ticket' => $ticket,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close(Ticket $ticket)
    {
        $ticket->is_close=1;
        $ticket->save();

        alert()->success('تیکت با موفقیت بسته شد!')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.tickets.index');
    }
}
