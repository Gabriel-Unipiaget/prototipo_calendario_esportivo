<div id="calendar" class="container mb-5"></div>

<div class="modal fade" id="detalhesEventoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- MODO VISUALIZAÇÃO -->
      <div class="modal-body" id="modoVisualizacao">
        <p><strong>Data:</strong> <span id="modalData"></span></p>
        <p><strong>Horário:</strong> <span id="modalHorario"></span></p>
        <p><strong>Descrição:</strong></p>
        <p id="modalDescricao"></p>
      </div>

      <!-- MODO EDIÇÃO (escondido até clicar em "Editar") -->
      <div class="modal-body d-none" id="modoEdicao">
        <div class="mb-3">
          <label class="form-label">Título</label>
          <input type="text" class="form-control" id="editNome">
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Data</label>
            <input type="date" class="form-control" id="editData">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Início</label>
            <input type="time" class="form-control" id="editHoraInicio">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Fim</label>
            <input type="time" class="form-control" id="editHoraFim">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Descrição</label>
          <textarea class="form-control" id="editDescricao" rows="2"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" id="btnExcluirEvento">Excluir</button>
        <button type="button" class="btn btn-outline-warning" id="btnEditarEvento">Editar</button>
        <button type="button" class="btn btn-outline-success" id="btnSalvarEdicao">Salvar</button>
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        var modalEl = document.getElementById("detalhesEventoModal");
        var detalhesModal = new bootstrap.Modal(modalEl);

        var btnExcluir = document.getElementById("btnExcluirEvento");
        var btnEditar  = document.getElementById("btnEditarEvento");
        var btnSalvar  = document.getElementById("btnSalvarEdicao");

        var modoVisualizacao = document.getElementById("modoVisualizacao");
        var modoEdicao       = document.getElementById("modoEdicao");

        var idAtual = null;      // id "real" da atividade (sem sufixo de repetição)
        var eventoAtual = null;  // objeto do evento clicado (pra reaproveitar dados na edição)

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            locale: "pt-br",
            headerToolbar: {
                left: "prevYear,prev,next,nextYear today",
                center: "title",
                right: "dayGridMonth,timeGridWeek",
            },
            events: "/atividades/feed",
            eventDisplay: "block",

            eventDidMount: function(info) {
                var agora = new Date();
                if (info.event.end && info.event.end < agora) {
                    info.el.style.backgroundColor = "#dc3545";
                    info.el.style.borderColor = "#b02a37";
                }
            },

            eventClick: function(info) {
                var props = info.event.extendedProps;
                eventoAtual = info.event;
                idAtual = info.event.id.split('-')[0];

                document.getElementById("modalTitulo").textContent = info.event.title;
                document.getElementById("modalData").textContent = props.data;
                document.getElementById("modalHorario").textContent =
                    props.hora_inicio + " às " + props.hora_fim;
                document.getElementById("modalDescricao").textContent =
                    props.descricao || "Sem descrição.";

                // sempre abre em modo visualização, mesmo se a última vez ficou em edição
                modoVisualizacao.classList.remove("d-none");
                modoEdicao.classList.add("d-none");
                btnEditar.classList.remove("d-none");
                btnSalvar.classList.add("d-none");

                detalhesModal.show();
            },
        });

        calendar.render();

        // ---------- Entrar em modo edição ----------
        btnEditar.addEventListener("click", function() {
            var props = eventoAtual.extendedProps;

            document.getElementById("editNome").value = eventoAtual.title;
            document.getElementById("editData").value = eventoAtual.startStr.substring(0, 10);
            document.getElementById("editHoraInicio").value = props.hora_inicio.substring(0, 5);
            document.getElementById("editHoraFim").value = props.hora_fim.substring(0, 5);
            document.getElementById("editDescricao").value = props.descricao || "";

            modoVisualizacao.classList.add("d-none");
            modoEdicao.classList.remove("d-none");
            btnEditar.classList.add("d-none");
            btnSalvar.classList.remove("d-none");
        });

        // ---------- Salvar edição ----------
        btnSalvar.addEventListener("click", function() {
            var dados = {
                nome: document.getElementById("editNome").value,
                data: document.getElementById("editData").value,
                hora_inicio: document.getElementById("editHoraInicio").value,
                hora_fim: document.getElementById("editHoraFim").value,
                descricao: document.getElementById("editDescricao").value,
            };

            fetch(`/atividades/${idAtual}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
                body: JSON.stringify(dados),
            })
            .then(function(res) {
                if (!res.ok) throw new Error("Falha ao salvar edição");
                calendar.refetchEvents();
                detalhesModal.hide();
            })
            .catch(function(err) {
                alert(err.message);
            });
        });

        // ---------- Excluir ----------
        btnExcluir.addEventListener("click", function() {
            if (!idAtual) return;
            if (!confirm("Tem certeza que deseja excluir este evento?")) return;

            fetch(`/atividades/${idAtual}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
            })
            .then(function(res) {
                if (!res.ok) throw new Error("Falha ao excluir");
                calendar.refetchEvents();
                detalhesModal.hide();
            })
            .catch(function(err) {
                alert(err.message);
            });
        });
    });
</script>
