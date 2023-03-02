@props(['data'])
<div class="flex space-x-5 bg-white px-4 py-2 rounded-md border-gray-300 shadow-sm">
    <div class=" relative h-10 w-10">
        <img class="h-full w-full rounded-full object-cover object-center"
            src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="" />
        @if ($data->isOnline())
            <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
        @else
            <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-gray-400 ring ring-white"></span>
        @endif
    </div>
    <div class="text-sm">
        <div class="font-medium text-gray-700">{{ $data->name }}</div>
        <div class="text-gray-400">{{ $data->email }}</div>
    </div>

</div>
