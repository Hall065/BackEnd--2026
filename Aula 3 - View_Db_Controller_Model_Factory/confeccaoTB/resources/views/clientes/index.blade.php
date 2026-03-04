<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nossa Confecção
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">CPF</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Telefone</th>
                                <th class="px-4 py-2">Endereço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="border px-4 py-2">{{ $client->id }}</td>
                                    <td class="border px-4 py-2">{{ $client->name }}</td>
                                    <td class="border px-4 py-2">{{ $client->cpf }}</td>
                                    <td class="border px-4 py-2">{{ $client->email }}</td>
                                    <td class="border px-4 py-2">{{ $client->telefone }}</td>
                                    <td class="border px-4 py-2">{{ $client->endereco }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>