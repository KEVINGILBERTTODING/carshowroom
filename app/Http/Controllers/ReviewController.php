<?php

namespace App\Http\Controllers;

use App\Models\ReviewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    function store(Request $request)
    {
        $rules = [];
        $messages = [];
        $dataReview = [];

        $validator = Validator::make($request->all(), [
            'mobil_id' => 'required|numeric',
            'review_text' => 'required|string',
            'star' => 'required|numeric',

        ], [
            'mobil_id.required' => 'Terjadi kesalahan',
            'mobil_id.numeric' => 'Terjadi kesalahan',
            'review_text.required' => 'Text review tidak boleh kosong',
            'review_text.string' => 'Text review hanya boleh berupa huruf dan angka',
            'star.required' => 'Anda belum memilih bintang review',
            'star' => 'Terjadi kesalahan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                $rules['image' . $i] = 'image|mimes:jpeg,png,jpg|max:2048';
                $messages['image' . $i . '.image'] = 'Gambar review ' . $i . ' tidak valid';
                $messages['image' . $i . '.mimes'] = 'Gambar review ' . $i . ' format tidak valid';
                $messages['image' . $i . '.max'] = 'Gambar review ' . $i . ' ukuran gambar tidak boleh lebih dari 2 MB';
            }
        }

        $validatorImage = Validator::make($request->all(), $rules, $messages);
        if ($validatorImage->fails()) {
            return redirect()->back()->with('failed', $validatorImage->errors()->first());
        }

        // simpan gambar ke server
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                $file =  $request->file('image' . $i);
                $fileName = 'RVW-' . $i . '-' . $request->mobil_id .  '.' . $file->getClientOriginalExtension();
                $file->move('data/review', $fileName);
                $dataReview['image' . $i] = $fileName;
            }
        }

        $dataReview['user_id'] = session('user_id');
        $dataReview['mobil_id'] = $request->mobil_id;
        $dataReview['review_text'] = $request->review_text;
        $dataReview['star'] = $request->star;
        $dataReview['status'] = 1;
        $dataReview['created_at'] = Carbon::now()->format('Y-m-d H:i:s');



        try {
            $store = ReviewModel::insert($dataReview);
            if ($store) {
                return redirect()->back()->with('success', 'Berhasil menambahkan ulasan');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan ulasan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }
}
