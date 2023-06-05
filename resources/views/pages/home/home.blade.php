@extends('layouts.main')

@section('styles')
    @vite('resources/css/home.css')
@endsection

@section('pages')
    <div class="text-center">
        <button class="userCreate bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-xl mt-4 text-white font-bold">Create</button>
    </div>
    <div class="relative overflow-x-auto mt-4 flex justify-center">
        <table class="text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Password</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->password }}</td>
                        <td class="px-6 py-4">
                            <button class="userEdit bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-xl text-white font-bold"
                                userData="{{ $user }}">Edit</button>
                            <button class="userDelete bg-red-500 hover:bg-red-600 px-4 py-2 rounded-xl text-white font-bold"
                                userID="{{ $user->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/home.js')
@endsection
