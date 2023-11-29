 <!--Modal tambah bahan bakar-->
 <div class="modal fade text-left modal-borderless" id="modal_insert" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Ubah Kata Sandi</h5>
                 <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <form action="{{ route('updatePassword') }}" method="post">
                 @csrf
                 <div class="modal-body">
                     <div class="form-group ">
                         <label>Kata Sandi Lama</label>
                         <input name="old_password" required type="password" class="form-control" autocomplete="off">
                     </div>

                     <div class="form-group ">
                         <label>Kata Sandi Baru</label>
                         <input name="new_password" required type="password" class="form-control" autocomplete="off">
                     </div>


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                         <i class="bx bx-x d-block d-sm-none"></i>
                         <span class="d-none d-sm-block">Batal</span>
                     </button>
                     <button type="submit" class="btn btn-primary ms-1">
                         <i class="bx bx-check d-block d-sm-none"></i>
                         <span class="d-none d-sm-block">Simpan</span>
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
