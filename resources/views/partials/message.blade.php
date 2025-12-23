@if(session('success'))
    <div class="bg-green-600 p-4 rounded mb-6 text-center">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-600 p-4 rounded mb-6 text-center">{{ session('error') }}</div>
@endif
@if($errors->any())
    <div class="bg-red-600 p-4 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif