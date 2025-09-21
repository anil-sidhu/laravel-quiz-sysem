<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Performance - {{$admin->name}}</title>
    @vite('resources/css/app.css')
    <style>
        .earnings-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .performance-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .course-card {
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <x-navbar name="{{$name}}"></x-navbar>
    
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">My Performance Dashboard</h1>
            <p class="text-gray-600">Track your course performance and earnings - {{$admin->name}}</p>
        </div>

        <!-- Personal Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="earnings-card p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Earnings</h3>
                        <p class="text-3xl font-bold">${{number_format($totalEarnings, 2)}}</p>
                    </div>
                    <div class="text-4xl opacity-80">💰</div>
                </div>
            </div>
            
            <div class="bg-yellow-500 p-6 rounded-xl shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Pending Earnings</h3>
                        <p class="text-3xl font-bold">${{number_format($pendingEarnings, 2)}}</p>
                    </div>
                    <div class="text-4xl opacity-80">⏳</div>
                </div>
            </div>
            
            <div class="performance-card p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Leads</h3>
                        <p class="text-3xl font-bold">{{$totalLeads}}</p>
                        <p class="text-sm opacity-80">{{$interestedLeads}} interested</p>
                    </div>
                    <div class="text-4xl opacity-80">👥</div>
                </div>
            </div>

            <div class="bg-green-500 p-6 rounded-xl shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Conversion Rate</h3>
                        <p class="text-3xl font-bold">{{$myConversionRate}}%</p>
                    </div>
                    <div class="text-4xl opacity-80">📈</div>
                </div>
            </div>
        </div>

        <!-- My Courses Performance -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">My Courses Performance</h2>
                <p class="text-gray-600 text-sm">Courses you created and their lead generation</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Signups</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interested</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Conversion Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($myCourses as $course)
                        <tr class="course-card hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{$course->title}}</div>
                                    <div class="text-sm text-gray-500">ID: {{$course->id}}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-blue-600">{{$course->total_signups}}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-green-600">{{$course->interested_signups}}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">{{$course->conversion_rate}}%</span>
                                    <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: {{min($course->conversion_rate, 100)}}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{$course->created_at ? $course->created_at->format('M d, Y') : 'Unknown'}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No courses created yet. <a href="/add-course" class="text-blue-600 hover:underline">Create your first course!</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Lead Payments -->
        @if($recentPayments->count() > 0)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Recent Lead Payments</h2>
                <p class="text-gray-600 text-sm">Your latest commission earnings</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lead</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quality</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentPayments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$payment->lead_generated_at->format('M d, Y')}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$payment->course ? $payment->course->title : 'Unknown Course'}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$payment->user ? $payment->user->name : 'Unknown User'}}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($payment->lead_quality === 'interested') bg-green-100 text-green-800
                                    @elseif($payment->lead_quality === 'converted') bg-blue-100 text-blue-800
                                    @elseif($payment->lead_quality === 'premium') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ucfirst($payment->lead_quality)}}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">
                                ${{number_format($payment->commission_amount, 2)}}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($payment->payment_status === 'paid') bg-green-100 text-green-800
                                    @elseif($payment->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ucfirst($payment->payment_status)}}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="/add-course" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                ➕ Create New Course
            </a>
            <a href="/course-analytics" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                📊 View All Analytics
            </a>
            <a href="/dashboard" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                🏠 Main Dashboard
            </a>
        </div>
    </div>
</body>
</html>
