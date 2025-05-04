<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">

                @if (!$UsersLogs->isEmpty())
                    {{ $UsersLogs[0]->user->name }}
                @endif
            </h3>
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entries
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('id')" href="#" role="button">
                            {{ __('Id') }}
                            @include('inclues._sort-icon', ['field' => 'id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('time')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'Day'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Time') }}
                            @include('inclues._sort-icon', ['field' => 'time'])
                        </a>
                    </th>

                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $previousDate = null;
                @endphp

                @forelse ($UsersLogs as $userslog)
                    @php
                        // Check if the date has changed
                        $currentDate = $userslog->date;
                        $date = strtotime($currentDate);
                        $day = date('l', $date);
                    @endphp
                    @if ($previousDate && $previousDate != $currentDate)
                        <tr class="align-middle text-center">
                            <td colspan="7" class="">
                                
                                <figure class="text-center  p-0 m-0"> 
                                    <figcaption class="blockquote-footer m-0">
                                     <i> Next day recode </i>
                                    </figcaption>
                                  </figure>
                            
                            </td> <!-- Blank row -->
                            
                        </tr>
                    @endif
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $userslog->status }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $currentDate }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $day }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $userslog->time }}
                        </td>
                        <td class="align-middle text-center">
                            <x-button.back class="btn-icon" route="{{ route('users.index') }}" />
                        </td>
                    </tr>
                    @php
                        // Update the previous date to the current date
                        $previousDate = $currentDate;
                    @endphp
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            No results found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary d-none d-sm-block">
            Showing <span>{{ $UsersLogs->firstItem() }}</span> to <span>{{ $UsersLogs->lastItem() }}</span> of
            <span>{{ $UsersLogs->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $UsersLogs->links() }}
        </ul>
    </div>
</div>
