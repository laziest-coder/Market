@if(Session::has('success'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('success') }}
  </div>
@endif

@if(Session::has('danger'))
  <div class="alert alert-danger" role="alert">
    <strong>Успех::</strong> {{ Session::get('danger') }}
  </div>
@endif

@if(Session::has('edit'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('edit') }}
  </div>
@endif

@if(Session::has('custcreated'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('custcreated') }}
  </div>
@endif

@if(Session::has('custexists'))
  <div class="alert alert-danger" role="alert">
    <strong>Предупреждение::</strong> {{ Session::get('custexists') }}
  </div>
@endif

@if(Session::has('notaddedinfo'))
  <div class="alert alert-danger" role="alert">
    <strong>Предупреждение::</strong> {{ Session::get('notaddedinfo') }}
  </div>
@endif

@if(Session::has('custedited'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('custedited') }}
  </div>
@endif

@if(Session::has('custdeleted'))
  <div class="alert alert-danger" role="alert">
    <strong>Успех::</strong> {{ Session::get('custdeleted') }}
  </div>
@endif

@if(Session::has('sellercreated'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('sellercreated') }}
  </div>
@endif

@if(Session::has('categoryadded'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('categoryadded') }}
  </div>
@endif

@if(Session::has('categoryedited'))
  <div class="alert alert-success" role="alert">
    <strong>Успех::</strong> {{ Session::get('categoryedited') }}
  </div>
@endif

@if(count($errors)>0)
  <div class="alert alert-danger" role="alert">
    <strong>Ошибки:</strong>
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
