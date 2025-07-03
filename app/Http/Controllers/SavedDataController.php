<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SavedData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class SavedDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = $_GET;
        if ($search) {
            $order = isset($search['order']) ? $search['order'] : null;
            $brand_id = isset($search['brand_id']) ? $search['brand_id'] : null;
            $status = isset($search['status']) ? $search['status'] : null;
            $savedDatas = SavedData::query();

            // Apply brand filter if selected
            if (!empty($brand_id)) {
                $savedDatas->where('brand_id', $brand_id);
            }
            // Apply order filter if selected
            if (!empty($order)) {
                $savedDatas->where('order', $order);
            }
            if (!empty($status)) {
                $today = Carbon::today();
                if ($status == 'expired') {
                    $savedDatas->whereRaw("STR_TO_DATE(expire_date, '%Y-%m-%d') < ?", [$today]);
                } elseif ($status == 'expiring-soon') {
                    $next30Days = $today->copy()->addDays(30);
                    $savedDatas->whereRaw("STR_TO_DATE(expire_date, '%Y-%m-%d') >= ? AND STR_TO_DATE(expire_date, '%Y-%m-%d') <= ?", [$today, $next30Days]);
                } elseif ($status == 'active') {
                    $next30Days = $today->copy()->addDays(30);
                    $savedDatas->whereRaw("STR_TO_DATE(expire_date, '%Y-%m-%d') > ?", [$next30Days]);
                }
            }
            
            $savedDatas = $savedDatas->get();

        } else {
            $date = Carbon::now()->format('Y-m-d');
            $savedDatas = SavedData::orderBy('created_at', 'desc')->get();
        }

        $brands = Brand::where('status',1)->get();
        return view('admin.saveddata-management.list', compact('savedDatas','brands','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('status',1)->get();
        return view('admin.saveddata-management.add',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:saved_data|string|max:255',
            'brand_id' => 'required|string|max:255',
            'order_id' => 'sometimes',
            'buy_source' => 'required|string|max:255',
            'client_name' => 'sometimes',
            'client_email' => 'sometimes',
            'amount_paid' => 'sometimes',
            'purchase_date' => 'required',
            'expire_date' => 'required',
        ]);
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );
        $data =  SavedData::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'brand_id' => $request->brand_id,
            'order' => $request->order_id,
            'description' => $description,
            'buy_source' => $request->buy_source,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'amount_paid' => $request->amount_paid,
            'purchase_date' => $request->purchase_date,
            'expire_date' => $request->expire_date,
            
        ]);

        Session::flash('message', 'Data created successfully!');

        return redirect()->route('saveddata.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SavedData $savedData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptedId = decrypt($id);
        $savedData = SavedData::where('id', $decryptedId)->first();
        $brands = Brand::where('status',1)->get();
        // dd($quiz->questions);
        return view('admin.saveddata-management.edit', compact('savedData','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('saved_data')->ignore($id),
                'max:255',
            ],
            'brand_id' => 'required|string|max:255',
            'order_id' => 'sometimes',
            'buy_source' => 'required|string|max:255',
            'client_name' => 'sometimes',
            'client_email' => 'sometimes',
            'amount_paid' => 'sometimes',
            'purchase_date' => 'required',
            'expire_date' => 'required',
        ]);
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );
        $upquiz = SavedData::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'brand_id' => $request->brand_id,
            'order' => $request->order_id,
            'description' => $description,
            'buy_source' => $request->buy_source,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'amount_paid' => $request->amount_paid,
            'purchase_date' => $request->purchase_date,
            'expire_date' => $request->expire_date,
        ]);
        Session::flash('message', 'Data Updated successfully!');

        return redirect()->route('saveddata.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $decryptedId = decrypt($id);
        $savedData = SavedData::where('id', $decryptedId)->first();
        $savedData->delete();
        Session::flash('message', 'Data Deleted successfully!');
        return redirect()->back();
    }

    public function suspend($id)
    {
        $decryptedId = decrypt($id);
        $savedData = SavedData::where('id', $decryptedId)->first();
        $savedData->status = ($savedData->status == 1) ? 0 : 1;
        $savedData->save();
        $message = ($savedData->status == 1) ? 'Data Activated successfully!' : 'Data Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }
}
