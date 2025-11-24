<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassRequest;
use App\Http\Requests\Admin\UpdateClassRequest;
use App\Models\WorkshopClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ClassController extends Controller
{
    public function index()
    {
        $classes = WorkshopClass::latest()->paginate(10);
        return view('admin.class', compact('classes'));
    }

    public function edit(Request $request)
    {
        $id = $request->query('id');
        $class = $id ? WorkshopClass::find($id) : null;
        return view('admin.edit-class', compact('class'));
    }

    public function create()
    {
        $class = null;
        return view('admin.add-class', compact('class'));
    }

    public function store(StoreClassRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['starts_at'])) {
            $data['starts_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['starts_at']);
        }
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('classes', 'public');
        }
        $class = WorkshopClass::create($data);
        return redirect()->route('admin.class.index');
    }

    public function update(UpdateClassRequest $request, $id): RedirectResponse
    {
        $class = WorkshopClass::findOrFail($id);
        $data = $request->validated();
        if (isset($data['starts_at'])) {
            $data['starts_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['starts_at']);
        }
        if ($request->hasFile('image')) {
            if ($class->image_path) {
                Storage::disk('public')->delete($class->image_path);
            }
            $data['image_path'] = $request->file('image')->store('classes', 'public');
        }
        $class->update($data);
        return redirect()->route('admin.class.index');
    }

    public function destroy($id): RedirectResponse
    {
        $class = WorkshopClass::findOrFail($id);
        if ($class->image_path) {
            Storage::disk('public')->delete($class->image_path);
        }
        $class->delete();
        return redirect()->route('admin.class.index');
    }
}
