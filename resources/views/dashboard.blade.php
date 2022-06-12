<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            <div x-data="pokemonSearch"
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Alpine Pokemon
                        API Fetch DEMO</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Type any Pokemon name and get results!</p>


                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input x-model="search" @keydown.enter="searching" type="search" id="default-search"
                        class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="Search Pokemon" required="">
                    <button @click="searching"
                        class="text-white absolute right-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Search</button>
                </div>

                <template x-if="pokemon">
                    <div class="text-white right-2.5 bottom-2.5 top-2.5">
                        Pokemon: <span x-text="pokemon.name"></span>
                        <img :src="pokemon.sprites.front_shiny">
                        <template x-for="ab in pokemon.abilities" :key="ab.ability.url">
                            <li x-text="ab.ability.name"></li>
                        </template>
                    </div>
                </template>

            </div>

        </h2>
    </x-slot>
    @section('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('pokemonSearch', () => ({
                    search: '',
                    pokemon: null,

                    searching() {
                        fetch(`https://pokeapi.co/api/v2/pokemon/${this.search}`)
                            .then(response => response.json())
                            .then(data => {
                                this.pokemon = data;
                            })
                            .catch(error => {
                                alert('404 not found');
                            });
                    }

                }))
            })
        </script>
    @endsection
</x-app-layout>
