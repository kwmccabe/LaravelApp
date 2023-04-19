{{--
see https://laravel.com/docs/10.x/blade
--}}

<br/>Hello, {{ $name }}.
<br/>
<br/>Route::current()->uri : {{ Route::current()->uri }}
<br/>request()->route()->uri : {{ request()->route()->uri }}
