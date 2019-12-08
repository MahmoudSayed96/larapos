<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_clients')->only('create');
        $this->middleware('permission:read_clients')->only('index');
        $this->middleware('permission:update_clients')->only('edit');
        $this->middleware('permission:delete_clients')->only('destroy');
    }
    public function index(Request $request)
    {
        // Search operation
        $clients = Client::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.clients.index', compact('clients'));
    } //end of index

    public function create()
    {
        return view('dashboard.clients.create');
    } //end of create


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'phone' => 'required|min:1|array',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        Client::create($request_data);
        session()->flash('success', \Lang::get('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', \compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'phone' => 'required|min:1|array',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        $client->update($request_data);
        session()->flash('success', \Lang::get('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');
    } //end of update

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', \Lang::get('site.deleted_successfully'));

        return \redirect()->route('dashboard.products.index');
    } //end of destroy
}
