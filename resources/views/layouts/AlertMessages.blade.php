<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        <ul>
            <li>
                {{ session('success') }}
            </li>
        </ul>
    </div>
    @elseif ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <li>
                {{$errors->first()}}
            </li>
        </ul>
    </div>
    @endif
