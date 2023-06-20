<form action="" method="POST" class="md:w-1/2 space-y-5" wire:submit.prevent='editVacant'>
    <!-- Vacant Title -->
    <div>
        <x-input-label for="title" :value="__('Vacant Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" placeholder="Vacant Title" />
        @error('title')
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
        @enderror
    </div>

    <!-- Salary -->
    <div>
        <x-input-label for="salary" :value="__('Salary')" />
        <select wire:model="salary" id="salary" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Select Salary --</option>
            @foreach ($salaries as $salary)
                <option value="{{ $salary->id }}">{{ $salary->salary }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
    </div>

    <!-- Category -->
    <div>
        <x-input-label for="category" :value="__('Category')" />
        <select wire:model="category" id="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <!-- Company -->
    <div>
        <x-input-label for="company" :value="__('Company Name')" />
        <x-text-input id="company" class="block mt-1 w-full" type="text" wire:model="company" :value="old('company')" placeholder="Company: ex. Netflix, Uber, Sporify" />
        <x-input-error :messages="$errors->get('company')" class="mt-2" />
    </div>

    <!-- Last Day -->
    <div>
        <x-input-label for="last_day" :value="__('Last Day for Suscription')" />
        <x-text-input id="last_day" class="block mt-1 w-full" type="date" wire:model="last_day" :value="old('last_day')" />
        <x-input-error :messages="$errors->get('last_day')" class="mt-2" />
    </div>

    <!-- Description -->
    <div>
        <x-input-label for="Description" :value="__('Job Description')" />
        <textarea wire:model="description" id="description" placeholder="This company is looking for ..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"></textarea>
        <x-input-error :messages="$errors->get('company')" class="mt-2" />
    </div>

    <!-- Image -->
    <div>
        <x-input-label for="image" :value="__('Image')" />
        <x-text-input id="image" class="block mt-1 w-full" type="file" wire:model="new_image" accept="image/*" />
        <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
    </div>

    <div class="my-5 w-80">
        <x-input-label :value="__('Actually Image')" />
        @if ($image)
            <img src="{{ asset('storage/vacant/' . $image) }}" alt="{{ 'Vacant Image ' . $title }}">
        @endif
    </div>

    <div class="my-5 w-80">
        @if ($new_image)
            Image:
            <img src="{{ $new_image->temporaryUrl() }}" alt="" srcset="">
        @endif
    </div>

    <x-primary-button>
        {{ __('Save Vacant') }}
    </x-primary-button>
</form>