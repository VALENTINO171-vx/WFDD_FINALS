<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function store(Request $request, $restaurantId)
    {
        $validated = $request->validate([
            'menu_item_name' => 'required|string',
            'menu_item_description' => 'nullable|string',
            'menu_item_price' => 'required|numeric|min:0',
            'menu_item_available' => 'nullable|boolean',
            'menu_item_category' => 'nullable|string',
        ]);

        $menu = MenuModel::create([
            'restaurant_id' => $restaurantId,
            'menu_item_name' => $validated['menu_item_name'],
            'menu_item_description' => $validated['menu_item_description'] ?? null,
            'menu_item_price' => $validated['menu_item_price'],
            'menu_item_available' => $validated['menu_item_available'] ?? true,
            'menu_item_category' => $validated['menu_item_category'] ?? null,
        ]);

        return response()->json(['menu' => $menu], 201);
    }

    public function update(Request $request, $id)
    {
        $menu = MenuModel::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $validated = $request->validate([
            'menu_item_name' => 'required|string',
            'menu_item_description' => 'nullable|string',
            'menu_item_price' => 'required|numeric|min:0',
            'menu_item_available' => 'nullable|boolean',
            'menu_item_category' => 'nullable|string',
        ]);

        $menu->update([
            'menu_item_name' => $validated['menu_item_name'],
            'menu_item_description' => $validated['menu_item_description'] ?? null,
            'menu_item_price' => $validated['menu_item_price'],
            'menu_item_available' => $validated['menu_item_available'] ?? true,
            'menu_item_category' => $validated['menu_item_category'] ?? null,
        ]);

        return response()->json(['menu' => $menu], 200);
    }

    public function destroy(Request $request, $id)
    {
        $menu = MenuModel::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu item deleted successfully'], 200);
    }
}
