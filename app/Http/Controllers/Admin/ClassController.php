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
use Illuminate\Support\Str;
use Throwable;

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
        if (isset($data['day']) && is_array($data['day'])) {
            $data['day'] = implode(',', array_map(function ($d) {
                return strtolower(trim((string) $d));
            }, $data['day']));
        }
        if (isset($data['starts_at'])) {
            $data['starts_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['starts_at']);
        }
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('classes', 'public');
        }
        try {
            WorkshopClass::create($data);
        } catch (Throwable $e) {
            $reason = $this->friendlyDbError($e);
            return back()->withInput()->with('error', $reason);
        }
        return redirect()->route('admin.class.index')->with('success', 'Data class berhasil ditambahkan');
    }

    public function update(UpdateClassRequest $request, $id): RedirectResponse
    {
        $class = WorkshopClass::findOrFail($id);
        $data = $request->validated();
        if (isset($data['day']) && is_array($data['day'])) {
            $data['day'] = implode(',', array_map(function ($d) {
                return strtolower(trim((string) $d));
            }, $data['day']));
        }
        if (isset($data['starts_at'])) {
            $data['starts_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['starts_at']);
        }
        if ($request->hasFile('image')) {
            if ($class->image_path) {
                Storage::disk('public')->delete($class->image_path);
            }
            $data['image_path'] = $request->file('image')->store('classes', 'public');
        }
        try {
            $class->update($data);
        } catch (Throwable $e) {
            $reason = $this->friendlyDbError($e);
            return back()->withInput()->with('error', $reason);
        }
        return redirect()->route('admin.class.index')->with('success', 'Data class berhasil diperbarui');
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

    protected function friendlyDbError(Throwable $e): string
    {
        $m = $e->getMessage();
        if (Str::contains($m, 'Data too long')) {
            return 'Gagal menyimpan: nilai salah satu field melebihi batas panjang kolom.';
        }
        if (Str::contains($m, 'Integrity constraint violation')) {
            return 'Gagal menyimpan: data tidak memenuhi aturan relasi atau keunikan.';
        }
        if (Str::contains($m, 'Unknown column')) {
            return 'Gagal menyimpan: kolom tidak ditemukan dalam tabel.';
        }
        return 'Gagal menyimpan: ' . Str::limit($m, 180);
    }
}
