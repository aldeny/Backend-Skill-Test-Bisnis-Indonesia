<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Event') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <table>
            <tr></tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            </tr>
            @foreach ($events as $event)
            <tr>
              <td>{{ $event->event_name }}</td>
              <td>{{ $event->start_date }}</td>
              <td>{{ $event->end_date }}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
