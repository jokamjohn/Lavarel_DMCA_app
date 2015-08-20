@if ($errors ->any())
    <ul class="alert alert-danger">
        <h4>Errors</h4>
       @foreach($errors->all() as $error)
            <li class="list-group-item list-group-item-warning">{{ $error }}</li>
        @endforeach
     </ul>
@endif