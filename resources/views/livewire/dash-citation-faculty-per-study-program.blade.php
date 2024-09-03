<div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Statistik Per-Program Studi</h5>
        <div class="dropdown">
            <button
                class="btn p-0"
                type="button"
                id="transactionID"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <ul class="p-0 m-0">
            <div class="mb-3 row">
                <label for="start_year" class="col-md-4 col-form-label">From</label>
                <div class="col-md-8">
                    <input class="form-control" type="number" id="start_year" wire:model="minYear">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="end_year" class="col-md-4 col-form-label">To</label>
                <div class="col-md-8">
                    <input class="form-control" type="number" id="end_year" wire:model="maxYear">
                </div>
            </div>
            @foreach($info as $item)
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                        <img src="{{asset('theme/sneatadmin/assets/img/icons/unicons/chart.png')}}"
                             alt="User" class="rounded"/>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">{{$item['info']->name}}</h6>
                            <small class="text-muted d-block mb-1">{{$item['totalCitation']}} citation di Tahun {{$minYear}} s.d {{$maxYear}}</small>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
