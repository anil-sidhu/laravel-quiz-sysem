<!DOCTYPE html>
<html lang="en">
<head>
@vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />



<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->

</head>
<body>
<x-navbar  name={{$name}} ></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center pt-5">
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-200">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Topic </h2>
<!-- Quill Editor Container -->

<!-- Form -->
<form method="POST" action="/add-topic">
    @csrf


    
    <!-- Hidden input will go here -->
    <input type="hidden" name="description" id="quillContent">

    <div>
            <label for="" class="text-gray-600 mb-1">Course Title</label>
            <input type="text"placeholder="Enter Course name" name="title"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('title')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>
        <div>
            <label for="" class="text-gray-600 mb-1">Course Keywords</label>
            <input type="text"placeholder="Enter Course name" name="keywords"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('keywords')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="" class="text-gray-600 mb-1">Video Link Link </label>
            <input type="text"placeholder="Enter Video Link" name="video_link"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('video_link')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
        <label for="" class="text-gray-600 mb-1">Select Course</label>

        <select type="text" name="course_id"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        @foreach($courses as $course)
        <option value={{$course->id}} >{{$course->title}}</option>
        @endforeach
    </select>
    </div>

        <label for="" class="text-gray-600 mb-1">Description Title</label>
    <div id="editor" style="height: 200px;"></div>

    <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >Add Topic</button>

</form>
</div> 
</div>
</body>
<script>
    const toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],
  ['link', 'image', 'video', 'formula'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];
  const quill = new Quill('#editor', {
    modules: {
    toolbar: toolbarOptions
  },
    theme: 'snow'
  });

  quill.on('text-change', (delta, oldDelta, source) => {
  if (source == 'api') {
    console.log('An API call triggered this change.');
  } else if (source == 'user') {
    const html = quill.root.innerHTML;
    document.getElementById('quillContent').value = html;
  }
});

</script>
</html>