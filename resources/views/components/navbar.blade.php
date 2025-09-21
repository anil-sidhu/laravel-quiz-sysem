<nav class=" bg-white shadow-md px-4 py-3">
      <div class="flex justify-between item-center">
      <div class="text-2xl text-gray-700 hover:text-blue-500 cursor-pointer">
            The Coding Skills
        </div>
        <div class=" space-x-4">
        @if(isset($name) && $name === 'leadsview')
            <a class="text-gray-700 hover:text-blue-500" href="/dashboard">Dashboard</a>
            <a class="text-gray-700 hover:text-blue-500" href="/admin-logout">Logout</a>
            <a class="text-gray-700 hover:text-blue-500" href="">Welcome {{$name}}</a>
        @else
        <a class="text-gray-700 hover:text-blue-500" href="/dashboard">Dashboard</a>
            <a class="text-gray-700 hover:text-blue-500" href="/admin-categories">Categories</a>
            <a class="text-gray-700 hover:text-blue-500" href="/add-quiz">Quiz</a>
            <a class="text-gray-700 hover:text-blue-500" href="/course-analytics">📊 Analytics</a>
            <a class="text-gray-700 hover:text-blue-500" href="/my-performance">💰 My Performance</a>
            <a class="text-gray-700 hover:text-blue-500" href="">Welcome {{$name}}</a>
            <a class="text-gray-700 hover:text-blue-500" href="/admin-logout">Logout</a>
            <a class="text-gray-700 hover:text-blue-500" href="/add-course">Add Course</a>
            <a class="text-gray-700 hover:text-blue-500" href="/admin-course">Course</a>
            <a class="text-gray-700 hover:text-blue-500" href="/add-topic">Add Topic</a>
        @endif
        </div>
      </div>
    </nav>