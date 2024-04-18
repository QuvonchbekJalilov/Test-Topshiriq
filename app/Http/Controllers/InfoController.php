<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class InfoController extends Controller
{
    public function getinfo()
    {
        $branchCounts = Branch::select('regions.name as region_name', 'brands.name as brand_name')
            ->join('brands', 'branches.brand_id', '=', 'brands.id')
            ->join('regions', 'branches.region_id', '=', 'regions.id')
            ->groupBy('regions.id', 'brands.id')
            ->selectRaw('COUNT(*) as branch_count')
            ->get();

        $info = [];
        foreach ($branchCounts as $branchCount) {
            $information = "Region: " . $branchCount->region_name . ", Brand: " . $branchCount->brand_name . ", Branch Count: " . $branchCount->branch_count;
            $info[] =$information;
        }

        return $this->response($info);
    }
}
