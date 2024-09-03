<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Profil Pengguna</h5>
        <small class="text-muted float-end">Detail isian</small>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="mb-3">
                <label class="form-label" for="exampleInputFrontTitle">Gelar Depan</label>
                <input type="text" class="form-control @error('front_title') is-invalid @enderror" id="exampleInputFrontTitle"
                       placeholder="Gelar Depan"
                       wire:model="front_title">
                @error('front_title')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="exampleInputUsername1">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1"
                       placeholder="Nama Pengguna"
                       wire:model="name">
                @error('name')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="exampleInputBackTitle">Gelar Belakang</label>
                <input type="text" class="form-control @error('back_title') is-invalid @enderror" id="exampleInputBackTitle"
                       placeholder="Gelar Belakang"
                       wire:model="back_title">
                @error('back_title')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                       placeholder="Email" wire:model="email">
                @error('email')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="scopusId">Scopus ID</label>
                <input type="text" class="form-control @error('scopus_id') is-invalid @enderror" id="scopusId"
                       placeholder="Gelar Belakang"
                       wire:model="scopus_id">
                @error('scopus_id')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="scholarId">Scholar ID</label>
                <input type="text" class="form-control @error('scholar_id') is-invalid @enderror" id="scholarId"
                       placeholder="Gelar Belakang"
                       wire:model="scholar_id">
                @error('scholar_id')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="exampleInputPassword1" placeholder="Password"
                       wire:model="password" autocomplete="on" aria-describedby="password-type">
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="exampleInputConfirmPassword1">Confirm Password</label>
                <input type="password" class="form-control @error('repassword') is-invalid @enderror"
                       id="exampleInputConfirmPassword1" placeholder="Password"
                       wire:model="repassword" autocomplete="on" aria-describedby="repassword-type">

                @error('repassword')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-light">Cancel</button>
        </form>
    </div>
    <div class="modal fade" id="notification-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Profile Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data telah di perbarui!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok!</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('theme/sneatadmin/assets/js/form-validation.js')}}"></script>
    <script type="text/javascript">
        var modalForm = new bootstrap.Modal(document.getElementById('notification-modal'), {
            keyboard: false
        })

        window.addEventListener('closeModal', event => {
            modalForm.hide()
        });

        window.addEventListener('openModal', event => {
            modalForm.show()
        });
    </script>
@endpush
