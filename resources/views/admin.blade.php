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
    <div class="w-full max-w-6xl mx-auto mt-8">
        <h1 class="text-2xl text-blue-700 font-bold mb-4">Users List</h1>
        <form method="get" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, mobile..." class="px-3 py-2 border border-gray-300 rounded-lg w-64">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
        </form>
        <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm">
                    <th class="p-2 border-b cursor-pointer">S. No</th>
                    <th class="p-2 border-b cursor-pointer">
                        <a href="?sort=name&direction={{ $sort == 'name' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Name @if($sort=='name')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer">
                        <a href="?sort=mobile&direction={{ $sort == 'mobile' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Mobile @if($sort=='mobile')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer">
                        <a href="?sort=email&direction={{ $sort == 'email' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Email @if($sort=='email')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer">
                        <a href="?sort=passing_year&direction={{ $sort == 'passing_year' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Passing Year @if($sort=='passing_year')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[5%]">
                        <a href="?sort=interested_in_training&direction={{ $sort == 'interested_in_training' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Interested in Training @if($sort=='interested_in_training')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[5%]">
                        <a href="?sort=leads&direction={{ $sort == 'leads' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Interested in Call @if($sort=='leads')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                    <th class="p-2 border-b cursor-pointer">
                        User Status
                    </th>
                    <th class="p-2 border-b cursor-pointer w-[10%]">
                        <a href="?sort=created_at&direction={{ $sort == 'created_at' && $direction == 'asc' ? 'desc' : 'asc' }}&{{ http_build_query(request()->except(['sort','direction','page'])) }}">Signup Date @if($sort=='created_at')<span class="text-xs">{{ $direction == 'asc' ? '▲' : '▼' }}</span>@endif</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr class="even:bg-gray-50 hover:bg-blue-50 text-sm">
                    <td class="p-2 border-b">{{ ($users->currentPage()-1)*$users->perPage() + $key + 1 }}</td>
                    <td class="p-2 border-b">{{ $user->name }}</td>
                    <td class="p-2 border-b">{{ $user->mobile }}</td>
                    <td class="p-2 border-b">{{ $user->email }}</td>
                    <td class="p-2 border-b">{{ $user->passing_year ? substr($user->passing_year, 0, 4) : '-' }}</td>
                    <td class="p-2 border-b">{{ $user->interested_in_training == 'yes' ? 'Yes' : 'No' }}</td>
                    <td class="p-2 border-b">{{ $user->leads ? 'Yes' : 'No' }}</td>
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
                    <td class="p-2 border-b">{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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