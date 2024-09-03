<div class="card">
    <h5 class="card-header">Admin Program Studi</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th> Nama</th>
                    <th> Program Studi</th>
                    <th> Email</th>
                    <th> Aksi</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->studyProgram->name}}
                        </td>
                        <td>
                            {{$item->email}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-warning"
                                    wire:click="SetSelectedItem({{$item}})">Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    wire:click="SelectDeleteItem({{$item}})">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="edit-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Name</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email</label>
                            <input type="email" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-0">
                            <label for="dobWithTitle" class="form-label">DOB</label>
                            <input type="date" id="dobWithTitle" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Profile Update</h5>
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
        var editForm = new bootstrap.Modal(document.getElementById('edit-modal'), {
            keyboard: false
        });
        var deleteForm = new bootstrap.Modal(document.getElementById('delete-modal'), {
            keyboard: false
        })

        window.addEventListener('closeEdit', event => {
            editForm.hide()
        });

        window.addEventListener('openEdit', event => {
            editForm.show()
        });

        window.addEventListener('closeDelete', event => {
            deleteForm.hide()
        });

        window.addEventListener('openDelete', event => {
            deleteForm.show()
        });

    </script>
@endpush
