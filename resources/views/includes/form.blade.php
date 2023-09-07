@if ($project->exists)
    {{-- EDIT --}}
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="text-white bg-dark p-5 rounded mt-5" enctype="multipart/form-data">
        @method('PUT')
    @else
        {{-- CREATE --}}
        <form method="POST" action="{{ route('admin.projects.store') }}" class="text-white bg-dark p-5 rounded mt-5" enctype="multipart/form-data">
@endif
@csrf
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input value="{{ old('title', $project->title) }}" type="text"
        class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp"
        name="title" required>
    <div class="form-text">Required</div>
    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="slug" class="form-label">Repository name</label>
    <input disabled value="{{ Str::slug(old('title', $project->title)) }}" type="text"
        class="form-control @error('slug') is-invalid @enderror" id="slug" aria-describedby="slugHelp"
        name="slug" required>
    <div class="form-text">Auto generated by the title</div>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
    rows="10">{{ old('description', $project->description) }}</textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input value="{{ old('image', $project->image) }}" type="file"
    class="form-control @error('image') is-invalid @enderror" id="image" name="image">
    <div class="form-text">Valid formats: JPG, JPEG, PNG</div>
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="row">
    <div class="mb-3 col-6">
        <label for="main_lang" class="form-label">Main language used</label>
        <input value="{{ old('main_lang', $project->main_lang) }}" type="text"
            class="form-control @error('main_lang') is-invalid @enderror" id="main_lang" name="main_lang">
    </div>
    <div class="mb-3 col-6">
        <label for="other_langs" class="form-label">Other languages used</label>
        <input value="{{ old('other_langs', $project->other_langs) }}" type="text"
            class="form-control @error('other_langs') is-invalid @enderror" id="other_langs" name="other_langs">
    </div>
</div>
<div class="mb-3 w-25">
    <label for="n_stars" class="form-label">Number of stars recived</label>
    <input value="{{ old('n_stars', $project->n_stars) }}" type="number"
        class="form-control @error('n_stars') is-invalid @enderror" id="n_stars" name="n_stars">
        @error('n_stars')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 w-25">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-select @error('category_id') is-invalid @enderror" name="technologies[]" id="category_id">
        <option value="">None</option>
        @foreach ($categories as $category)
            <option @if (old('category_id', $project->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                {{ $category->label }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Technologies</label>
    <div>
        @foreach ($technologies as $technology)
            <div class="form-check form-check-inline">
                <input @if (in_array($technology->id, old('technology', $project_technology_ids ?? []))) checked @endif class="form-check-input" type="checkbox"
                    id="tech-{{ $technology->id }}" value="">
                <label class="form-check-label" for="tech-{{ $technology->id }}">{{ $technology->label }}</label>
            </div>
        @endforeach
    </div>
</div>
<label class="form-label">Type</label> <br>
<div class="mb-3 form-check">
    <label class="form-check-label" for="is_public">Open source</label>
    <input type="checkbox" @if (old('is_public', $project->is_public)) checked @endif value="1"
        class="form-check-input @error('is_public') is-invalid @enderror" id="is_public" name="is_public">
</div>
<button type="submit" class="btn btn-success mt-3">Submit</button>
</form>