<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SessionUser;

class CategoryController extends Controller
{
    public function index($success = null)
    {
        //
        $lstCate = Category::paginate(2);
        return view('test', [
            'cat' => $lstCate,
            // 'success' => $success
        ]);
    }

    public function delete(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect()->route('category_index')->with('success', 'xoá thành công');
    }

    public function category(Request $request)
    {
        $token = $request->header('token');
        $checkToken = SessionUser::where('token', $token)->first();
        if (empty($token)) {
            return response()->json([
                'code' => 200,
                'message' => 'Authorized error',
            ], 200,);
        } else if (empty($checkToken)) {
            return response()->json([
                'code' => 200,
                'message' => 'Authorized invalid',
            ], 200,);
        } else {
            $lstCate = Category::all();
            return response()->json([
                'code' => 200,
                'data' => $lstCate,
            ]);
        }
    }
}
