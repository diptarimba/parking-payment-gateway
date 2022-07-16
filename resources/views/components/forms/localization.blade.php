 <div class="mb-2">
     <div class="col-form-label text-muted">Language</div>
     <select class="js-example-basic-single col-sm-12" data-placeholder="Select Language" name="translation_id">
         @foreach ($translations as $key => $name)
             <option value="{{ $key }}" @if ($value == $key) selected @endif>{{ $name }}</option>
         @endforeach
     </select>
 </div>
