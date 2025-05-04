<div class="card mb-1">
    <div class="card-header">Select User</div>

    <style>
        .searchproducts {
            max-height: 150px;
            overflow-y: scroll;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 2px;
        }

        .searchproductcard:hover {
            background-color: #f0f0f0;
        }
    </style>

    <div class="card-body">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">

                <div class="col-md-12 my-2 text-secondary">
                    <input type="text" wire:model.live="search" class="form-control"
                        placeholder="Search User...">
                    <x-spinner.loading-spinner />

                    <div class="col-md-12 mt-2 searchproducts">
                        @if ($users)
                            @foreach ($users as $user)
                                <div class="card searchproductcard m-2 p-0">
                                    <div class="card-body text-center py-2"
                                        wire:click="userSelected('{{ $user->id }}', '{{ $user->name }}')"
                                        style="cursor: pointer;">
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center my-2">No User found!</p>
                        @endif

                        {{-- <div class="mt-3">
                            {{ $orders->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
