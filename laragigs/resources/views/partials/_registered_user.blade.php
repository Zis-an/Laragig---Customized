<x-layout>
    <table class="table-auto mx-auto">
        <thead>
            <tr class="">
                <th class="border-2 border-black px-2">SL No.</th>
                <th class="border-2 border-black px-32">Name</th>
                <th class="border-2 border-black px-32">Email</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td class="text-center border-2 border-black">{{ $i++ }}</td>
                    <td class="text-center border-2 border-black">{{ $user->name }}</td>
                    <td class="text-center border-2 border-black">{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
