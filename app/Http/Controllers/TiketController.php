<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tiket.tiket');
    }

    public function ticketTable()
	{
		$tickets = Tiket::latest()->get();

		if (request()->ajax()) {
			return datatables()->of($tickets)
				->addColumn('event', function ($tickets) {
					$data = $tickets->event->event_name;
					return $data;
				})
				->addColumn('nama', function ($tickets) {
					$data = $tickets->ticket_name;
					return $data;
				})
				->addColumn('harga', function ($tickets) {
					return $tickets->price;
				})
                ->addColumn('kuota', function ($tickets) {
					return $tickets->quota;
				})
				->addColumn('keterangan', function ($tickets) {
					return $tickets->description;
				})
				->rawColumns(['event', 'nama', 'harga', 'kuota', 'ketarangan'])
				->make(true);
		}

		return view(
			'event.event',
			[
				'tickets'    => $tickets
			]
		);
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = Event::all();

        return view('tiket.create', [
            'events' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'event' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'kuota' => 'required',
            'keterangan' => 'required',
        ]);

        $insert = new Tiket();
        $insert->event_id = $request->event;
        $insert->ticket_name = $request->nama;
        $insert->price = $request->harga;
        $insert->quota = $request->kuota;
        $insert->description = $request->keterangan;
        $save = $insert->save();

        if ($save) {
            return redirect('/tickets')->with('success', 'Berhasilahkan tiket');
        }
        return back()->with('error', 'Gagal menambahkan tiket');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
