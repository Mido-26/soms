@extends('layouts.app')

@section('title', 'Members')
@section('name', 'Members')

@section('content')
@include('layouts.back')
<div class="bg-white p-6 shadow-md rounded w-full overflow-x-auto">
    <!-- Add Customer Button -->
    <div class="mb-4 text-right">
        <a href="{{ route('members.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-800">
            <i class="fa-solid fa-circle-plus mr-2"></i> Add New Member
        </a>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->first_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->last_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->phone_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->role }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if ($user->status === 'active')
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($user->status) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ ucfirst($user->status) }}
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-sm font-medium flex space-x-4">
                            <!-- View Icon -->
                            <a href="{{ route('members.show', $user->id) }}" class="text-blue-600 hover:text-blue-800" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                        
                            <!-- Update Icon -->
                            <a href="{{ route('members.edit', $user->id) }}" class="text-yellow-600 hover:text-yellow-800" title="Update Member">
                                <i class="fas fa-edit"></i>
                            </a>
                        
                            <!-- Delete Icon -->
                            <form action="{{ route('members.destroy', $user->id) }}" method="POST" class="inline-block" title="Delete Member">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete Member">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4 border-t border-gray-400 pt-2">
        {{ $users->links('pagination::tailwind') }}
    </div>
</div>


@endsection