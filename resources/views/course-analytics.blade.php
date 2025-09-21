<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Analytics - Lead Tracking</title>
    @vite('resources/css/app.css')
    <style>
        .analytics-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stats-card {
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
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Course Analytics Dashboard</h1>
            <p class="text-gray-600">Track signup leads generated from each course</p>
        </div>

        <!-- Overall Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="analytics-card p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Course Leads</h3>
                        <p class="text-3xl font-bold">{{$totalLeads}}</p>
                    </div>
                    <div class="text-4xl opacity-80">👥</div>
                </div>
            </div>
            
            <div class="stats-card p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Interested Leads</h3>
                        <p class="text-3xl font-bold">{{$totalInterestedLeads}}</p>
                    </div>
                    <div class="text-4xl opacity-80">🎯</div>
                </div>
            </div>
            
            <div class="bg-green-500 p-6 rounded-xl shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Conversion Rate</h3>
                        <p class="text-3xl font-bold">{{$overallConversionRate}}%</p>
                    </div>
                    <div class="text-4xl opacity-80">📈</div>
                </div>
            </div>

            <div class="bg-yellow-500 p-6 rounded-xl shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Commissions</h3>
                        <p class="text-3xl font-bold">${{number_format($totalCommissions, 2)}}</p>
                        <p class="text-sm opacity-80">Pending: ${{number_format($pendingCommissions, 2)}}</p>
                    </div>
                    <div class="text-4xl opacity-80">💰</div>
                </div>
            </div>
        </div>

        <!-- Course Performance Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Course Performance</h2>
                <p class="text-gray-600 text-sm">Ranked by total signups generated</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Signups</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interested</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Conversion Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recent (30d)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($courses as $course)
                        <tr class="course-card hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{$course->title}}</div>
                                    <div class="text-sm text-gray-500">ID: {{$course->id}}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                @if(isset($course->createdByAdmin) && $course->createdByAdmin)
                                    {{$course->createdByAdmin->name}}
                                @elseif(isset($course->created_by_admin_id) && $course->created_by_admin_id)
                                    Admin ID: {{$course->created_by_admin_id}}
                                @else
                                    Not Assigned
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-lg font-bold text-blue-600">{{$course->total_signups}}</span>
                                    @if($course->total_signups > 0)
                                        <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Active</span>
                                    @endif
                                </div>
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
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-purple-600">{{$course->recent_signups}}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No course data available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Admin Performance -->
        @if($adminPerformance->count() > 0)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Admin Performance</h2>
                <p class="text-gray-600 text-sm">Lead generation by course creators</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Courses Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Leads</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interested Leads</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Success Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Earnings</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($adminPerformance as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{$admin->createdByAdmin ? $admin->createdByAdmin->name : 'Unknown'}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$admin->total_courses}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-blue-600">{{$admin->total_leads}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">{{$admin->interested_leads}}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$admin->total_leads > 0 ? round(($admin->interested_leads / $admin->total_leads) * 100, 2) : 0}}%
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                @if(isset($paymentAnalytics[$admin->created_by_admin_id]))
                                    <div>
                                        <span class="text-green-600 font-bold">${{number_format($paymentAnalytics[$admin->created_by_admin_id]->total_earnings, 2)}}</span>
                                        <div class="text-xs text-gray-500">
                                            Pending: ${{number_format($paymentAnalytics[$admin->created_by_admin_id]->pending_earnings, 2)}}
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-400">$0.00</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Back to Dashboard -->
        <div class="mt-8 text-center">
            <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
