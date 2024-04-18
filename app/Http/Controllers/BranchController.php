<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Branch;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branchs = Branch::all();
        return $this->response($branchs);
    }

    public function store(BranchStoreRequest $request)
    {
        $branch = Branch::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id
        ]);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->move(public_path('branch_images'), $imageName);
                $images[] = $imageName;
            }
            $branch->update(['images' => $images]);
        }

        return $this->success('Branch stored successfully', $branch);
    }

    
    public function show(string $id)
    {
        $branch = Branch::find($id);
        return $this->response($branch);
    }

    
    public function update(BrandUpdateRequest $request, Branch $branch)
    {
        $branch->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id,
        ]);

        if($request->hasFile('images')){
            Storage::delete($branch->images);
            $images = [];
            foreach($request->file('images') as $image){
                $imageName = time().".".$image->getClientOriginalExtension();
                $image->move(public_path(), $imageName);
                $images[] = $imageName;
            }
            $branch->update(['images' => $images]);

        }

        return $this->success('Branch successfully updated', $branch);
    }

    
    public function destroy(string $id)
    {
        $branch = Branch::find($id);
        if($branch->images){
            Storage::delete($branch->images);
        }
        $branch->delete();
        return $this->success('branch deleted successfully');
    }
}
