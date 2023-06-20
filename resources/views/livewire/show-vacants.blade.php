<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacants as $vacant)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="leading-10">
                    <a href="{{ route('vacants.show', $vacant->id) }}" class="text-xl font-bold">
                        {{ $vacant->title }}
                    </a>

                    <p class="text-sm text-gray-600 font-bold">{{ $vacant->company }}</p>
                    <p class="text-sm text-gray-500">Last Day: {{ $vacant->last_day->format('d/m/Y') }}</p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="{{ route('candidates.index', $vacant) }}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        {{ $vacant->candidates->count() }} Candidates
                    </a>

                    <a href="{{ route('vacants.edit', $vacant->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Edit
                    </a>

                    <button wire:click="$emit('showDeleteAlert', {{ $vacant->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No vacants to show</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $vacants->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('showDeleteAlert', vacantId => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                Livewire.emit('deleteVacant', vacantId)

                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush