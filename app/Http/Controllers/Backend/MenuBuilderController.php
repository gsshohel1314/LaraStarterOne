<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuBuilderController extends Controller
{
    public function index($id){
        Gate::authorize('app.menus.index');

        $menuId = Menu::findOrFail($id);
        return view('backend.menus.builder', compact('menuId'));
    }

    public function itemCreate($id){
        Gate::authorize('app.menus.create');

        $menuId = Menu::findOrFail($id);
        return view('backend.menus.item.form', compact('menuId'));
    }

    public function itemStore(Request $request, $id){
        Gate::authorize('app.menus.create');

        $this->validate($request,[
            'type' =>'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->menuItems()->create([
            'type' => $request->get('type'),
            'title' => $request->get('title'),
            'divider_title' => $request->get('divider_title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);

        notify()->success('Menu item added', 'Success');
        return redirect()->route('app.menus.builder', $menu->id);
    }

    public function itemEdit($id, $itemId){
        Gate::authorize('app.menus.edit');

        $menuId = Menu::findOrFail($id);
        $menuItem = $menuId->menuItems()->findOrFail($itemId);
        return view('backend.menus.item.form', compact('menuId', 'menuItem'));
    }

    public function itemUpdate(Request $request, $id, $itemId){
        Gate::authorize('app.menus.edit');

        $this->validate($request,[
            'type' =>'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->menuItems()->findOrFail($itemId)->update([
            'type' => $request->get('type'),
            'title' => $request->get('title'),
            'divider_title' => $request->get('divider_title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);

        notify()->success('Menu item updated', 'Success');
        return back();
    }

    public function itemDestroy($id, $itemId){
        Gate::authorize('app.menus.delete');

        Menu::findOrFail($id)
            ->menuItems()
            ->findOrFail($itemId)
            ->delete();
        notify()->success('Menu item deleted', 'Success');
        return back();
    }
}
