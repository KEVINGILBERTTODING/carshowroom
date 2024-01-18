<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    function index()
    {
        if (session('role') != 'admin') {
            return redirect()->route('/');
        }
        try {
            $dataApp = AppModel::first();
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
            $data = [
                'dataApp' => $dataApp,
                'dataAdmin' => $dataAdmin
            ];
            return view('admin.setting.setting', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateDataShowroom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'jadwal' => 'required|string',
            'alamat' => 'required|string',
            'url_facebook' => 'required|string',
            'url_instagram' => 'required|string',
            'url_youtube' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya boleh mengandung huruf dan angka',
            'numeric' => ':attribute hanya boleh mengandung angka'
        ], [
            'app_name' => 'Nama showroom',
            'no_hp' => 'No handphone',
            'email' => 'Email',
            'jadwal' => 'Jadwal',
            'alamat' => 'Alamat',
            'url_facebook' => 'Url facebook',
            'url_instagram' => 'Url Instagram',
            'url_youtube' => 'Url Youtube',
            'visi' => 'Visi',
            'misi' => 'Misi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'app_name' => $request->app_name,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jadwal' => $request->jadwal,
                'alamat' => $request->alamat,
                'url_facebook' => $request->url_facebook,
                'url_instagram' => $request->url_instagram,
                'url_youtube' => $request->url_youtube,
                'visi' => $request->visi,
                'misi' => $request->misi
            ];

            $store = AppModel::where('app_id', 1)->update($data);
            if ($store) {
                return redirect()->route('settings')->with('success', 'Berhasil mengubah data');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah data');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateContent(Request $request)
    {
        $dataApp = [];
        $rules = [];
        $messages = [];
        if ($request->hasFile('logo')) {
            $rules['logo'] = 'image|mimes:jpeg,png,jpg|max:5000';
            $messages['logo' . '.image'] = 'File logo harus berupa gambar';
            $messages['logo' . '.mimes'] = 'Format gambar logo tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
            $messages['logo' . '.max'] = 'Ukuran gambar logo tidak boleh lebih dari 3 MB';
        }

        for ($i = 1; $i <= 2; $i++) {
            if ($request->hasFile('img_hero' . $i)) {
                $rules['img_hero' . $i] = 'image|mimes:jpeg,png,jpg|max:5000';
                $messages['img_hero' . $i . '.image'] = 'File banner utama harus berupa gambar';
                $messages['img_hero' . $i . '.mimes'] = 'Format gambar banner utama tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                $messages['img_hero' . $i . '.max'] = 'Ukuran gambar banner utama tidak boleh lebih dari 3 MB';
            }
        }

        if ($request->hasFile('img_about_us')) {
            $rules['img_about_us'] = 'image|mimes:jpeg,png,jpg|max:5000';
            $messages['img_about_us' . '.image'] = 'File tentang kami 2 harus berupa gambar';
            $messages['img_about_us' . '.mimes'] = 'Format gambar tentang kami 2 tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
            $messages['img_about_us' . '.max'] = 'Ukuran gambar tentang kami 2 tidak boleh lebih dari 3 MB';
        }

        if ($request->hasFile('img_about_us2')) {
            $rules['img_about_u2'] = 'image|mimes:jpeg,png,jpg|max:5000';
            $messages['img_about_u2' . '.image'] = 'File  gambar tentang kami 1 harus berupa gambar';
            $messages['img_about_u2' . '.mimes'] = 'Format gambar  gambar tentang kami 1 tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
            $messages['img_about_u2' . '.max'] = 'Ukuran gambar  gambar tentang kami 1 tidak boleh lebih dari 3 MB';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileNameLogo = 'logo-' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $logo->getClientOriginalExtension();
            $logo->move('data/app/img', $fileNameLogo);
            $dataApp['logo'] = $fileNameLogo;
        }

        for ($i = 1; $i <= 2; $i++) {
            if ($request->hasFile('img_hero' . $i)) {
                $fileHero = $request->file('img_hero' . $i);
                $fileNameHero = 'Hero-' . $i . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileHero->getClientOriginalExtension();
                $fileHero->move('template/client/img/main', $fileNameHero);
                $dataApp['img_hero' . $i] = $fileNameHero;
            }
        }
        if ($request->hasFile('img_about_us')) {
            $fileAboutUs1 = $request->file('img_about_us');
            $fileNameAboutUs1 = 'AboutUs1-' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileAboutUs1->getClientOriginalExtension();
            $fileAboutUs1->move('template/client/img/about/', $fileNameAboutUs1);
            $dataApp['img_about_us'] = $fileNameAboutUs1;
        }

        if ($request->hasFile('img_about_us2')) {
            $fileAboutUs2 = $request->file('img_about_us2');
            $fileNameAboutUs2 = 'AboutUs2-' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileAboutUs2->getClientOriginalExtension();
            $fileAboutUs2->move('template/client/img/main', $fileNameAboutUs2);
            $dataApp['img_about_us2'] = $fileNameAboutUs2;
        }

        try {
            $update = AppModel::where('app_id', 1)->update($dataApp);
            if ($update) {
                return redirect()->route('settings')->with('success', 'Berhasil mengubah data');
            } else {
                return redirect()->route('settings')->with('failed', 'Gagal mengubah data');
            }
        } catch (\Throwable $th) {
            return redirect()->route('settings')->with('failed', 'Terjadi kesalahan');
        }
    }
}
