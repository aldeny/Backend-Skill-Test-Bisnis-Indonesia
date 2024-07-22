<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        $categories = Category::all();

        return view('event.event', [
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }

    public function eventTable()
	{
		$events = Event::latest()->get();

		if (request()->ajax()) {
			return datatables()->of($events)
				->addColumn('nama', function ($events) {
					$data = $events->event_name;
					return $data;
				})
				->addColumn('lokasi', function ($events) {
					$data = $events->location;
					return $data;
				})
				->addColumn('provinsi', function ($events) {
					return $events->province->province_name;
				})
                ->addColumn('kategori', function ($events) {
					return $events->category->category_name;
				})
				->addColumn('mulai', function ($events) {
					return $events->start_date ? with(new Carbon($events->start_date))->isoFormat('D-MMMM-Y (HH:mm)') : '';
				})
				->addColumn('akhir', function ($events) {
					return $events->end_date ? with(new Carbon($events->end_date))->isoFormat('D-MMMM-Y (HH:mm)') : '';
				})
				->addColumn('aksi', function ($events) {
					$btn = "<button class='btn btn-sm btn-outline-success btn-check mr-2 data-bs-toggle='tooltip' data-bs-placement='bottom' type='button' title='Check' data-id='" . $events->id . "'><i class='fas fa-eye'></i></button>";

					$btn .= "<a href='/events/" . $events->created_at . "/edit' class='btn btn-sm btn-outline-info btn-sm btn-edit mr-2 data-bs-toggle='tooltip' data-bs-placement='bottom' type='button' title='Edit' data-id='" . $events->id . "'><i class='fas fa-edit'></i></but>";

					$btn .= "<a class='btn btn-sm btn-outline-danger btn-sm btn-hapus data-bs-toggle='tooltip' data-bs-placement='bottom' type='button' title='Hapus' data-id='" . $events->id . "'><i class='fas fa-trash'></i></a>";

					return $btn;
				})
				->rawColumns(['nama', 'lokasi', 'provinsi', 'kategori', 'mulai', 'akhir', 'aksi'])
				->make(true);
		}

		return view(
			'event.event',
			[
				'events'    => $events
			]
		);
	}

    public function create(){

        $provinces = Province::all();
        $categories = Category::all();

        return view('event.create', [
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kategori' => 'required_without:new_kategori',
            'new_kategori' => 'required_without:kategori',
            'deskripsi' => 'required',
            'informasi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        // dd($request->all());

        $insert = new Event();
        $insert->event_name = $request->event;
        $insert->location = $request->lokasi;
        $insert->province_id = $request->provinsi;
        
        if ($request->kategori == 0 && $request->new_kategori) {
            $categories = new Category();
            $categories->category_name = $request->new_kategori;
            $categories->save();

            $insert->category_id = $categories->id;
        } else {

            $insert->category_id = $request->kategori;
        }

        $insert->description = $request->deskripsi;
        $insert->information = $request->informasi;
        $insert->image = $request->file('gambar')->store('images');
        $insert->start_date = $request->mulai;
        $insert->end_date = $request->selesai;
        $save = $insert->save();

        if($save){
            return redirect('/events')->with('success', 'Data Event Berhasil');
        }else{
            return back()->with('error', 'Data Event Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return response()->json([
            'event' => $event,
            'category' => $event->category,
            'province' => $event->province
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        Event::get();
        $provinces = Province::all();
        $categories = Category::all();

        return view('event.edit', [
            'event' => $event,
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    
    {

        $request->validate([
            'event' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kategori' => 'required_without:new_kategori',
            'new_kategori' => 'required_without:kategori',
            'deskripsi' => 'required',
            'informasi' => 'required',
            // 'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $update = Event::findOrFail($id);
        $update->event_name = $request->event;
        $update->location = $request->lokasi;
        $update->province_id = $request->provinsi;
        
        if ($request->kategori == 0 && $request->new_kategori) {
            $categories = new Category();
            $categories->category_name = $request->new_kategori;
            $categories->save();
        } else {
            $update->category_id = $request->kategori;
        }

        $update->description = $request->deskripsi;
        $update->information = $request->informasi;
        if ($request->file('gambar')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $update->image = $request->file('gambar')->store('images');
        }
        $update->start_date = $request->mulai;
        $update->end_date = $request->selesai;
        $save = $update->save();

        if($save){
            return redirect('/events')->with('success', 'Data Event Berhasil');
        }else{
            return back()->with('error', 'Data Event Gagal Disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        if ($event->image) {
			Storage::delete($event->image);
		}
        $event->delete();
        return response()->json(['success' => 'Data Event Berhasil']);
    }
}
