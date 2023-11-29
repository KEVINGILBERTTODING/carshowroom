<?php

namespace App\Http\Controllers;

use App\Models\NotificationAdminModel;
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
        NotificationModel::where('user_id', session('user_id'))->where('status', 0)->update($data);
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


    function deleteNotifAdmin()
    {
        try {
            $delete = NotificationAdminModel::truncate();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus notifikasi');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus notifikasi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function setReadAdmin()
    {
        $data = [
            'status' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        $update = NotificationAdminModel::where('status', 0)->update($data);
        if ($update) {
            return response([
                'status' => true,
                'message' => 'success'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'error'
            ], 404);
        }
    }
}
