<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <a class="no-decoration" href="{{ route('faculty.index') }}">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ \App\Models\Faculty::count() }}</span>
                    <span class="leading-tight">Faculties</span>
                </h3>
            </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-4">
            <a class="no-decoration" href="{{ route('department.index') }}">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ \App\Models\Department::count() }}</span>
                    <span class="leading-tight">Departments</span>
                </h3>
            </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-4">
            <a class="no-decoration" href="{{ route('course.index') }}">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ \App\Models\Course::count() }}</span>
                    <span class="leading-tight">Courses</span>
                </h3>
            </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-4">
            <a class="no-decoration" href="/setting">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl"></span>
                    <span class="leading-tight">General settings</span>
                </h3>
            </div>
            </a>
        </div>
    </div>
</div>
{{-- <div class="row w-full block mt-8">
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ sprintf("%02d", count($parents)) }}</span>
                    <span class="leading-tight">Parents</span>
                </h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ sprintf("%02d", count($parents)) }}</span>
                    <span class="leading-tight">Parents</span>
                </h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ sprintf("%02d", count($parents)) }}</span>
                    <span class="leading-tight">Parents</span>
                </h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
                <h3 class="text-gray-700 uppercase font-bold">
                    <span class="text-4xl">{{ sprintf("%02d", count($parents)) }}</span>
                    <span class="leading-tight">Parents</span>
                </h3>
            </div>
        </div>
    </div>
</div> --}}