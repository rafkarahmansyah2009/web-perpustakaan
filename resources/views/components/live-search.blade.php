@props(['action', 'type', 'placeholder' => 'Cari...', 'wrapperClass' => 'mb-6', 'inputClass' => '!py-3 text-sm', 'buttonClass' => '!px-6', 'showButton' => true])

<form method="GET" action="{{ $action }}" class="{{ $wrapperClass }} relative w-full" id="searchForm-{{ $type }}">
    <div class="flex gap-3 relative">
        @if(!$showButton)
        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        @endif
        <input type="text" name="search" id="searchInput-{{ $type }}" value="{{ request('search') }}" placeholder="{{ $placeholder }}"
            class="input-field flex-1 {{ $inputClass }} {{ !$showButton ? '!pl-9' : '' }}" autocomplete="off" data-search-type="{{ $type }}">
        @if($showButton)
        <button type="submit" class="btn-primary {{ $buttonClass }}">Cari</button>
        @endif
    </div>
    
    <!-- Live Search Dropdown -->
    <div id="searchDropdown-{{ $type }}" class="absolute z-50 w-full mt-2 bg-white rounded-card shadow-lg hidden overflow-hidden border border-[#eae8e3]" style="box-shadow: 0 4px 20px rgba(26,77,46,0.1);">
        <div id="searchLoading-{{ $type }}" class="p-4 text-center hidden">
            <svg class="animate-spin h-5 w-5 text-[#1a4d2e] mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <ul id="searchResults-{{ $type }}" class="max-h-[300px] overflow-y-auto"></ul>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput-{{ $type }}');
        const searchDropdown = document.getElementById('searchDropdown-{{ $type }}');
        const searchResults = document.getElementById('searchResults-{{ $type }}');
        const searchLoading = document.getElementById('searchLoading-{{ $type }}');
        let debounceTimer_{{ $type }};

        if (!searchInput) return;

        const searchType = searchInput.getAttribute('data-search-type');

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer_{{ $type }});
            const query = this.value.trim();

            if (query.length < 1) {
                searchDropdown.classList.add('hidden');
                return;
            }

            searchDropdown.classList.remove('hidden');
            searchResults.innerHTML = '';
            searchLoading.classList.remove('hidden');

            debounceTimer_{{ $type }} = setTimeout(() => {
                fetch(`/search/live?type=${searchType}&query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchLoading.classList.add('hidden');
                        searchResults.innerHTML = '';

                        if (data.length === 0) {
                            searchResults.innerHTML = '<li class="p-4 text-sm text-[#717971] text-center">Tidak ada hasil ditemukan.</li>';
                            return;
                        }

                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.className = 'border-b border-[#eae8e3] last:border-0 hover:bg-[#f5f3ee] transition-colors';
                            li.innerHTML = `
                                <a href="${item.url}" class="block p-4">
                                    <div class="font-semibold text-[#1b1c19] text-sm">${item.title}</div>
                                    <div class="text-xs text-[#717971] mt-1">${item.subtitle}</div>
                                </a>
                            `;
                            searchResults.appendChild(li);
                        });
                    })
                    .catch(error => {
                        searchLoading.classList.add('hidden');
                        searchResults.innerHTML = '<li class="p-4 text-sm text-red-500 text-center">Terjadi kesalahan.</li>';
                    });
            }, 400);
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                searchDropdown.classList.add('hidden');
            }
        });
    });
</script>
@endpush
