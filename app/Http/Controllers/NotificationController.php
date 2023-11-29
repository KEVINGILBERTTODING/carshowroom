<?php

namespace App\Http\Controllers;

use App\Models\NotificationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function setReadClient()
    {
        $data = [
            'status' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        NotificationModel::where('user_id', session('user_id'))->update($data);
    }

    function deleteNotifClient()
    {
        $delete = NotificationModel::where('user_id', session('user_id'))->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Berhasil menghapus notifikasi');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus notifikasi');
        }
    }
}
