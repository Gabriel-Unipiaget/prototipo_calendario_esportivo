    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand d-flex gap-2 align-items-center" href="{{ route('atividades.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-calendar-range-fill" viewBox="0 0 16 16">
                    <path
                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2z" />
                </svg>
                <article>Calêndario Esportivo</article>
            </a>
            <section class="gap-2">
                <a class="btn btn-outline-primary" href="{{ route('atividades.create') }}">Cadastrar Evento</a>
                <a class="btn btn-outline-primary" href="{{ route('atividades.index') }}">Ver Eventos</a>

            </section>
        </div>
    </nav>
