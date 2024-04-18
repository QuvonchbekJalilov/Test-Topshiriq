<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        return $this->response($brands);
    }


    public function store(BrandStoreRequest $request)
    {
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->storeAs('brand_photos', uniqid() . '.' . $request->file('logo')->getClientOriginalExtension(), 'public');
        }

        $brand = Brand::create([
            'name' => $request->name,
            'logo' => $path
        ]);

        return $this->success('Brnad added successfully', $brand);
    }


    public function show(string $id)
    {
        $brand = Brand::find($id);
        return $this->response($brand);
    }


    public function update(BrandUpdateRequest $request, string $id)
    {
        $brand = Brand::find($id);
        $validatedData = $request->validated();
        if ($request->has('name')) {
            $brand->name = $validatedData['name'];
        }

        if ($request->hasFile('logo')) {
            Storage::delete($brand->logo);
            $logoPath = $request->file('logo')->storeAs('brand_images', uniqid() . '.' . $request->file('logo')->getClientOriginalExtension(), 'public');
            $brand->logo = $logoPath;
        }

        $brand->save();
        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand]);
    }



    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if (isset($brand->logo)) {
            Storage::delete($brand->logo);
        }
        $brand->delete();
        return $this->success('brand deleted successfully');
    }
}
