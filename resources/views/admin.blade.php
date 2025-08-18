<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar name={{$name}} ></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <div class="w-full max-w-7xl mx-auto mt-8 px-4">
        <h1 class="text-xl sm:text-2xl text-green-900 font-bold mb-4">Users List</h1>
        <form method="get" class="mb-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, mobile..." class="flex-1 sm:w-64 px-3 py-2 border border-gray-300 rounded-lg">
            <button type="submit" class="bg-green-900 text-white px-4 py-2 rounded-lg whitespace-nowrap">Search</button>
        </form>
        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm">
                    <th class="p-2 border-b cursor-pointer w-[8%] text-center">S. No</th>
                    <th class="p-2 border-b cursor-pointer w-[20%] text-left">
                        <a href="?sort=name&direction={{ $sort == 'name' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Name @if($sort=='name')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[12%] text-center">
                        <a href="?sort=mobile&direction={{ $sort == 'mobile' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Mobile @if($sort=='mobile')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[10%] text-center">
                        <a href="?sort=passing_year&direction={{ $sort == 'passing_year' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Passing Year @if($sort=='passing_year')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[10%] text-center">
                        <a href="?sort=mobile_verified_at&direction={{ $sort == 'mobile_verified_at' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">OTP Verified @if($sort=='mobile_verified_at')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[20%] text-center">
                        <a href="?sort=interested_in_training&direction={{ $sort == 'interested_in_training' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Interested in Sharpener Job Guarantee Program @if($sort=='interested_in_training')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[12%] text-center">
                        User Status
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[8%] text-center">
                        <a href="?sort=created_at&direction={{ $sort == 'created_at' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Signup Date @if($sort=='created_at')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr class="even:bg-gray-50 hover:bg-blue-50 text-sm">
                    <td class="p-2 border-b text-center">{{ ($users->currentPage()-1)*$users->perPage() + $key + 1 }}</td>
                    <td class="p-2 border-b text-left">{{ $user->name }}</td>
                    <td class="p-2 border-b text-center">{{ $user->mobile }}</td>
                    <td class="p-2 border-b text-center">{{ $user->passing_year ? substr($user->passing_year, 0, 4) : '-' }}</td>
                    <td class="p-2 border-b text-center">
                        @if($user->mobile_verified_at)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Verified</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Not Verified</span>
                        @endif
                    </td>
                    <td class="p-2 border-b text-center">{{ $user->interested_in_training == 'yes' ? 'Yes' : 'No' }}</td>
                    <td class="p-2 border-b text-center">
                        <form method="post" action="{{ route('admin.updateUserStatus', $user->id) }}" class="flex items-center gap-2">
                            @csrf
                            <select name="user_status" class="border rounded px-2 py-1" onchange="this.form.submit()">
                                <option value="Not Interested" {{ $user->user_status == 'Not Interested' ? 'selected' : '' }}>Not Interested</option>
                                <option value="Interested" {{ $user->user_status == 'Interested' ? 'selected' : '' }}>Interested</option>
                                <option value="Joined" {{ $user->user_status == 'Joined' ? 'selected' : '' }}>Joined</option>
                                <option value="Follow up Required" {{ $user->user_status == 'Follow up Required' ? 'selected' : '' }}>Follow up Required</option>
                            </select>
                        </form>
                    </td>
                    <td class="p-2 border-b text-center">{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4">
            @foreach($users as $key=>$user)
            <div class="bg-white rounded-lg shadow p-4 border">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $user->mobile }}</p>
                    </div>
                    <span class="text-xs text-gray-500">#{{ ($users->currentPage()-1)*$users->perPage() + $key + 1 }}</span>
                </div>
                
                <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                    <div>
                        <span class="text-gray-500">Passing Year:</span>
                        <span class="font-medium">{{ $user->passing_year ? substr($user->passing_year, 0, 4) : '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Date:</span>
                        <span class="font-medium">{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Training:</span>
                        <span class="font-medium">{{ $user->interested_in_training == 'yes' ? 'Yes' : 'No' }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center flex-wrap gap-2">
                    <div>
                        @if($user->mobile_verified_at)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Verified</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Not Verified</span>
                        @endif
                    </div>
                    <form method="post" action="{{ route('admin.updateUserStatus', $user->id) }}" class="flex items-center">
                        @csrf
                        <select name="user_status" class="border rounded px-2 py-1 text-xs" onchange="this.form.submit()">
                            <option value="Not Interested" {{ $user->user_status == 'Not Interested' ? 'selected' : '' }}>Not Interested</option>
                            <option value="Interested" {{ $user->user_status == 'Interested' ? 'selected' : '' }}>Interested</option>
                            <option value="Joined" {{ $user->user_status == 'Joined' ? 'selected' : '' }}>Joined</option>
                            <option value="Follow up Required" {{ $user->user_status == 'Follow up Required' ? 'selected' : '' }}>Follow up Required</option>
                        </select>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-between items-center mt-4">
            <div class="text-gray-700 text-sm">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
            </div>
            <div class="pagination_admin">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html> 