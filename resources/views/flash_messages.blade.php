@php($types = ['primary','secondary','success','danger','warning','info','light','dark'])
@foreach ($types as $type)
    @if ($message = Session::get($type))
        @php($msgs = (gettype($message) == 'array') ? $message : array($message))
        @foreach ($msgs as $msg)
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                {{ $msg }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
@endforeach

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
