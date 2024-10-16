<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\CareerRequest;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Career::getList();
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo"<pre>";
        // var_dump($request->all());
        Career::create($request->all());
        return response()->json([
            'message' => 'Success',
        ]);
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

    public function getByDepartment($department_slug)
    {
        $data = Career::whereHas(
            'department',
            function ($query) use ($department_slug) {
                $query->where('slug', $department_slug);
            }
        )->get();

        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
