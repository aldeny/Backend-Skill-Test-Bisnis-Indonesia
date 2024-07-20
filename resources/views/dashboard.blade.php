<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}

          <div class="mt-4">
            {{ Auth::user()->name }}

            <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
              <form action="#" method="POST">
                <div class="mb-4">
                  <label for="datetime" class="block text-gray-700 text-sm font-bold mb-2">Select Date and Time:</label>
                  <input type="datetime-local" id="datetime" name="datetime" class="border border-gray-300 rounded py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-center justify-between">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
