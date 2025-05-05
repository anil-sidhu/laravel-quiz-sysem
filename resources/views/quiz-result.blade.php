<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
    <h1 class="text-4xl font-bold text-green-900 p-5" >Quiz Result</h1>
    <div class="w-200">
        <h1 class="text-2xl text-green-900 text-center my-5">
            {{$correctAnswers}} out of {{count($resultData)}} Correct</h1>

            <div>


<div class="flex gap-4">

<a 
  href="https://example.com/certificate"
  target="_blank"
  class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 shadow-sm"
>
  🎓 Get Certificate
</a>

  <!-- Facebook -->
  <a
    href="https://www.facebook.com/sharer/sharer.php?u=https://example.com"
    target="_blank"
    class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
  >
    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
      <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2c0-2 1.2-3 3-3h2v3h-1c-.6 0-1 .4-1 1v1h2.5l-.5 3H15v7A10 10 0 0 0 22 12z"/>
    </svg>
    Share
  </a>

  <!-- Twitter -->
  <a
    href="https://twitter.com/intent/tweet?url=https://example.com&text=Check%20this%20out!"
    target="_blank"
    class="flex items-center gap-2 px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition"
  >
    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
      <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.03A4.28 4.28 0 0 0 11 8.66a12.15 12.15 0 0 1-8.8-4.46 4.3 4.3 0 0 0 1.33 5.7A4.21 4.21 0 0 1 2 9.08v.05a4.28 4.28 0 0 0 3.43 4.2 4.28 4.28 0 0 1-1.93.07 4.3 4.3 0 0 0 4 2.97 8.6 8.6 0 0 1-5.32 1.84A8.68 8.68 0 0 1 2 18.58 12.13 12.13 0 0 0 8.29 20c7.55 0 11.68-6.25 11.68-11.68 0-.18-.01-.35-.02-.53A8.35 8.35 0 0 0 22.46 6z"/>
    </svg>
    Tweet
  </a>

  <!-- LinkedIn -->
  <a
    href="https://www.linkedin.com/sharing/share-offsite/?url=https://example.com"
    target="_blank"
    class="flex items-center gap-2 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition"
  >
    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
      <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.6v2.2h.1c.5-.9 1.7-1.9 3.5-1.9 3.8 0 4.5 2.5 4.5 5.8V24h-4V15.2c0-2.1 0-4.8-2.9-4.8s-3.4 2.3-3.4 4.6V24h-4V8z"/>
    </svg>
    Share
  </a>

  @php
    $shareUrl = urlencode('https://yourwebsite.com/blog/awesome-post');
@endphp

<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
   target="_blank"
   rel="noopener noreferrer">
   Share on LinkedIn
</a>


</div>

            </div>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Question</li>
                    <li class="w-70">Result</li>

                </ul>
            </li>

            @foreach($resultData as $key=>$item)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$key+1}}</li>
                    <li class="w-70">{{$item->question}}</li>
                    @if($item->is_correct)
                    <li class="w-70 text-green-500 ">Correct </li>
                    @else
                    <li class="w-70 text-red-500 ">Incorrect</li>
                    @endif
             

                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<x-footer-user></x-footer-user>
</body>