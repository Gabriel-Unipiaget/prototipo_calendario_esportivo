<x-layout title="Criar Evento">
    <x-navbar></x-navbar>


    <section class="container-fluid d-flex justify-content-center">

        <form class="form mt-5" action="{{ route('atividades.store') }}" method="post">
            @csrf
            <h2 class="mb-3">Criação de atividade esportiva</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Evento" name="nome"  required>
                <label for="floatingInput">Evento</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingTextarea" placeholder="Descrição" style="height: 100px" name="descricao"></textarea>
                <label for="floatingTextarea">Descrição</label>
            </div>

            <div class="d-flex mb-3 align-items-center justify-content-between ">

                <div class="d-flex flex-column">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" style="width: 208px" name="data"  required>
                        <label for="floatingInput">De:</label>
                    </div>

                    <div class="d-flex gap-2 mb-3">

                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" id="floatingInput_00" style="width: 100px" name="hora_inicio"  required>
                            <label for="floatingInput">Inicio:</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" id="floatingInput_00" style="width: 100px" name="hora_fim"  required>
                            <label for="floatingInput">Fim:</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-center ">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recorrente" id="radioDefault1"
                            value="0" checked>
                        <label class="form-check-label" for="radioDefault1">
                            Não se repete
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recorrente" id="radioDefault2"
                            value="1">
                        <label class="form-check-label" for="radioDefault2">
                            Repetir
                        </label>
                    </div>

                    <label for="range4" class="form-label">Intervalo de semanas: <output for="range4"
                            id="rangeValue" aria-hidden="true"></output></label>
                    <input type="range" class="form-range" min="0" max="99" step="1" value="0"
                        id="range4" style="width: 180px" name="recorrencia" disabled>

                </div>

            </div>

            <div class="d-flex justify-content-end">
                <input type="submit" class="btn btn-outline-success ali" value="Salvar">
            </div>
        </form>
    </section>

        {{-- Mudar o radio do form na view create --}}
    <script>
        // This is an example script, please modify as needed
        const rangeInput = document.getElementById('range4');
        const rangeOutput = document.getElementById('rangeValue');

        function gerenciarRange() {
            const radioSelecionado = document.querySelector('input[name="recorrente"]:checked');

            if (radioSelecionado) {
                if (radioSelecionado.value === "0") {
                    rangeInput.disabled = true;
                } else if (radioSelecionado.value === "1") {
                    rangeInput.disabled = false;
                }
            }
        }
        gerenciarRange();

        document.querySelectorAll('input[name="recorrente"]').forEach(radio => {
            radio.addEventListener('change', gerenciarRange);
        });

        rangeOutput.textContent = rangeInput.value;

        rangeInput.addEventListener('input', function() {
            rangeOutput.textContent = this.value;
        });
    </script>
</x-layout>
