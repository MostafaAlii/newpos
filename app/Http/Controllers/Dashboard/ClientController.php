<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();
        return view('dashboard.pages.clients.index', compact('clients'));
    }
    public function create(){
        return view('dashboard.pages.clients.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        Client::create($request_data);
        return redirect()->route('client.index')->with(['success' => trans('client.your_client_creating_successfully')]);
    }
    public function edit($id){
        $client = Client::find($id);
        if (!$client)
            return redirect()->route('client.index')->with(['error'=>trans('general.not_found_record')]);
        return view('dashboard.pages.clients.edit', compact('client'));
    }
    public function update(Request $request, $id){
        $client = Client::find($id);
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        $client->update($request_data);
        return redirect()->route('client.index')->with(['success' => trans('client.your_client_updating_successfully')]);
    }
    public function destroy($id){
        try {
            //get specific product and its translations
            $client = Client::find($id);
            if(!$client){
                return redirect()->route('client.index')->with(['error'=>trans('general.not_found_record')]);
            }
            $client->delete();
            return redirect()->route('client.index')->with(['success' => trans('client.your_client_deleting_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->route('client.index')->with(['error' => trans('general.some_error_happining')]);
        }
    }
}
