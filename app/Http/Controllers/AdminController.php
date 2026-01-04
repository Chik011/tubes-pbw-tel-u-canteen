<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    // ✅ DASHBOARD ADMIN (/admin)
    public function index()
    {
        $orders = Order::with('items.menu')->get();
        return view('admin.history', compact('orders'));
    }

    // ================= MENU =================

    public function menus()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function createMenu()
    {
        return view('admin.menus.create');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $menu = Menu::create($data);

        // Append new menu to MenuSeeder
        $this->appendToMenuSeeder($menu);

        return redirect()->route('admin.menus')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Append new menu to MenuSeeder.php file
     */
    private function appendToMenuSeeder(Menu $menu)
    {
        $seederPath = database_path('seeders/MenuSeeder.php');
        $menuEntry = "
        [
            'name' => '{$menu->name}',
            'description' => '{$menu->description}',
            'price' => {$menu->price},
            'image' => '{$menu->image}',
            'created_at' => now(),
            'updated_at' => now(),
        ],";

        // Read the file content
        $content = file_get_contents($seederPath);

        // Find the position before the closing ]); and insert the new entry
        $closingPattern = "\n        ]);\n    }\n}";
        if (strpos($content, $closingPattern) !== false) {
            $newContent = str_replace(
                $closingPattern,
                $menuEntry . "\n        ]);\n    }\n}",
                $content
            );
            file_put_contents($seederPath, $newContent);
        }
    }

    public function editMenu(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function updateMenu(Request $request, Menu $menu)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $menu->update($data);

        // Update MenuSeeder with new menu data
        $this->updateMenuSeeder($menu);

        return redirect()->route('admin.menus')
            ->with('success', 'Menu berhasil diupdate');
    }

    /**
     * Update menu entry in MenuSeeder.php file
     */
    private function updateMenuSeeder(Menu $menu)
    {
        $seederPath = database_path('seeders/MenuSeeder.php');
        $content = file_get_contents($seederPath);

        // Search for existing entry by name
        $oldPattern = "/(\s*)'(\w+)' => '{$menu->name}',.*?(\1\],)/s";
        
        // New entry to replace
        $newEntry = "
        [
            'name' => '{$menu->name}',
            'description' => '{$menu->description}',
            'price' => {$menu->price},
            'image' => '{$menu->image}',
            'created_at' => now(),
            'updated_at' => now(),
        ],";

        // Replace the old entry with the new one
        $newContent = preg_replace($oldPattern, $newEntry . "\n", $content);
        
        if ($newContent !== $content) {
            file_put_contents($seederPath, $newContent);
        }
    }

    public function destroyMenu(Menu $menu)
    {
        // Delete image from public/img folder
        if ($menu->image && file_exists(public_path('img/' . $menu->image))) {
            unlink(public_path('img/' . $menu->image));
        }

        // Remove menu entry from MenuSeeder
        $this->removeFromMenuSeeder($menu);

        $menu->delete();

        return redirect()->route('admin.menus')
            ->with('success', 'Menu berhasil dihapus');
    }

    /**
     * Remove menu entry from MenuSeeder.php file
     */
    private function removeFromMenuSeeder(Menu $menu)
    {
        $seederPath = database_path('seeders/MenuSeeder.php');
        $content = file_get_contents($seederPath);

        // Pattern to find and remove the menu entry by name
        $pattern = "/(\s*)'(\w+)' => '{$menu->name}',.*?(\1\],)/s";

        // Remove the entry
        $newContent = preg_replace($pattern, '', $content);

        if ($newContent !== $content) {
            file_put_contents($seederPath, $newContent);
        }
    }

    // ================= HISTORY =================

    public function history()
    {
        $orders = Order::with('items.menu')->get();
        return view('admin.history', compact('orders'));
    }

    /**
     * Export orders to Excel
     */
    public function exportOrders()
    {
        $fileName = 'orders_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new OrdersExport, $fileName);
    }
}
