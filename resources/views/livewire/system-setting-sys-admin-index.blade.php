<div class="card">
    <h5 class="card-header">Reporting Universitas</h5>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="start_year" class="col-md-4 col-form-label">From</label>
            <div class="col-md-8">
                <input class="form-control" type="number" id="start_year" wire:model="startYear">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="end_year" class="col-md-4 col-form-label">To</label>
            <div class="col-md-8">
                <input class="form-control" type="number" id="end_year" wire:model="endYear">
            </div>
        </div>
        <div class="mb-3 row">
            <button wire:click="createDataBatch" class="btn btn-primary">Generate Batch Report Scholar</button>
        </div>
    </div>
</div>
