<div class="modal fade text-left modal-borderless" id="modal_notification" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Notifikasi') }}</h4>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">

                @foreach ($dataNotification as $dn)
                    <a href="{{ route('detailTransaksi', Crypt::encrypt($dn->transaksi_id)) }}">
                        <div class="notification-item d-flex align-items-start">
                            <div class="avatar  avatar-md me-3">
                                {{-- berhasil --}}
                                @if ($dn->type == 1)
                                    <span class="badge bg-success rounded-pill text-sm">
                                        <i class="fa-solid fa-check " style="color: #ffffff;"></i>
                                    </span>
                                @elseif ($dn->type == 2)
                                    <span class="badge bg-warning rounded-pill text-sm">
                                        <i class="fa-solid fa-repeat " style="color: #ffffff;"></i>
                                    </span>
                                @elseif ($dn->type == 3)
                                    <span class="badge bg-info rounded-pill text-sm">
                                        <i class="fa-regular fa-credit-card " style="color: #ffffff;"></i>
                                    </span>
                                @elseif ($dn->type == 0)
                                    <span class="badge bg-danger rounded-pill text-sm">
                                        <i class="fa-regular fa-circle-xmark " style="color: #ffffff;"></i>
                                    </span>
                                @endif


                            </div>
                            <div class="notification-text">
                                <h4 class="notification-title text-sm">
                                    {{-- berhasil --}}
                                    @if ($dn->type == 1)
                                        Transaksi Anda telah selesai.
                                    @elseif ($dn->type == 2)
                                        Transaksi Anda sedang kami proses.
                                    @elseif ($dn->type == 3)
                                        Selamat Pengajuan kredit Anda telah disetujui pihak finance.
                                    @elseif ($dn->type == 0)
                                        Transaksi Anda tidak valid.
                                    @endif
                                </h4>
                                @if ($dn->type == 1)
                                    <p class="notification-subtitle text-sm text-success">Klik untuk melihat detail
                                        transaksi Anda.
                                    </p>
                                @elseif ($dn->type == 2)
                                    <p class="notification-subtitle text-sm text-warning">Klik untuk melihat detail
                                        transaksi Anda.
                                    </p>
                                @elseif ($dn->type == 3)
                                    <p class="notification-subtitle text-sm text-info">Klik untuk melihat detail
                                        transaksi Anda.
                                    </p>
                                @elseif ($dn->type == 0)
                                    <p class="notification-subtitle text-sm text-danger">Klik untuk melihat detail
                                        transaksi Anda.
                                    </p>
                                @endif

                                <p class="notification-subtitle text-sm text-muted">
                                    {{ $dn->created_at }}
                                </p>


                            </div>



                        </div>
                    </a>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>

                @if (!$dataNotification->isEmpty())
                    <a class="btn btn-primary ms-1" href="{{ route('deleteNotifClient') }}">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Hapus Semua</span>
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>
