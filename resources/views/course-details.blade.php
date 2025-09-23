<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{$course->title}} | Free coding course | Free tutorial, notes and code</title>
    <meta name="description" content="{{$course->title}} | {{$course->description}}">
    <meta name="keywords" content="{{$course->title}}, free {{$course->title}}, {{$course->title}} notes, {{$course->title}} code, Free tutorial ">
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl text-green-900 mb-6 font-extralight text-center">{{$course->title}}</h1>
  
  <!-- Sharpener Promotional Box -->
  <div class="w-full max-w-4xl mx-auto p-4 sm:p-8 mt-0 mb-8">
      <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 relative">
          <!-- Sharpener Logo and Text - Top Right -->
          <div class="absolute top-4 right-4 flex items-center">
              <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="url(#sharpenerGradient)" stroke="url(#sharpenerGradient)" stroke-width="0.5"/>
                  <defs>
                      <linearGradient id="sharpenerGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                          <stop offset="0%" style="stop-color:#b00;stop-opacity:1" />
                          <stop offset="105.83%" style="stop-color:#000;stop-opacity:1" />
                      </linearGradient>
                  </defs>
              </svg>
              <span class="text-lg font-bold" style="background: linear-gradient(90deg, #b00, #000 105.83%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Sharpener</span>
          </div>
          <!-- Pay After Placement Badge -->
          <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mb-4" style="background-color: #FEE2E2; color: #B91C1C;">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              Pay After Placement Program
          </div>
          <!-- Main Heading -->
          <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2">Join India's Rank 1 training Institute</h2>
          <!-- Rating and Trust Indicators -->
          <div class="flex flex-wrap items-center gap-4 mb-6">
              <div class="flex items-center">
                  <div class="flex text-yellow-400">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                  </div>
                  <span class="ml-2 text-gray-600 text-sm">4.93 star rated on google</span>
              </div>
              <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Trusted by 100k+ learners</div>
              <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">4000+ placements</div>
          </div>
          <!-- Learn More Button -->
          @if(session('user'))
              <button onclick="openSharpenerDashboard()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-300">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                  Learn more
              </button>
          @else
              <a href="/user-signup" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-300">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                  Learn more
              </a>
          @endif
      </div>
  </div>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
    @foreach($topics as $topic)
     <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
      <h2 class="font-extralight text-2xl  text-gray-800 mb-2">{{$topic->title}}</h2>
      <div class="flex justify-between items-center mb-2 text-xs">
        <a href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" class="text-green-900 hover:underline text-sm font-medium">Read More</a>
        <span class="text-gray-500">Uploaded on: {{ $topic->created_at ? $topic->created_at->format('Y-m-d') : '-' }}</span>
      </div>
    </div>
    @endforeach
   
</div>


    </div>
   


   
</div>
<x-footer-user></x-footer-user>
@if(!session('user') && !session('admin'))
    @include('components.lead-modal', ['closable' => true])
@endif

<script>
function openSharpenerDashboard() {
    // Open Sharpener Tech dashboard in new tab
    window.open('https://sharpener.tech', '_blank');
}
</script>

</body>
</html>