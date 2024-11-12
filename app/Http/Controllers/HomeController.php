<?php

namespace App\Http\Controllers;
use App\Models\Career;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $data = Career::getList( 220000);
        // Lấy dữ liệu từ bảng `employees`
        $data = Staff::with('children') // Quan hệ `children` dùng để lấy các con cháu của node
            ->whereNull('parent_id') // Bắt đầu từ gốc (CEO)
            ->get();



        return view("home")->with(["data" => $data, 'maxNodes' => 500]);
    }
}
