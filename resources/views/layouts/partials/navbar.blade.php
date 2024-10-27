<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/dashboard">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          @if (auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="/sensors">Data Sensor</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/devices">Data Device</a>
          </li>
          @if (auth()->check())
            <li class="nav-item ms-3">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger">Log Out</button>
                </form>
            </li>
          @endif
        </ul>
      </div>
    </div>
</nav>
