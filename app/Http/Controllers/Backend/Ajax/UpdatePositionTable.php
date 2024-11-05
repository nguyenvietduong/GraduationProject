<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class UpdatePositionTable extends Controller
{
    public function updatePositions(Request $request)
    {
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value) {
            $table = Table::find($value);
            $table->position = $key;
            $table->save();
        }
        return response()->json(['message' => 'Position updated successfully']);
    }
}
